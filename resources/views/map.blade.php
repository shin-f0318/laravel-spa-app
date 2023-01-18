@extends('layouts.app')
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>湯屋なうまっぷ</title>
</head>
@section('content')
 {{-- CSS --}}
<link rel="stylesheet" href={{ asset('css/map.css') }}>
<body>
    <main>
        <article>
            <div class="container">
                <h1>〜湯屋なう　まっぷ〜</h1>
            </div>

            {{-- 地図を表示する領域 --}}
            <div id="map-container">
              <table>
                <tr>
                  <td><div id="map"></div></td>
                  <td><div id="sidebar"></div></td>
                </tr>
              </table>

              {{-- 検索Box --}}
              <input
              id="pac-input"
              class="controls"
              type="text"
              placeholder="検索"
              >
            </div>

            {{-- 
            The `defer` attribute causes the callback to execute after the full HTML
            document has been parsed. For non-blocking uses, avoiding race conditions,
            and consistent behavior across browsers, consider loading using Promises
            with https://www.npmjs.com/package/@googlemaps/js-api-loader.
            --}}

        </article>
    </main>

    {{-- JavaScript --}}
    <script src="{{ asset('/js/map.js') }}"></script>

    {{-- initmap --}}
    <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDe3QyTBQBRbazc1cffB3BE3mjEBIdKbkw&callback=initMap&libraries=places"
    async
    defer
    ></script>
  
  {{-- jQuery --}}
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  
</body>
</html>
@endsection