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
<script src="{{ asset('/js/create.js') }}"></script>
<body>
    <div class="contact">
        <h1 class="contact-ttl">お問合せ</h1>

        <form action="{{ route('store') }}" method="post">
            @csrf
        <table class="contact-table">

            <tr>
                <th class="contact-item">名前(ニックネーム)
                  <span class="contact-span">必須</span>
                </th>
                <td class="contact-body">
                    <input type="text" id="nameInput" name="name" placeholder="入力してください" class="form-text">
                    <p id="errorMessage"></p>
                </td>
            </tr>

            <tr>
                <th class="contact-item">性別
                  <span class="contact-span">必須</span>
                </th>
                <td class="contact-body">
                  <label class="contact-sex">
                    <input type="radio" id="sexInput" name="sex" value="男性">
                    <span class="contact-sex-txt">男性</span>
                  </label>
                  <label class="contact-sex">
                    <input type="radio" id="sexInput" name="sex" value="女性">
                    <span class="contact-sex-txt">女性</span>
                  </label>
                  <p id="errorMessage1"></p>
                </td>
            </tr>

            <tr>
                <th class="contact-item">メール
                  <span class="contact-span">必須</span>
                </th>
                <td class="contact-body">
                  <input type="email" id="mailInput" name="mail" class="form-text" placeholder="入力してください">
                  <p id="errorMessage2"></p>
                </td>
            </tr>

            <tr>
                <th class="contact-item">電話番号
                  <span class="contact-span">必須</span>
                </th>
                <td class="contact-body">
                  <input type="tel" id="telInput" name="tel" class="form-text" placeholder="入力してください">
                  <p id="errorMessage3"></p>
                </td>
            </tr>
              
            <tr>
                <th class="contact-item">お問い合わせ内容
                  <span class="contact-span">必須</span>
                </th>
                <td class="contact-body">
                  <textarea id="textInput" name="contactText" class="form-textarea"></textarea>
                  <p id="errorMessage4"></p>
                </td>
            </tr>
        </table>
            <input id="submitInput" class="contact-submit" type="submit" value="送信" onClick="return check();">
        </form>
    </div>
</body>
</html>
@endsection