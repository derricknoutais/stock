@extends('layouts.app')

@section('content')
    <form method="POST" action="https://{{$domain_prefix}}.vendhq.com/api/1.0/token">
    <input type="text" name="code" value="{{$code}}">
        <input type="text" name="client_id" value="MX4ZK2UFjF9KtCDdJ907NHudgbJWPiuQ">
        <input type="text" name="client_secret" value="aU0zNWC4wjyWyYpXcdTHImkG1JrwrXQU">
        <input type="text" name="grant_type" value="authorization_code">
        <input type="text" name="redirect_uri" value="http://vend.test">
        <input type="submit" value="submit">
    </form>

@endsection