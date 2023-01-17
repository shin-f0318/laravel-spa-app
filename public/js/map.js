//initMap関数とmyclick関数の両方を使えるので、この2つはグローバル変数に対応
var infoWindow = [];
var marker = [];

//最初の画面表示時に呼ばれる関数。この中にmyclick関数を入れても動作しないので、initMap関数から除外する。
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
      //poi=観光スポットや施設などのアイコンのみ再表示
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
    var icon = {
      url: '/img/human.png',
      scaledSize: new google.maps.Size(30, 30)
    }
    var marker = new google.maps.Marker({
      position: latlng, //マーカーの位置（必須）
      map: map, //マーカーを表示する地図
      icon,
    });
  }

  function fail(error) {
    alert('位置情報の取得に失敗しました。エラーコード：' + error.code);
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
    var icon = {
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

 
  var spaData = [];
  var map;
 
  var sidebar_html = "";

   // DB情報の取得(ajax)
  $(function(){
    console.log("ajax");
    $.ajax({
      type: "get",
      url: "http://43.207.119.121/api/spa",
      dataType: "json",
      success: function(data){
        console.log(data);
        spaData = data;
        setMarker(spaData);
      },
      error: function(XMLHttpRequest, textStatus, errorThrown){
        alert('Error : ' + errorThrown);
      }
    });
  });
  
  function setMarker(markerData) {

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
      
      
      // マーカーアイコンをtypeによって変更する
      if (markerData[i]['spa_type'] === '温泉') {
        icon = new google.maps.MarkerImage('/img/onsen_logo.png');
      } else if (markerData[i]['spa_type'] === '銭湯') {
        icon = new google.maps.MarkerImage('/img/sento_logo.png');
      } else if (markerData[i]['spa_type'] === 'サウナ') {
        icon = new google.maps.MarkerImage('/img/sauna_logo.png');
      }

      // マーカーのセット
      marker[i] = new google.maps.Marker({
        position: markerLatLng,          // マーカーを立てる位置を指定
        map: map,                        // マーカーを立てる地図を指定
        icon: icon,
      });

      // 吹き出しの追加
      infoWindow[i] = new google.maps.InfoWindow({
        content: '住所:' + markerData[i]['spa_address'] + '<br><br>' + markerData[i]['spa_type'] + ':' + markerData[i]['spa_name'] + '<br><br>' + '料金:' + markerData[i]['spa_price'] + '円' + '<br><br>' + '特徴:' + markerData[i]['spa_point']
      });

      // サイドバー
      sidebar_html += '・' + '<a href="javascript:myclick(' + i + ')">' + markerData[i]['spa_name'] + '<\/a><br />';
      

      // マーカーにクリックイベントを追加
      markerEvent(i);
      
    }

    console.log(sidebar_html);
    // サイドバー
    document.getElementById("sidebar").innerHTML = sidebar_html;

  }

  function markerEvent(i) {
    marker[i].addListener('click', function() {
      myclick(i);
    });
  }

}

//myclickはクリック時に呼ばれる関数のため、initMap関数内から外す。
function myclick(i) {
  var openWindow;
  if(openWindow){
    openWindow.close();
  }
  infoWindow[i].open(map, marker[i]);
  openWindow = infoWindow[i];
}
