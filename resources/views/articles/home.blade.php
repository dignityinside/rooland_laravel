@extends('layouts.app')

@section('title', __('articles.home_headline'))

@section('css')
    <link href="{{ asset('css/articles.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div id="articles_home">

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1>@lang('articles.home_headline')</h1>
            </div>
        </div>

        @forelse($articles as $article)
            <div class="row article">
                <div class="col-md-8 col-md-offset-2">
                    <h3>
                        <a href="{{ route('articles.show', ['article' => $article->slug]) }}">
                            {{ $article->title }}
                        </a>
                    </h3>
                    @if (isset($article->thumbnail))
                        <div>
                            <img src="{{ $article->thumbnail }}" alt="">
                        </div>
                    @endif
                    <div>
                        {{ \App\Helpers\Text::cut($article->content) }}
                    </div>
                </div>
            </div>
        @empty
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div>
                        @lang('articles.empty_text')
                    </div>
                </div>
            </div>
        @endforelse

        {{ $articles->links() }}

    </div>

@endsection
