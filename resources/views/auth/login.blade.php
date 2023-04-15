@extends('layouts.logout')

@section('content')

<form method="POST" action="/login">

@csrf

<p>DAWNSNSへようこそ</p>

<label class="e-mail">E-mail</label>
<input class="input" name="mail" type="text">
<label class="password">Password</label>
<input class="input" name="password" type="password" value="" id="password">

<input type="submit" value="ログイン">

<p><a href="/register">新規ユーザーの方はこちら</a></p>

</form>

@endsection
