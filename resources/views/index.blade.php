@extends('layouts.app')
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>お問合せ一覧</title>
</head>
@section('content')
{{-- CSS --}}
<link rel="stylesheet" href={{ asset('css/index.css') }}>
<body>
    <main>
        <article>
            <div class="contact">                
                <h1 class="contact-ttl">お問合せ一覧</h1>  
                
                {{-- お問合せ内容表示 --}}
                {{-- @if (session('flash_message'))
                    <p>{{ session('flash_message') }}</p>
                @endif --}}
                
                {{-- お問合せ内容一覧表示 --}}
                <div>
                    <table class="contact-table">
                        <tr>
                            <div>
                                <th class="contact-item">ID</th>
                                <th class="contact-item">名前（ニックネーム）</th>
                                <th class="contact-item">性別</th>
                                <th class="contact-item">お問合せ内容</th>
                            </div>
                        </tr>
                        
                        @foreach ($contacts as $contact)
                            <tr>
                                <td class="contact-body">{{$contact->id}}</td>
                                <td class="contact-body">{{$contact->name}}</td>
                                <td class="contact-body">{{$contact->sex}}</td>
                                <td class="contact-body">{{$contact->contactText}}</td>
                            </tr>  
                        @endforeach
                        
                    </table>
                </div>
            </div>
        </article>
    </main>

{{-- JavaScript --}}
<script src="{{ asset('/js/index.js') }}"></script>
</body>
</html>
@endsection