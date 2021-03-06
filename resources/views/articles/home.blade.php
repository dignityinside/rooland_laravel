@extends('layouts.app')

@section('title', __('articles.home_headline'))

@section('content')

    <div id="articles_home">

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1 class="text-white">
                    <i class="fas fa-feather px-2"></i>
                    @lang('articles.home_headline')
                </h1>
            </div>
        </div>

        @include('articles.partials.articles-list')

    </div>

@endsection
