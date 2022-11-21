@extends('layouts.app')
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>お問合せ</title>
</head>
@section('content')
<link rel="stylesheet" href={{ asset('css/create.css') }}>
<body>
    <h1>お問合せ</h1>

    <div>
        <form action="{{ route('store') }}" method="post">
            @csrf
                <div class="form-group mb-3">
                    <div>
                        <label>名前(ニックネーム)</label>
                    </div>
                    <div>
                        <input type="text" class="form-control" name="name" placeholder="入力してください">
                    </div>
                </div>
    
                <div class="form-group mb-3">
                    <div>
                        <label>メールアドレス</label>
                        <br>
                    </div>
                    <div>
                        <input type="text" class="form-control" name="email" placeholder="入力してください">
                    </div>
                </div>
    
                <div class="form-group mb-3">
                    <div>
                      <label>お問い合わせ内容</label>
                      <br>
                    </div>
                    <div>
                      <textarea class="form-control" placeholder="入力してください" name="message"></textarea>
    
                    </div>
                </div>
    
                <div>
                    <input type="submit" class="btn btn-outline-primary" value="送信">
                </div>
            </form>
    </div>
</body>
</html>
@endsection