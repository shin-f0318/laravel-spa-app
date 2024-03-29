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

{{-- CSS --}}
<link rel="stylesheet" type="text/css" href="{{ asset('/css/serch.css') }}">

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

            {{-- Form --}}
            <div class=spa_form>
                <form action="{{ route('map_store') }}" method="post" enctype='multipart/form-data'>
                    @csrf
                    <table>
                        <tr>
                            <th>項目</th>
                            <th>登録情報</th>
                        </tr>

                        {{-- 緯度 --}}
                        <tr>
                            <td>緯度</td>
                            <td><input type="text" id="id_lat" name="spa_lat" class="latLngAddress" readonly>
                                @error('spa_lat')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </td>
                        </tr>

                        {{-- 経度 --}}
                        <tr>
                            <td>経度</td>
                            <td><input type="text" id="id_lng" name="spa_lng" class="latLngAddress" readonly>
                                @error('spa_lng')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </td>
                        </tr>

                        {{-- 住所 --}}
                        <tr>
                            <td>登録住所</td>
                            <td><input type="text" id="id_address" name="spa_address" class="latLngAddress" readonly>
                                @error('spa_address')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </td>
                        </tr>

                        {{-- 登録名 --}}
                        <tr>
                            <td>登録名</td>
                            <td><input type="text" class="form-control" name="spa_name" placeholder="施設名を入力してください">
                                @error('spa_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </td>
                        </tr>

                        {{-- タイプ --}}
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

                        {{-- 料金 --}}
                        <tr>
                            <td>料金</td>
                            <td><input type="number" class="form-control" name="spa_price"  placeholder="料金を入力してください">
                                @error('spa_price')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </td>
                        </tr>

                        {{-- 特徴・レビュー --}}
                        <tr>
                            <td>特徴・レビュー</td>
                            <td><textarea class="form-control" name="spa_point" placeholder="施設の特徴やレビューを入力してください"></textarea>
                                @error('spa_point')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror   
                            </td>
                        </tr>

                        {{-- 写真投稿 --}}
                        {{-- <tr>
                            <td>画像保存</td>
                            <td><input type="file" class="form-control" name="spa_image" accept="image/png,image/jpeg,image/jpg"></td>
                        </tr> --}}

                        {{-- URL --}}
                        {{-- <tr>
                            <td>公式URL</td>
                            <td><input type="url" class="form-control" name="spa_url" placeholder="URLを貼り付けてください"></td>
                        </tr> --}}
                        
                        {{-- 送信ボタン --}}
                        <tr>
                            <td>登録</td>
                            <td>
                                <input type="submit" class="spa_btn" value="登録">
                                <input type="reset" class="spa_btn" value="取消">
                            </td>
                        </tr>

                    </table>
                </form>
            </div>

            <br>

        </div>

        <br>

        {{-- 検索Box --}}
        <input
            id="pac-input"
            class="controls"
            type="text"
            placeholder="検索"
        >

        {{-- 地図を表示する領域 --}}
        <div id="map-container">
            <div id="map"></div>
        </div>
        
        {{--
            The `defer` attribute causes the callback to execute after the full HTML
            document has been parsed. For non-blocking uses, avoiding race conditions,
            and consistent behavior across browsers, consider loading using Promises
            with https://www.npmjs.com/package/@googlemaps/js-api-loader.
        --}}

    </main>

{{-- JavaScript --}}
<script src="{{ asset('/js/serch.js') }}"></script>

{{-- initMap --}}
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDe3QyTBQBRbazc1cffB3BE3mjEBIdKbkw&callback=initMap&libraries=places"
    async
    defer
></script>
    
</body>
</html>
@endsection