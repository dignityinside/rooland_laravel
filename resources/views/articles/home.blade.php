@extends('layouts.app')

@section('title', __('articles.home_headline'))

@section('content')

    <div id="articles_home">

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1 class="text-white">@lang('articles.home_headline')</h1>
            </div>
        </div>

        @if(!$articles->isEmpty())
            <div class="d-flex flex-wrap">
        @endif

        @forelse($articles as $article)
            <div class="row py-3 px-2 m-2 flex-grow-1 rounded-lg bg-white" style="flex-basis: 450px;">
                <div class="col">
                    <h3 style="border-bottom: solid 1px #3f8701;">
                        <a href="{{ route('articles.show', ['article' => $article->slug]) }}" class="text-decoration-none">
                            {{ $article->title }}
                        </a>
                    </h3>
                    <div class="d-flex justify-content-end" style="font-size: 11px; color: #7B848D;">
                        <div class="px-2">
                            <i class="far fa-clock"></i>
                            <span class="px-1">
                                {{$article->created_at->format(\App\Material::DATE_FORMAT)}}
                            </span>
                        </div>
                        @if ($article->hits > 0)
                            <div class="px-2">
                                <i class="far fa-eye"></i>
                                <span class="px-1">{{$article->hits}}</span>
                            </div>
                        @endif
                        @if ($article->allow_comments)
                            <div class="px-2">
                                <i class="far fa-comments"></i>
                                <span class="px-1">0</span>
                            </div>
                        @endif
                    </div>
                    <div class="py-2">
                        @if (isset($article->thumbnail))
                            <img src="{{ $article->thumbnail }}" alt="" class="img-thumbnail bg-white">
                        @endif
                    </div>
                    <div>
                        {!! \App\Helpers\Text::cut(\App\Helpers\Markdown::process($article->content)) !!}
                    </div>
                    <div>
                        <a href="{{ route('articles.show', ['article' => $article->slug]) }}">
                            @lang('articles.link_more') →
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="row py-3 px-2 my-2 mx-0 rounded-lg bg-white">
                <div class="col">
                    <div>
                        @lang('articles.empty_text')
                    </div>
                </div>
            </div>
        @endforelse

        @if(!$articles->isEmpty())
            </div>
        @endif

        <div class="d-flex justify-content-center pt-2">
            {{ $articles->links() }}
        </div>

    </div>

@endsection
