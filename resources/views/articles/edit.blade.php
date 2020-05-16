@extends('layouts.app')

@section('title', __('articles.edit_headline'))

@section('content')

    <div id="articles_edit">

        <h1>@lang('articles.edit_headline')</h1>

        @include('partials.message')

        <form method="post" action="{{ route('articles.update', ['article' => $article->slug]) }}">

            @method('PATCH')
            @csrf

            @include('articles.form')

        </form>

        <form method="post" action="{{ route('articles.destroy', ['article' => $article->slug]) }}">

            @method('DELETE')
            @csrf

            <div class="form-group">
                <button type="submit" class="btn btn-submit">@lang('articles.button_delete')</button>
            </div>

        </form>

    </div>

@endsection
