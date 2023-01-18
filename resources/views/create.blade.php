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
{{-- CSS --}}
<link rel="stylesheet" href={{ asset('css/create.css') }}>
<body>
    <div class="contact">
        <h1 class="contact-ttl">お問合せ</h1>

        {{-- Form --}}
        <form action="{{ route('store') }}" method="post">
            @csrf
        <table class="contact-table">

            <tr>
                <th class="contact-item">名前(ニックネーム)
                  <span class="contact-span">必須</span>
                </th>
                <td class="contact-body">
                    <input type="text" id="nameInput" name="name" placeholder="入力してください" class="form-text">
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
                </td>
            </tr>

            <tr>
                <th class="contact-item">メール
                  <span class="contact-span">必須</span>
                </th>

                <td class="contact-body">
                  <input type="email" id="mailInput" name="mail" class="form-text" placeholder="入力してください">
                </td>
            </tr>

            <tr>
                <th class="contact-item">電話番号
                  <span class="contact-span">必須</span>
                </th>

                <td class="contact-body">
                  <input type="tel" id="telInput" name="tel" class="form-text" placeholder="入力してください">
                </td>
            </tr>
              
            <tr>
                <th class="contact-item">お問い合わせ内容
                  <span class="contact-span">必須</span>
                </th>

                <td class="contact-body">
                  <textarea id="textInput" name="contactText" class="form-textarea"></textarea>
                </td>
            </tr>
        </table>

            <input id="submitInput" class="contact-submit" type="submit" value="送信" onClick="return check();">

        </form>
    </div>
    
    {{-- JavaScript --}}
    <script src="{{ asset('/js/create.js') }}"></script>
</body>
</html>
@endsection