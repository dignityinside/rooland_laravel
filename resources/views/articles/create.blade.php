@extends('layouts.app')

@section('title', __('articles.create_headline'))

@section('content')

    <div id="articles_create">

        <h1>@lang('articles.create_headline')</h1>

        @include('partials.message')

        <form method="POST" action="{{ route('articles.store') }}">
            @include('articles.form')
        </form>

    </div>

@endsection
