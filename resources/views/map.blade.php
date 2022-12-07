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
            </div>
        </article>
    </main>
</body>
</html>
@endsection