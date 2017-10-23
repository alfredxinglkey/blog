@extends('layout.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8 blog-main">
                <div class="blog-post">
                    <div>
                        <h2 class="blog-post-title">{{ $post->title }}</h2>
                        @can('update', $post)
                            <a class="btn btn-default" href="/posts/{{ $post->id }}/edit">编辑</a>
                        @endcan
                        @can('delete', $post)
                            <a class="btn btn-danger" href="/posts/{{ $post->id }}" onclick="event.preventDefault(); document.getElementById('delete').submit();">删除</a>
                            <form id="delete" action="/posts/{{$post->id}}" method="post" style="display: none;">
                                {{ method_field('delete') }}
                                {{ csrf_field() }}
                            </form>
                        @endcan
                    </div>

                    <p class="blog-post-meta">{{ $post->created_at->toFormattedDateString() }}<a href="/user/{{$post->user->id}}"> {{ Auth::user()->name}}</a></p>

                    <p>{{ $post->content }}</p>
                    <div>
                        @if($post->thumbup(Auth::id())->exists())
                            <a href="/posts/{{ $post->id }}/unthumbup" type="button" class="btn btn-default btn-lg">取消赞</a>
                        @else
                            <a href="/posts/{{ $post->id }}/thumbup" type="button" class="btn btn-primary btn-lg">赞</a>
                        @endif
                    </div>
                </div>

                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading">评论</div>

                    <!-- List group -->
                    <ul class="list-group">
                        @foreach($post->comments as $comment)
                        <li class="list-group-item">
                            <h5>{{ $comment->created_at }} by {{ $comment->user->name }}</h5>
                            <div>
                                {{ $comment->content }}
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading">发表评论</div>

                    <!-- List group -->
                    <ul class="list-group">
                        <form action="/posts/{{$post->id}}/comment" method="post">
                            {{ csrf_field()}}

                            <li class="list-group-item">
                                <textarea name="content" class="form-control" rows="10"></textarea>
                                @include('layout._errors')
                                <button class="btn btn-default" type="submit">提交</button>
                            </li>
                        </form>
                    </ul>
                </div>

            </div><!-- /.blog-main -->
        </div>
    </div>
@endsection