'use strict';

// マップ表示
function initMap() {
    const map = new google.maps.Map(document.getElementById("map"), {
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
  const input = document.getElementById("pac-input");
  const searchBox = new google.maps.places.SearchBox(input);

  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

  map.addListener("bounds_changed", () => {
    searchBox.setBounds(map.getBounds());
  });

  let markers = [];
  searchBox.addListener("places_changed", () => {
  //"place_chaged"イベントはAutoCompleteクラスのイベント

  const places = searchBox.getPlaces();
  //"getPlaces"メソッドはクエリ(検索キーワード)を配列(PlaceResult)で返す。
  if (places.length == 0) {
      return;
  }
  // 古いマーカーを削除
  markers.forEach((marker) => {
    //"forEach"メソッドは引数にある関数へ、Mapオブジェクトのキー/値を順に代入･関数の実行をする。
      marker.setMap(null);
      //setMapメソッドはMarker(Polyline,Circleなど)クラスのメソッド。Markerを指定した位置に配置する。引数nullにすると地図から取り除く。
    });
  markers = [];
  // 場所について、アイコン、名前、場所を取得します。
  const bounds = new google.maps.LatLngBounds();
  //"LatLngBounds"クラスは境界を作るインスンタンスを作成。
  places.forEach((place) => {
    if (!place.geometry) {
    //"geometry"はplaceライブラリのメソッド。
      console.log("Returned place contains no geometry");
      return;
    }
    const icon = {
      url: place.icon,
      //"icon"はアイコンを表すオブジェクト。マーカーをオリジナル画像にしたいときなど。
      size: new google.maps.Size(71, 71),
      origin: new google.maps.Point(0, 0),
      anchor: new google.maps.Point(17, 34),
      //"Point"クラスはマーカーのラベルなどの位置を決めるインスタンスメソッド。
      scaledSize: new google.maps.Size(25, 25),
      };
      // 各場所にマーカーを作成する。
      markers.push(new google.maps.Marker({
        map,
        icon,
        title: place.name,
        position: place.geometry.location,
      }));

      if (place.geometry.viewport) {

        bounds.union(place.geometry.viewport);

      } else {
        bounds.extend(place.geometry.location);

      }
    });
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
    }); 
}
