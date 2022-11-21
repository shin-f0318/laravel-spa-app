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
<link rel="stylesheet" href={{ asset('css/index.css') }}>
<body>
    <main>
        <article>
            <div class="container">
                <h1 class="fs-2 my-3">お気に入り投稿一覧</h1>
                <div class="card mb-3">
                    <div class="card-body">
                        <table>
                            <tr>
                                <div>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </div>
                            </tr>   
                        </table>
                    </div>
                </div>
            </div>
        </article>
    </main>
</body>
</html>
@endsection