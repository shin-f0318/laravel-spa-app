@extends('layouts.app')
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>湯屋なう</title>
    
</head>

@section('content')
<link rel="stylesheet" href={{ asset('css/top.css') }}>
<body>
    <section>
        
        <h2>自分だけのお気に入りの湯とサウナを登録していこう</h2>
        
        <div class="flex-container">
            <div class="flex-item">
                <div class="image-wrap">
                    <img class="onsen-photo" src="{{ asset('/img/onsen.jpg') }}">
                </div>
            </div>
            <div class="flex-item">
                <div class="image-wrap">
                    <img class="sauna-photo" src="{{ asset('/img/sauna.png') }}">
                </div>
            </div>
        </div>
        
        

        <div class="btn-container">
            <button class="btn" onclick="location.href='{{ route('serch') }}' ">探す</button>
        </div>

        <div class="explanation">
            <p><span class="main-text">湯屋なう</span>とは？</p>
            <p><span class="sub-text">温泉</span>、<span class="sub-text">銭湯</span>、<span class="sub-text">サウナ</span>好きのためのアプリになります。</p>
            <p>全国の温泉、銭湯、サウナを地図上で登録することができます。
                自分で行ったことのある場所をお気に入りしたり、レビューを書いたりすることができます。
                新たなお店の発見やお気に入りの場所を登録して自分だけの湯Mapを作成していこう。
            </p>
        </div>
    </section>

    <section>

            <h2>みんなのお気に入りの湯やサウナを見てみよう</h2>

            <div class="fovorite-container">
                <div class="favorite-item">
                    <div class="image-wrap2">
                        <img class="favorite-photo" src="{{ asset('/img/favorite.png') }}">
                    </div>
                </div>

                <div class="favorite-btn-container">
                    <div class="favorite-text">
                        <p>お気に入り投稿を検索！</p>
                    </div>
                    <div>
                        <button class="favorite-btn" onclick="location.href='{{ route('login') }}' ">投稿一覧へ</button>
                    </div>
                </div>
            </div>
    </section>
</body>

</html>

@endsection