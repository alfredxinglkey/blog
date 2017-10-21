@extends('layout.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="blog-header">
            </div>
            <div class="col-sm-8">
                <h1>{{ Auth::user()->name }}</h1><p>关注：4｜粉丝：0｜文章：9</p>
            </div>
            <div class="col-sm-8 blog-main">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">文章</a></li>
                        <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">关注</a></li>
                        <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">粉丝</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            @foreach($posts as $post)
                                <div class="blog-post" style="margin-top: 30px">
                                    <h2 class="blog-post-title"><a href="/posts/{{ $post->id }}" >{{ $post->title }}</a></h2>
                                    <p class="blog-post-meta">{{ $post->created_at->toFormattedDateString() }} <a href="#">{{ $post->user->name }}</a></p>
                                    <p>{{ str_limit($post->content, 100, '...') }}</p>
                                </div>
                            @endforeach
                            {{ $posts->links() }}
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2">
                            <div class="blog-post" style="margin-top: 30px">
                                <p class="">Jadyn Medhurst Jr.</p>
                                <p class="">关注：1 | 粉丝：1｜ 文章：0</p>

                                <div>
                                    <button class="btn btn-default like-button" like-value="1" like-user="6" _token="MESUY3topeHgvFqsy9EcM916UWQq6khiGHM91wHy" type="button">取消关注</button>
                                </div>

                            </div>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_3">
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>


            </div><!-- /.blog-main -->

            @include('layout._sidebar')
        </div>
    </div>
@endsection