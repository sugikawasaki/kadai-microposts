<ul class="media-list"> {{-- showで@includeサブビューにより呼び出される、ログイン認証後の一覧画面--}}
@foreach ($microposts as $micropost)
    <?php $user = $micropost->user; ?> {{-- micropostscontoroller で代入した$data内に格納された$micropostのユーザー名を取りだす--}}
    <li class="media">
        <div class="media-left">
            <img class="media-object img-rounded" src="{{ Gravatar::src($user->email, 50) }}" alt="">
        </div>
        <div class="media-body">
            <div>
                {!! link_to_route('users.show', $user->name, ['id' => $user->id]) !!} <span class="text-muted">posted at {{ $micropost->created_at }}</span>
                {{-- link_to_route 引数 ルーティング名、リンクにしたい文字列→名前を表示、URLのパラメータに代入したい値、(HTMLタグの属性を配列形式で指定)。マイクロポストを作った日を表示 --}}
            </div>
            <div>
                <p>{!! nl2br(e($micropost->content)) !!}</p>{{-- micropostscontoroller で代入した$data内に格納された$micropostのコンテンツを取りだす--}}
            </div>
            <div>
                @if(Auth::id() == $micropost->user_id)  {{--Auth::user()->idと同じでログインしている人のidを取りだす、micropostのユーザーidと同じか比較する --}}
                    {!! Form::open(['route' => ['microposts.destroy', $micropost->id], 'method' => 'delete']) !!} 
                        {{--マイクロポスツデストロイのルーティングでMicropostsControllerで$micropostのidを代入する。--}}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!} {{-- 表示deleteのボタン--}}
                    {!! Form::close() !!}
                    @include('micropost_favorite.favorite_button', ['user' => $user, 'micropost' => $micropost])
                @else
                    @include('micropost_favorite.favorite_button', ['user' => $user, 'micropost' => $micropost])
                @endif
            </div>
        </div>
    </li>
@endforeach
</ul>
{!! $microposts->render() !!}