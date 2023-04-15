@extends('layouts.logout')

@section('content')

<form method="POST" action="/register" >

@csrf

<h2>新規ユーザー登録</h2>

<label class="ユーザー名"></label>
<input class="input" name="username" type="text">

<label class="メールアドレス"></label>
<input class="input" name="mail" type="text">

<label class="パスワード"></label>
<input class="input" name="password" type="text">

<label class="パスワード確認"></label>
<input class="input" name="password-confirm" type="text">

<input type="submit" value="登録">

<p><a href="/login">ログイン画面へ戻る</a></p>

</form>


@endsection
