@extends('layouts.blog')

@section('content')

<article class="post post-{{ $post->pid }}">
    <header class="entry-header">
        <h1 class="entry-title">
            <a href="{{ url('/post/' . $post->slug) }}">{{ $post->title }}</a>
        </h1>
        <div class="entry-meta">
            <span class="post-category">
                @foreach($post->metas as $key => $meta)
                <a href="
                @if($meta->type == 'class')
                {{ url('/category/' . $meta->slug)}}
                @else
                {{ url('/tag/' . $meta->slug)}}
                @endif
                ">{{$meta->slug}}</a>
                @if(count($post->metas) != ($key + 1))
                |
                @endif
                @endforeach
            </span>

            <span class="post-date">
                <a><time class="entry-date">{{ head(explode(' ', $post->created_at))}}</time></a>
            </span>

            <span class="post-author">
                @if ($post->source)
                <a href="{{ $post->source_url }}" target="_blank">{{ $post->source }}</a>
                @else
                <a>Timeless</a>
                @endif
            </span>           

            <span class="comments-link">
                <a href="#ds-thread">
                    <span class="ds-thread-count" data-thread-key="{{ $post->slug }}"></span> 
                </a>
            </span>            
        </div>
    </header>
    <div class="entry-content clearfix">
        {!! $post->content !!}
    </div>
    
    <!-- 多说评论框 start -->
    <div class="ds-thread" id="ds-thread" data-thread-key="{{ $post->slug }}" data-title="{{ $post->title }}" data-url="{!! Request::getUri() !!}"></div>
    <!-- 多说评论框 end -->

    <div id="send-comment"></div>
</article>

@endsection