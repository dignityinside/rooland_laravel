@extends('layouts.app')

@section('title', $article->title)

@section('meta_title', $article->meta_title)
@section('meta_description', $article->meta_description)

@section('content')

    <div id="articles_show">

        <div class="row">

            <div class="col-md-10">
                <h1>{{$article->title}}</h1>
            </div>

            @can('update', $article)
                <div class="col-md-2">
                    <a href="{{ route('articles.edit', ['article' => $article->slug]) }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">
                        @lang('articles.button_edit')
                    </a>
                </div>
            @endauth

        </div>

        <div class="row">

            <div class="col-md-12">

                @if (isset($article->thumbnail))
                    <div><img src="{{ $article->thumbnail }}" alt=""></div>
                @endif

                @if($article->status_id === \App\Material::STATUS_DRAFT)
                    <div>
                        @lang('articles.status_draft')
                    </div>
                @endif

                <div>
                    {!! \App\Helpers\Text::hideCut(\App\Helpers\Markdown::process($article->content)) !!}
                </div>

                @if ($article->hits > 0)
                    <div>
                        @lang('articles.hits'): {{$article->hits}}
                    </div>
                @endif

                <div>
                    @lang('articles.category'): {{$article->category_id}}
                </div>

                <div>
                    {{$article->created_at->format(\App\Material::DATE_FORMAT)}}
                </div>

                @if ($article->allow_comments)
                    <div>
                        @lang('articles.comments')
                    </div>
                @endif

            </div>

        </div>

    </div>

@endsection
