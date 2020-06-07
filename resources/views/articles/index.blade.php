@extends('layouts.app')

@section('title', __('articles.index_headline'))

@section('content')

    <div id="articles_index">

        <div class="row">

            <div class="col-md-10">
                <h1 class="text-white">@lang('articles.index_headline')</h1>
            </div>

            <div class="col-md-2">
                <a href="{{ route('articles.create') }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">
                    <i class="fas fa-plus-square"></i> @lang('articles.button_create')
                </a>
            </div>

            <div class="col-md-12">
                <hr>
            </div>

        </div>

        <div class="row bg-white pt-3 rounded-lg">

            <div class="col-md-12">

                @if($articles->count() > 0)

                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('articles.thead_title')</th>
                            <th>@lang('articles.thead_status')</th>
                            <th>@lang('articles.thead_hits')</th>
                            <th>@lang('articles.thead_comments')</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($articles as $article)
                            <tr>
                                <td>{{ $article->id }}</td>
                                <td>{{ $article->title }}</td>
                                <td>{{ $article->status_id }}</td>
                                <td>{{ $article->hits }}</td>
                                <td>{{ $article->comments ?? 0 }}</td>
                                <td>
                                    <a href="{{ route('articles.show', ['article' => $article->slug]) }}">
                                        <i class="far fa-eye"></i>
                                    </a>
                                    <a href="{{ route('articles.edit', ['article' => $article->slug]) }}">
                                        <i class="far fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    {{ $articles->links() }}

                @else

                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="pb-3">
                                @lang('articles.empty_text')
                            </div>
                        </div>
                    </div>

                @endif

            </div>

        </div>

    </div>

@endsection
