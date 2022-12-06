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
            <h1>〜湯屋なう登録〜</h1>
        </div>
        <br>
        <div>
            <h3>マップ上に湯とサウナの情報を登録しましょう</h3>
        </div>
        <br>
        <div class="toptext">
            <p>--地図上でクリックして下記情報を登録してください--</p>
        </div>

        <div class=spa_form>
            <form action="{{ route('map_store') }}" method="post">
                @csrf
                <table>
                    <tr>
                        <th>項目</th>
                        <th>登録情報</th>
                    </tr>
                    <tr><td>緯度</td><td><input id="id_lat" name="spa_lat"></td></tr>
                    <tr><td>経度</td><td><input id="id_lng" name="spa_lng"></td></tr>
                    <tr>
                        <td>登録住所</td>
                        <td><input id="id_address" name="spa_address"></td>
                    </tr>

                    <tr>
                        <td>登録名</td>
                        <td><input type="text" class="form-control" name="spa_name" placeholder="施設名を入力してください"></td>
                    </tr>

                    <tr>
                        <td>種別</td>
                        <td>
                            <div class="radioBtn">
                                <label><input type="radio" value="温泉" name="spa_type" checked>温泉</label>
                                <label><input type="radio" value="銭湯" name="spa_type">銭湯</label>
                                <label><input type="radio" value="サウナ" name="spa_type">サウナ</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>料金</td>
                        <td><input type="number" class="from-control" name="spa_price" placeholder="料金を入力してください"></td>
                    </tr>

                    <tr>
                        <td>特徴・感想</td>
                        <td><textarea class="form-control" name="spa_point" placeholder="施設の特徴や感想を入力してください"></textarea></td>
                    </tr>
                    
                    <td>登録</td>
                    <td><input type="submit" class="spa_btn" value="登録">
                        <input type="reset" class="spa_btn" value="取消">
                    </td>
                    

                </table>
            </form>
        </div>
        <br>
    </div>
    <input
      id="pac-input"
      class="controls"
      type="text"
      placeholder="Search Box"
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
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDe3QyTBQBRbazc1cffB3BE3mjEBIdKbkw&callback=initMap&v=weekly"
      src="https://www.googleapis.com/geolocation/v1/geolocate?key=AIzaSyDe3QyTBQBRbazc1cffB3BE3mjEBIdKbkw"
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDe3QyTBQBRbazc1cffB3BE3mjEBIdKbkw&libraries=places&callback=initAutocomplete"
      async
      defer
    ></script>
  
</main>
</body>

</html>

@endsection