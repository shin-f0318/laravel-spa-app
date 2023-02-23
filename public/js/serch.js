'use strict';

// マップ表示
function initMap() {
  var map = new google.maps.Map(document.getElementById("map"), {
    // マップの中心を設定
    center: { lat: 35.6811673, lng: 139.7670516 },
    // マップの初期倍率
    zoom: 12,
    // マップの種類
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

  // クリック動作
  google.maps.event.addListener(map, 'click', event => clickListener(event, map));

}

// 一つ前のピンの変数
let before_marker = null;

// ピン
function clickListener(event, map) {

  // 緯度取得
  const lat = event.latLng.lat();
  // htmlへ変数の送信
  document.getElementById('id_lat').value = lat ;

  // 経度の取得
  const lng = event.latLng.lng();
  // htmlへ変数の送信
  document.getElementById('id_lng').value = lng ;

  // ピンの設置
  const marker = new google.maps.Marker({
    position: {lat, lng},
    map
  });

  // ピン削除
  if(before_marker != null) {
    before_marker.setMap(null);
  }
  before_marker = marker;
  marker.setMap(map);

  // 経度・緯度をLatLngクラスへ変換
  const latLngInput = new google.maps.LatLng(lat, lng);

  // Geocodeを使用（経度・緯度を住所へ変換）
  const geocoder = new google.maps.Geocoder();

  // ジオコーダのgeocode
  // 第１引数のリクエストパラメータにlatLngプロパティを設定
  // 第２取得結果を処理
  geocoder.geocode(
    {
      'latLng': latLngInput
    },
    function(results, status) {
      
      // 住所を入れる変数
      var address = "";
      
      // 取得が成功した場合
      if (status == google.maps.GeocoderStatus.OK) {
        
      // 住所を取得
      address = results[0].formatted_address;
        
      } else if (status == google.maps.GeocoderStatus.ZERO_RESULTS) {
        alert("住所が見つかりませんでした。");
      } else if (status == google.maps.GeocoderStatus.ERROR) {
        alert("サーバ接続に失敗しました。");
      } else if (status == google.maps.GeocoderStatus.INVALID_REQUEST) {
        alert("リクエストが無効でした。");
      } else if (status == google.maps.GeocoderStatus.OVER_QUERY_LIMIT) {
        alert("リクエストの制限回数を超えました。");
      } else if (status == google.maps.GeocoderStatus.REQUEST_DENIED) {
        alert("サービスが使えない状態でした。");
      } else if (status == google.maps.GeocoderStatus.UNKNOWN_ERROR) {
        alert("原因不明のエラーが発生しました。");
      }
  
      // htmlへ変数の送信
      document.getElementById('id_address').value = address;
    }
  ); 
}
