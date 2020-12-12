@extends('layouts.main')
@section('content')
                            @if($popularPost)
                            <div class="col-lg-12">
                                <div class="standard-post">
                                    <div class="post-image">
                                        <a href="{{ url('post/'.$popularPost->slug) }}"><img src="{{ asset($popularPost->thumbnail) ?: 'http://placehold.it/370x305' }}" alt=""></a>
                                    </div>
                                    <div class="down-content">
                                        <div class="meta-category">
                                            <span>{{ $popularPost->category->title }}</span>
                                        </div>
                                        <a href="{{ url('post/'.$popularPost->slug) }}"><h4>{{ $popularPost->title }}</h4></a>
                                        <ul class="post-info">
                                            <li><a href="#">{{ $popularPost->updated_at }}</a></li>
                                            <li>{{ $popularPost->owner->name }} {{ $popularPost->owner->surname }}</li>
                                        </ul>
                                        <p> {!! $popularPost->body !!} </p>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6">
                                                <div class="comments-info">
                                                    <i class="fa fa-comment-o"></i>
                                                    <span> {{ $popularPost->comments()->count() }} </span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <ul class="share-post">
                                                    <li><i class="fa fa-share-alt"></i></li>
                                                    <li><a href="#">Facebook</a>,</li>
                                                    <li><a href="#">Twitter</a>,</li>
                                                    <li><a href="#">Pinterest</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @foreach($posts as $post)
                                <div class="col-lg-6">
                                    <div class="standard-post recent-post">
                                        <div class="post-image">
                                            <a href="{{ url('post/'.$post->slug) }}"><img src="{{ asset($post->thumbnail) ?: 'http://placehold.it/370x305' }}"
                                                                                          alt=""></a>
                                        </div>
                                        <cadiv class="down-content">
                                            <a href="{{ url('post/'.$post->slug) }}"><h4> {{ $post->title }} </h4></a>
                                            <ul class="post-info">
                                                <li><a href="#">{{ $post->updated_at }}</a></li>
                                                <li>{{ $post->owner->name }} {{ $post->owner->surname }}</li>
                                                    @if(auth()->check() && auth()->user()->isAdmin())

                                                            <li><a href="{{ url('admin/post/'.$post->id.'/edit') }}">Edit</a></li>
                                                            <li><a href="#" onclick="deletePost({{ $post->id }})">Delete</a></li>

                                                    @endif
                                            </ul>
                                            <p> {!! substr($post->body,0,25) !!} @if(strlen($post->body) > 25)...@endif </p>
                                        </cadiv>
                                    </div>
                                </div>
                            @endforeach
{{--                            <div class="col-lg-12">--}}
{{--                                <ul class="d-flex justify-content-center">--}}
{{--                                    {{ $posts->links() }}--}}
{{--                                </ul>--}}
{{--                            </div>--}}

    <div>
        @if($posts->previousPageUrl())
            <a href="{{ $posts->previousPageUrl() }}">Prev</a>
        @endif
        @if($posts->nextPageUrl())
            <a href="{{ $posts->nextPageUrl() }}">Next</a>
        @endif
    </div>

    @push('footer')
    @endpush

@endsection
