@if (count($users) > 0) {{--ユーザー数が１以上の場合--}}
<ul class="media-list">
@foreach ($users as $user) {{--usersの中から一人ずつ表示していく--}}
    <li class="media">
        <div class="media-left">
            <img class="media-object img-rounded" src="{{ Gravatar::src($user->email, 50) }}" alt="">
        </div>
        <div class="media-body">
            <div>
                {{ $user->name }}
            </div>
            <div>
                <p>{!! link_to_route('users.show', 'View profile', ['id' => $user->id]) !!}</p> {{--ルーティング名users.show,表示View profile,URLのパラメーターに代入ユーザーのid番号 --}}
            </div>
        </div>
    </li>
@endforeach
</ul>
{!! $users->render() !!}
@endif