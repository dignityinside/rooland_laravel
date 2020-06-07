@extends('layouts.app')

@section('title', __('articles.create_headline'))

@section('content')

    <div id="articles_create">

        <h1 class="text-white pb-3">
            @lang('articles.create_headline')
        </h1>

        <div class="bg-white px-3 pt-3 pb-1 rounded-lg">

            @include('partials.message')

            <form method="POST" action="{{ route('articles.store') }}">
                @include('articles.form')
            </form>

        </div>

    </div>

@endsection
