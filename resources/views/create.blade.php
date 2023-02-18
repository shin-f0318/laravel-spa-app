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
    {{-- テーブル --}}
    <table class="contact-table">

      {{-- 名前 --}}
      <tr>
        <th class="contact-item">名前(ニックネーム)
          <span class="contact-span">必須</span>
        </th>
        <td class="contact-body">
          <input type="text" id="nameInput" name="name" placeholder="入力してください" class="form-text">
            
          @error('name')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </td>
      </tr>

      {{-- 性別 --}}
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

          @error('sex')
              <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </td>
      </tr>

      {{-- メール --}}
      <tr>
        <th class="contact-item">メールアドレス
          <span class="contact-span">必須</span>
        </th>

        <td class="contact-body">
          <input type="email" id="mailInput" name="mail" class="form-text" placeholder="入力してください">
          
          @error('mail')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </td>
      </tr>

      {{-- 電話番号 --}}
      <tr>
        <th class="contact-item">電話番号
          <span class="contact-span">必須</span>
        </th>

        <td class="contact-body">
          <input type="tel" id="telInput" name="tel" class="form-text" placeholder="入力してください">
          
          @error('tel')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </td>
      </tr>
      
      {{-- お問合せ内容 --}}
      <tr>
        <th class="contact-item">お問い合せ内容
          <span class="contact-span">必須</span>
        </th>

        <td class="contact-body">
          <textarea id="textInput" name="contactText" class="form-textarea"></textarea>
          
          @error('contactText')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </td>
      </tr>
    </table>

    {{-- 送信ボタン --}}
    <input id="submitInput" class="contact-submit" type="submit" value="送信" onClick="return check();">

  </form>
  </div>
    
{{-- JavaScript --}}
<script src="{{ asset('/js/create.js') }}"></script>

</body>
</html>
@endsection