@if (Auth::id() !=$user->id) {{--AUth::id→今ログインしているユーザーidを抜き出す。該当ユーザーと違うか？ この前のfollowers.bladeで指定した'user'に$をつけて使える　--}}
    @if (Auth::user()->is_following($user->id)) {{-- Auth::user()->ユーザーモデルからレコードごともってくる。該当ユーザーをすでにフォローしているか？true --}}
        {!! Form::open(['route' => ['user.unfollow', $user->id], 'method' => 'delete']) !!}
            {!! Form::submit('Unfollow', ['class' => "btn btn-danger btn-block"]) !!}
        {!! Form::close() !!}
    @else
        {!! Form::open(['route' => ['user.follow', $user->id]]) !!}
            {!! Form::submit('Follow', ['class' => "btn btn-primary btn-block"]) !!}
        {!! Form::close() !!}
    @endif
@endif