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
    <div class="contact">
        <h1 class="contact-ttl">お問合せ</h1>

        <form action="{{ route('store') }}" method="post">
            @csrf
        <table class="contact-table">

            <tr>
                <th class="contact-item">名前(ニックネーム)</th>
                <td class="contact-body">
                    <input type="text" name="name" placeholder="入力してください" class="form-text">
                </td>
            </tr>

            <tr>
                <th class="contact-item">性別</th>
                <td class="contact-body">
                  <label class="contact-sex">
                    <input type="radio" name="性別">
                    <span class="contact-sex-txt">男</span>
                  </label>
                  <label class="contact-sex">
                    <input type="radio" name="性別">
                    <span class="contact-sex-txt">女</span>
                  </label>
                </td>
            </tr>

            <tr>
                <th class="contact-item">メール</th>
                <td class="contact-body">
                  <input type="email" name="メール" class="form-text" placeholder="入力してください">
                </td>
            </tr>

            <tr>
                <th class="contact-item">電話</th>
                <td class="contact-body">
                  <input type="tel" name="電話" class="form-text" placeholder="入力してください">
                </td>
            </tr>
              
            <tr>
                <th class="contact-item">お問い合わせ内容</th>
                <td class="contact-body">
                  <textarea name="問い合わせ" class="form-textarea"></textarea>
                </td>
            </tr>
        </table>
            <input class="contact-submit" type="submit" value="送信">
        </form>
    </div>
</body>
</html>
@endsection