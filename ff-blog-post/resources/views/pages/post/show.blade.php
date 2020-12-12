@extends('layouts.main')

@section('content')
    <div class="col-lg-12">
        <div class="single-post">
            <div class="post-image">
                <div class="meta-category">
                    <span>{{ $post->category->title }}</span>
                </div>
                <img src="{{ asset($post->thumbnail) ?: 'http://placehold.it/370x305' }}" alt="">
            </div>
            <div class="down-content">
                <h4>{{ $post->title }}</h4>
                <ul class="post-info">
                    <li><a href="#">{{ $post->updated_at }}</a></li>
                    <li>{{ $post->owner->name }} {{ $post->owner->surname }}</li>

                    @if(auth()->check() && auth()->user()->isAdmin())

                        <li><a href="{{ url('admin/post/'.$post->id.'/edit') }}">Edit</a></li>
                        <li><a href="#" onclick="deletePost({{ $post->id }})">Delete</a></li>

                    @endif
                    <li><a href="#">{{ $post->comments()->count() }}</a></li>
                </ul>
                <p class="first-paragraph">{!! $post->body !!}</p>
                <div class="row">
                    <div class="col-lg-7 col-md-6">
                        <div class="tags">
                            <ul class="tags">
                                <li><i class="fa fa-tag"></i></li>
                                <li><a href="#">Beauty</a>,</li>
                                <li><a href="#">Fashion</a>,</li>
                                <li><a href="#">Lifestyle</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-6">
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

    @if($post->comments()->where('comment_id',null)->exists())
        <div class="col-lg-12">
        <div class="widget-post comments">
            <div class="widget-header">
                <h4>
                    {{ $post->comments()->where('comment_id',null)->count() }}

                    @if($post->comments()->where('comment_id',null)->count() > 1)
                        Comments
                    @else
                        Comment
                    @endif
                </h4>
            </div>
            <div class="widget-content">
                <ul class="comments">
                    @foreach($post->comments->where('comment_id',null) as $comment)
                        <li>
                            <div class="comment-author-image">
                                <img src="{{ asset($comment->user->photo) }}" alt="">
                            </div>
                            <div class="right-content">
                                <h6>{{ $comment->user->name }} {{ $comment->user->surname }} <span>{{ $comment->updated_at }}</span></h6>
{{--                                <a href="#" class="reply-button">Reply</a>--}}
                                <p>{{ $comment->comment }}</p>
                            </div>
                        </li>
                        @foreach($post->comments->where('comment_id',$comment->id) as $reply)
                            <li class="replied">
                                <div class="comment-author-image">
                                    <img src="{{ asset($reply->user->photo) }}" alt="">
                                </div>
                                <div class="right-content">
                                    <h6>{{ $reply->user->name }} {{ $reply->user->surname }} <span>{{ $reply->updated_at }}</span></h6>
                                    <p>{{ $reply->comment }}</p>
                                </div>
                            </li>
                        @endforeach

                        @if(auth()->check())
                            <li class="replied">
                                    <h6>

                                        <div class="widget-post leave-comment">
                                        <div class="widget-content" style="
    width: 500px;
">

                                        <div class="contact-form">
                                        <form id="contact" action="{{ url('post/'.$post->id.'/comment/'.$comment->id.'/reply') }}" method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <fieldset>
                                                            <textarea name="reply" rows="6" class="form-control" id="message" placeholder="Your comment..." required="" style="height: 50px"></textarea>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <fieldset>
                                                            <button type="submit" id="form-submit" class="filled-button">Reply</button>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        </div></div>
                                    </h6>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endif

    @if(auth()->check())

        <div class="col-lg-12">
            <div class="widget-post leave-comment">
                <div class="widget-header">
                    <h4>Leave a comment</h4>
                </div>
                <div class="widget-content">
                    <div class="contact-form">
                        <form id="contact" action="{{ url('post/'.$post->id.'/comment') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <fieldset>
                                        <textarea name="comment" rows="6" class="form-control" id="message" placeholder="Your comment..." required=""></textarea>
                                    </fieldset>
                                </div>
                                <div class="col-lg-12">
                                    <fieldset>
                                        <button type="submit" id="form-submit" class="filled-button">Post Comment</button>
                                    </fieldset>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    @endif


@endsection
