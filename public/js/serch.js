function initMap() {
    const map = new google.maps.Map(document.getElementById("map"), {
    // マップの中心を設定
    center: { lat: 35.6811673, lng: 139.7670516 },
    // マップの初期倍率
    zoom: 12,
    // マップの種類
    mapTypeId: "roadmap",
  });

// クリック動作
google.maps.event.addListener(map, 'click', event => clickListener(event, map));

// 位置情報取得
function success(pos) {
  // 緯度取得
  var lat = pos.coords.latitude;
  // 経度取得
  var lng = pos.coords.longitude;
  //中心の緯度, 経度
  var latlng = new google.maps.LatLng(lat, lng);
  // マップに反映
  var map = new google.maps.Map(document.getElementById('maps'), {
    zoom: 12,
    center: latlng
  });
}
function fail(error) {
  alert('位置情報の取得に失敗しました。エラーコード：' + error.code);
  var latlng = new google.maps.LatLng(35.6812405, 139.7649361); //東京駅
  var map = new google.maps.Map(document.getElementById('maps'), {
    zoom: 12,
    center: latlng
  });
}
navigator.geolocation.getCurrentPosition(success, fail);

// 検索ボックス

}

// 一つ前のピンの変数
let before_marker = null;

// ピン
function clickListener(event, map) {

  // 緯度取得
  const lat = event.latLng.lat();
  // htmlへ変数の送信
  // document.getElementById('id_ido').innerHTML = lat ;

  // 経度の取得
  const lng = event.latLng.lng();
  // htmlへ変数の送信
  // document.getElementById('id_keido').innerHTML = lng ;

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
      document.getElementById('id_address').innerHTML = address;
    });

    
    
}

window.initMap = initMap;

