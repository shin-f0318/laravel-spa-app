function initMap() {
    const map = new google.maps.Map(document.getElementById("map"), {
    // マップの中心を設定
    center: { lat: 35.6811673, lng: 139.7670516 },
    // マップの初期倍率
    zoom: -10,
    // マップの種類
    mapTypeId: "roadmap",
  });
}

window.initMap = initMap;
