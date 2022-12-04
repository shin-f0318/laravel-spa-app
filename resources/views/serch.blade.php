@extends('layouts.app')
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>湯屋なう登録</title>
</head>
@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('/css/serch.css') }}">
<script src="{{ asset('/js/serch.js') }}"></script>
<body>
<main>
    <div class="container">
        <div>
            <h1>〜湯屋なう　まっぷ〜</h1>
        </div>
        <br>
        <div>
            <p>マップ上に湯とサウナの情報を登録しよう</p>
        </div>
        <br>
        <div>
            <p>地図上でクリックして下記情報を登録してください</p>
        </div>
            <form>
                <table>
                    <tr>
                    <th>項目</th>
                    <th>情報</th></tr>
                    <tr><td>緯度</td><td id="id_ido"></td></tr>
                    <tr><td>経度</td><td id="id_keido"></td></tr>
                    <tr><td>住所</td><td id="id_address"></td></tr>
                </table>
            </form>
        <br>
    </div>
    <!-- 地図を表示する領域 -->
    <div id="map"></div>
  
    <!-- 
    The `defer` attribute causes the callback to execute after the full HTML
    document has been parsed. For non-blocking uses, avoiding race conditions,
    and consistent behavior across browsers, consider loading using Promises
    with https://www.npmjs.com/package/@googlemaps/js-api-loader.
    -->
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDe3QyTBQBRbazc1cffB3BE3mjEBIdKbkw&callback=initMap&v=weekly"
      async
      defer
    ></script>
</main>
</body>

</html>

@endsection