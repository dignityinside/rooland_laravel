@extends('layouts.app')

@section('title', __('articles.index_headline'))

@section('content')

    <div id="articles_index">

        <div class="row">

            <div class="col-md-10">
                <h1>@lang('articles.index_headline')</h1>
            </div>

            <div class="col-md-2">
                <a href="{{ route('articles.create') }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">
                    @lang('articles.button_create')
                </a>
            </div>

            <div class="col-md-12">
                <hr>
            </div>

        </div>

        <div class="row">

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
                                        <svg class="bi bi-eye-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10.5 8a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                                            <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 100-7 3.5 3.5 0 000 7z" clip-rule="evenodd"/>
                                        </svg>
                                    </a>
                                    <a href="{{ route('articles.edit', ['article' => $article->slug]) }}">
                                        <svg class="bi bi-pencil-square" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M15.502 1.94a.5.5 0 010 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 01.707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 00-.121.196l-.805 2.414a.25.25 0 00.316.316l2.414-.805a.5.5 0 00.196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 002.5 15h11a1.5 1.5 0 001.5-1.5v-6a.5.5 0 00-1 0v6a.5.5 0 01-.5.5h-11a.5.5 0 01-.5-.5v-11a.5.5 0 01.5-.5H9a.5.5 0 000-1H2.5A1.5 1.5 0 001 2.5v11z" clip-rule="evenodd"/>
                                        </svg>
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
                            <div>
                                @lang('articles.empty_text')
                            </div>
                        </div>
                    </div>

                @endif

            </div>

        </div>

    </div>

@endsection
