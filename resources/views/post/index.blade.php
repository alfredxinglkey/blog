@extends('layout.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="blog-header">
            </div>
            <div class="col-sm-8 blog-main">
                <div class="nav-tabs-custom">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            @foreach($posts as $post)
                                <div class="blog-post" style="margin-top: 30px">
                                    <h2 class="blog-post-title"><a href="/posts/{{ $post->id }}" >{{ $post->title }}</a></h2>
                                    <p class="blog-post-meta">{{ $post->created_at->toFormattedDateString() }} <a href="/user/{{ $post->user->id }}">{{ $post->user->name }}</a></p>
                                    <p>{!!str_limit($post->content, 100, '...') !!}</p>
                                    <p class="blog-post-meta">赞 {{ $post->thumbups_count }} | 评论 {{ $post->comments_count }}</p>
                                </div>
                            @endforeach
                            {{ $posts->links() }}
                        </div>
                    </div>
                    <!-- /.tab-content -->
                </div>
            </div><!-- /.blog-main -->
            @include('layout._sidebar')
        </div>
    </div>
@endsection