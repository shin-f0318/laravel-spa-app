@extends('layouts.app')
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>お気に入り投稿一覧</title>
</head>
@section('content')
<link rel="stylesheet" href={{ asset('css/map.css') }}>
<script src="{{ asset('/js/map.js') }}"></script>
<body>
    <main>
        <article>
            <div class="container">
                <h1>〜湯屋なう　まっぷ〜</h1>
            </div>
            <input
              id="pac-input"
              class="controls"
              type="text"
              placeholder="検索"
            >
            <!-- 地図を表示する領域 -->
            <div id="map-container">
                <div id="map"></div>
          </div>
            <!-- 
            The `defer` attribute causes the callback to execute after the full HTML
            document has been parsed. For non-blocking uses, avoiding race conditions,
            and consistent behavior across browsers, consider loading using Promises
            with https://www.npmjs.com/package/@googlemaps/js-api-loader.
            -->

            <!-- MarkerCluster -->
            <script 
            src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
            </script>

            <script
              src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDe3QyTBQBRbazc1cffB3BE3mjEBIdKbkw&callback=initMap&libraries=places"
              async
              defer
            ></script>

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

          </div>
          
          <table>
            <tr>
              
            </tr>
          </table>

        </article>
    </main>
    <?php

      //ヘッダー情報の設定
      header("Content-Type: application/json; charset=utf-8");

      $data = array();

      // DB接続情報
      $host = "localhost:8889";
      $dbname = "laravel_spa_app";
      $user = "root";
      $pass = "root";

      // DB接続情報設定・SQL準備・接続
      $dbh = new PDO($host .$dbname . 'charset=utf8', $user, $pass);

      $sql = "spa_lat, spa_lng, spa_address, spa_name, spa_type, spa_price, spa_point";
      $sth = $dbh -> prepare($sql);
      $sth -> execute();

      //データを取得する
      $data = $sth -> fetchAll(PDO::FETCH_ASSOC);

      //jsonオブジェクト化
      echo json_encode($data);
    ?>
</body>
</html>
@endsection