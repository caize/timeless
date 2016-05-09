@extends('layouts.blog')

@section('content')

@foreach($posts as $post)
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
                <a href="{{ url('/post/' . $post->slug . '#ds-thread') }}">
                    <span class="ds-thread-count" data-thread-key="{{ $post->slug }}"></span>
                </a>
            </span>
        </div>
    </header>
    <div class="entry-content clearfix">
        <a href="{{ url('/post/' . $post->slug) }}">{{ $post->summary }}</a>
        <div class="read-more cl-effect-14">
            <a href="{{ url('/post/' . $post->slug) }}" class="more-link">Continue reading <span class="meta-nav">→</span></a>
        </div>
    </div>
</article>
@endforeach

{!! $posts->links() !!}

@endsection