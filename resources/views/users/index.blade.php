@extends('layouts.app') {{-- layoutフォルダのappファイルを親レイアウトとして継承する　--}}

@section('content') {{-- appsファイルの@yieldにこのセクションをはめ込む　--}}
    @include('users.users' , ['users' => $users]) {{-- 別のビューをはめ込む＝サブビュー　引数テンプレート：users.usersのテンプレートに、第二引数：値を指定して渡す。$usersをuserとして　--}}
@endsection