@extends('layouts.app')

@section('title', $article->title)

@section('meta_title', $article->meta_title)
@section('meta_description', $article->meta_description)

@section('content')

    <div id="articles_show">

        <div class="row">

            <div class="col-md-10">
                <h1 class="text-white">
                    {{$article->title}}
                </h1>
            </div>

            @can('update', $article)
                <div class="col-md-2">
                    <a href="{{ route('articles.edit', ['article' => $article->slug]) }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">
                        <i class="far fa-edit"></i> @lang('articles.button_edit')
                    </a>
                </div>
            @endauth

            <div class="col-md-9 py-3 px-2">

                @if (isset($article->thumbnail))
                    <div><img src="{{ $article->thumbnail }}" alt="" class="img-thumbnail bg-white mb-3"></div>
                @endif

                @if($article->status_id === \App\Material::STATUS_DRAFT)
                    <div>
                        @lang('articles.status_draft')
                    </div>
                @endif

                <div class="bg-white py-3 px-4 rounded-lg">

                    <div>
                        {!! \App\Helpers\Text::hideCut(\App\Helpers\Markdown::process($article->content)) !!}
                    </div>

                    <div class="d-flex justify-content-end">
                        <div class="px-2">
                            <i class="far fa-clock"></i>
                            <span class="px-1">
                                {{$article->created_at->format(\App\Material::DATE_FORMAT)}}
                            </span>
                        </div>
                        @if ($article->hits > 0)
                            <div class="px-2">
                                <i class="far fa-eye"></i>
                                <span class="px-1">
                                    {{$article->hits}}
                                </span>
                            </div>
                        @endif
                        <div class="px-2">
                            <i class="far fa-folder"></i>
                            <span class="px-1">
                                {{$article->category_id}}
                            </span>
                        </div>
                    </div>

                </div>

                @if ($article->allow_comments)
                    <div class="px-2 py-3">
                        @lang('articles.comments')
                    </div>
                @endif

            </div>

            <div class="col-md-3 py-3 px-2">
                <div class="card">
                    <div class="card-header">
                        Widget header
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Widget Title</h5>
                        <p class="card-text">Widget content</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection
