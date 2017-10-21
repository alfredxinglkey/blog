@extends('layout.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8 blog-main">
                <div class="nav-tabs-custom">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <div class="blog-post" style="margin-top: 30px">
                                <h2 class="blog-post-title">{{ $post->title }}</h2>
                                <p class="blog-post-meta">{{ $post->created_at->toFormattedDateString() }} <a href="#">{{ $post->user->name }}</a></p>
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
                                </p>
                                <p>{{ $post->content }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- /.tab-content -->
                </div>
            </div><!-- /.blog-main -->
            @include('layout._sidebar')
        </div>
    </div>
@endsection