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
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 10,
      center: latlng
    });
  }
  navigator.geolocation.getCurrentPosition(success, fail);

  // 検索機能
  const input = document.getElementById("pac-input");
  const searchBox = new google.maps.places.SearchBox(input);
 ////"SearchBoxクラス"はPlacesライブラリのメソッド。引数はinput(ドキュメント上ではinputFieldとある)。
 ////[https://developers.google.com/maps/documentation/javascript/reference/places-widget#SearchBox]

  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
  ////"ControlPosition"クラスはコントローラーの位置を定める。
  ////https://lab.syncer.jp/Web/API/Google_Maps/JavaScript/ControlPosition/
  ////https://developers.google.com/maps/documentation/javascript/examples/control-positioning

  map.addListener("bounds_changed", () => {
    searchBox.setBounds(map.getBounds());
  });
  ////"bound_changed"イベントは(見えてる範囲の地図･ビューポートに変化があったときに発火)
  ////https://lab.syncer.jp/Web/API/Google_Maps/JavaScript/Map/bounds_changed/ 
  ////"getBounds"メソッドはビューポートの境界を取得。Mapクラスのメソッド。
  ////https://lab.syncer.jp/Web/API/Google_Maps/JavaScript/Map/getBounds/

  let markers = [];
  searchBox.addListener("places_changed", () => {
  ////"place_chaged"イベントはAutoCompleteクラスのイベント.
  ////https://developers.google.com/maps/documentation/javascript/reference/places-widget#Autocomplete.place_changed

    const places = searchBox.getPlaces();
    ////"getPlaces"メソッドはクエリ(検索キーワード)を配列(PlaceResult)で返す。
    ////https://developers.google.com/maps/documentation/javascript/reference/places-widget#Autocomplete.place_changed

    if (places.length == 0) {
      return;
    }
    // Clear out the old markers.
    markers.forEach((marker) => {
      //"forEach"メソッドは引数にある関数へ、Mapオブジェクトのキー/値を順に代入･関数の実行をする。
        //Mapオブジェクト:
          //https://developer.mozilla.org/ja/docs/Web/JavaScript/Reference/Global_Objects/Map
      marker.setMap(null);
      ////setMapメソッドはMarker(Polyline,Circleなど)クラスのメソッド。Markerを指定した位置に配置する。引数nullにすると地図から取り除く。
    });
    markers = [];
    // For each place, get the icon, name and location.
    const bounds = new google.maps.LatLngBounds();
    ////"LatLngBounds"クラスは境界を作るインスンタンスを作成。引数は左下、右上の座標。
    ////https://lab.syncer.jp/Web/API/Google_Maps/JavaScript/LatLngBounds/#:~:text=LatLngBounds%E3%82%AF%E3%83%A9%E3%82%B9%E3%81%AF%E5%A2%83%E7%95%8C(Bounding,%E4%BD%9C%E3%82%8B%E3%81%93%E3%81%A8%E3%82%82%E3%81%A7%E3%81%8D%E3%81%BE%E3%81%99%E3%80%82
    places.forEach((place) => {
      if (!place.geometry) {
        ////"geometry"はplaceライブラリのメソッド。

        console.log("Returned place contains no geometry");
        return;
      }
      const icon = {
        url: place.icon,
        ////"icon"はアイコンを表すオブジェクト。マーカーをオリジナル画像にしたいときなど。
        ////https://lab.syncer.jp/Web/API/Google_Maps/JavaScript/Icon/
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        ////"Point"クラスはマーカーのラベルなどの位置を決めるインスタンスメソッド。
        ////https://lab.syncer.jp/Web/API/Google_Maps/JavaScript/Point/

        scaledSize: new google.maps.Size(25, 25),
      };
      // Create a marker for each place.
      markers.push(
        new google.maps.Marker({
          map,
          icon,
          title: place.name,
          position: place.geometry.location,
        })
      );

      if (place.geometry.viewport) {
        ////viewport"メソッド
        // Only geocodes have viewport.
        bounds.union(place.geometry.viewport);
        ////"union"メソッドはLatLngBoundsクラスのメソッド。自身の境界に指定した境界を取り込んで合成する。
        ////https://lab.syncer.jp/Web/API/Google_Maps/JavaScript/LatLngBounds/union/
      } else {
        bounds.extend(place.geometry.location);
        ////"extend"メソッドはLatLngBoundsクラスのメソッド。自身の境界に新しく位置座標を追加する。
        ////https://lab.syncer.jp/Web/API/Google_Maps/JavaScript/LatLngBounds/extend/
      }
    });
    map.fitBounds(bounds);
    ////"fitBounds"メソッドはmapクラスのメソッド。指定した境界を見えやすい位置にビューポートを変更する。
    ////https://lab.syncer.jp/Web/API/Google_Maps/JavaScript/Map/fitBounds/#:~:text=Map.fitBounds()%E3%81%AFMap,%E5%A4%89%E6%9B%B4%E3%81%97%E3%81%A6%E3%81%8F%E3%82%8C%E3%81%BE%E3%81%99%E3%80%82
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

  // // ピン削除
  // function deleteMakers () {
  //   if(marker != null) {
  //     marker.setMap(null);
	// 	  }
	// 	  marker = null;
	// }

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

window.initMap = initMap;

