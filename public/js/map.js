function initMap() {
  //マップの初期設定です。
  var map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: 35.6811673, lng: 139.7670516 },
    zoom: 8,
    mapTypeId: "roadmap",
    // マップのスタイル変更
    styles: [
      //全てのラベルを非表示
      {
        featureType: 'all',
        elementType: 'labels',
        stylers: [
          {visibility: 'off'},
        ],
      },
      {
        featureType: 'transit',
        elementType: 'labels',
        stylers: [
          {visibility: 'on'},
        ],
      },
      //poi=観光スポットや施設など」のアイコンのみ再表示
      {
        featureType: 'poi',
        elementType: 'labels.icon',
        stylers: [
          {visibility: 'inherit'},
        ],
      },
      //地図全体の色味をカスタマイズ
      //基本色を赤に統一 + 彩度を落とす
      {
        featureType: 'all',
        elementType: 'all',
        stylers: [
          {hue: '#D3C6A6'},
          {saturation : -50},
        ],
      }
    ]
  });

  // 位置情報取得
  function success(pos) {
    var lat = pos.coords.latitude;
    var lng = pos.coords.longitude;
    var latlng = new google.maps.LatLng(lat, lng); //中心の緯度, 経度
    var marker = new google.maps.Marker({
      position: latlng, //マーカーの位置（必須）
      map: map //マーカーを表示する地図
    });
  }
  function fail(error) {
    alert('位置情報の取得に失敗しました。エラーコード：' + error.code);
    var latlng = new google.maps.LatLng(35.6812405, 139.7649361); //東京駅
    // var map = new google.maps.Map(document.getElementById('map'), {
    //   zoom: 10,
    //   center: latlng
    // });
  }
  navigator.geolocation.getCurrentPosition(success, fail);

  // 検索機能
  const input = document.getElementById("pac-input");
  const searchBox = new google.maps.places.SearchBox(input);
 

  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
  

  map.addListener("bounds_changed", () => {
    searchBox.setBounds(map.getBounds());
  });
  
  let markers = [];
  searchBox.addListener("places_changed", () => {
  
    const places = searchBox.getPlaces();
    
    if (places.length == 0) {
      return;
    }
    // Clear out the old markers.
    markers.forEach((marker) => {
    
      marker.setMap(null);
      
    });
    markers = [];
    
    const bounds = new google.maps.LatLngBounds();
    
    places.forEach((place) => {
      if (!place.geometry) {
      console.log("Returned place contains no geometry");
      return;
    }
    const icon = {
      url: place.icon,
      size: new google.maps.Size(71, 71),
      origin: new google.maps.Point(0, 0),
      anchor: new google.maps.Point(17, 34),
      scaledSize: new google.maps.Size(25, 25),
      };
      markers.push(
        new google.maps.Marker({
          map,
          icon,
          title: place.name,
          position: place.geometry.location,
        })
      );

      if (place.geometry.viewport) {
        bounds.union(place.geometry.viewport);
      } else {
        bounds.extend(place.geometry.location);
      }
    });
    map.fitBounds(bounds);
  });

  // DB情報の取得(ajax)
  var markerD = [];
  $(function(){
    $.ajax({
      type: "get",
      url: "http://127.0.0.1:8080/spa",
      data: data,
      dataType: "json",
      success: function(data){
        markerD = data;
        setMarker(markerD);
      },
      error: function(XMLHttpRequest, textStatus, errorThrown){
        alert('Error : ' + errorThrown);
      }
    });
  });
  
  function setMarker(markerData) {
    // console.log(markerData);
    // console.log(markerData.length);

    // マーカー作成
    var icon;

    for (var i = 0; i < markerData.length; i++) {

      var latNum = parseFloat(markerData[i]['spa_lat']);
      var lngNum = parseFloat(markerData[i]['spa_lng']);

      // マーカー位置セット
      var markerLatLng = new google.maps.LatLng({
        lat: latNum,
        lng: lngNum
      });
      
      // マーカーのセット
      marker[i] = new google.maps.Marker({
        position: markerLatLng,          // マーカーを立てる位置を指定
        map: map,                        // マーカーを立てる地図を指定
        icon: icon                       // アイコン指定
      });

      // 吹き出しの追加
      infoWindow[i] = new google.maps.InfoWindow({
        content: markerData[i]['spa_type'] + ':' + markerData[i]['spa_name'] + '<br><br>' + markerData[i]['text'] + '<br><br>' + markerData[i]['img']
      });
      
      // マーカーにクリックイベントを追加
      markerEvent(i);
    }

    // Marker clusterの追加
    var markerCluster = new MarkerClusterer(
      map,
      marker,
      {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'}
    );
  }

  var openWindow;

  function markerEvent(i) {
    marker[i].addListener('click', function() {
      myclick(i);
    });
  }

  function myclick(i) {
    if(openWindow){
      openWindow.close();
    }
    infoWindow[i].open(map, marker[i]);
    openWindow = infoWindow[i];
  }

}
