'use strict';

//initMap関数とmyclick関数の両方を使えるので、この2つはグローバル変数に対応
var infoWindow = [];
var marker = [];

//最初の画面表示時に呼ばれる関数。この中にmyclick関数を入れても動作しないので、initMap関数から除外する。
function initMap() {
  //マップの初期設定です。
  var map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: 35.6811673, lng: 139.7670516 },
    zoom: 12,
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

    //中心の緯度, 経度
    var latlng = new google.maps.LatLng(lat, lng);
    var icon = {
      url: '/img/human.png',
      scaledSize: new google.maps.Size(30, 30)
    }
    
    new google.maps.Marker({
      //マーカーの位置
      position: latlng,
      //マーカーを表示する地図
      map: map,
      icon,
    });
  }

  function fail(error) {
		alert('位置情報の取得に失敗しました。エラーコード：' + error.code);
		var latlng = new google.maps.LatLng(35.6812405, 139.7649361); //東京駅
	}
  
  navigator.geolocation.getCurrentPosition(success, fail);

  // 検索機能

  // 引数inputを定義 viewのidの値を取得
  const input = document.getElementById("pac-input");
  // SearchBoxクラスはPlacesライブラリのメソッド 公式ドキュメント参照
  const searchBox = new google.maps.places.SearchBox(input);
 
  // コントローラの位置を表す定数
  // map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
  
  // bound_changedイベントは(見えてる範囲の地図･ビューポートに変化があったときに発火される)
  map.addListener("bounds_changed", () => {
    // getBoundsメソッドはビューポートの境界を取得するMapクラスのメソッド
    searchBox.setBounds(map.getBounds());
  });
  
  let markers = [];
  // place_chagedイベントはAutoCompleteクラスのイベント
  searchBox.addListener("places_changed", () => {
  
    // getPlacesメソッドはクエリ(検索キーワード)を配列(PlaceResult)で返すもの
    const places = searchBox.getPlaces();
    
    if (places.length == 0) {
      return;
    }

    // 古いマーカーを削除
    // forEachメソッドは引数にある関数へ、Mapオブジェクトのキー/値を順に代入･関数の実行をする
    markers.forEach((marker) => {

      // setMapメソッドはMarker(Polyline,Circleなど)クラスのメソッド。Markerを指定した位置に配置する。引数nullにすると地図から取り除く
      marker.setMap(null);
      
    });
    markers = [];
    
    // LatLngBoundsクラスは境界を作るインスンタンスを作成
    const bounds = new google.maps.LatLngBounds();
    
    places.forEach((place) => {

      // geometryはplaceライブラリのメソッド
      if (!place.geometry) {
      console.log("Returned place contains no geometry");
      return;
      }

      // iconはアイコンを表すオブジェクト。マーカーをオリジナル画像にしたいときなどに定義する
      var icon = {
        url: '/img/search_logo.png',
      };
      markers.push(
        new google.maps.Marker({
          map,
          icon,
          title: place.name,
          position: place.geometry.location,
        })
      );
        
      // viewportメソッド
      if (place.geometry.viewport) {

        // unionメソッドはLatLngBoundsクラスのメソッド。自身の境界に指定した境界を取り込んで合成する
        bounds.union(place.geometry.viewport);
      } else {

        // extendメソッドはLatLngBoundsクラスのメソッド。自身の境界に新しく位置座標を追加する。
        bounds.extend(place.geometry.location);
      }
    });

    // fitBoundsメソッドはmapクラスのメソッド。指定した境界を見えやすい位置にビューポートを変更する。
    map.fitBounds(bounds);
  });

  // ApiからAjaxを利用しデータを取得
  var spaData = [];
  var map;
 
  var sidebar_html = "";

   // DB情報の取得(ajax)
  $(function(){
    $.ajax({
      type: "get",
      url: "https://yuya-now.com/api/spa",
      // url: "http://127.0.0.1:8000/api/spa",
      dataType: "json",
      success: function(data){
        // console.log(data);
        spaData = data;
        setMarker(spaData);
      },
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
        content: '住所:' + markerData[i]['spa_address'] + '<br><br>' + 
                 markerData[i]['spa_type'] + ':' + markerData[i]['spa_name'] + '<br><br>' + 
                 '料金:' + markerData[i]['spa_price'] + '円' + '<br><br>' + 
                 '特徴:' + markerData[i]['spa_point'] + '<br><br>'
                //  `<img src="${markerData[i]['spa_image']}">` + '<br><br>' +
                //  `<a href="${markerData[i]['spa_url']}">公式リンク</a>`
      });

      // サイドバー
      sidebar_html += '・' + '<a href="javascript:myclick(' + i + ')">' + markerData[i]['spa_name'] + '<\/a><br />';
      

      // マーカーにクリックイベントを追加
      markerEvent(i);
      
    }

    // console.log(sidebar_html);

    // サイドバー
    document.getElementById("sidebar").innerHTML = sidebar_html;

  }
}

var openWindow;

function markerEvent(i) {
  marker[i].addListener('click', function() {
    myclick(i);
  });
}


//myclickはクリック時に呼ばれる関数のため、initMap関数内から外す。
function myclick(i) {
  if(openWindow){
    openWindow.close();
  }
  infoWindow[i].open(map, marker[i]);
  openWindow = infoWindow[i];
}
