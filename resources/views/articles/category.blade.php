@extends('layouts.app')

@section('title', $category->name)

@section('content')

    <div id="articles_category">

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1 class="text-white">
                    <i class="fas fa-folder px-2"></i>
                    {{ $category->name }}
                </h1>
            </div>
        </div>

        @include('articles.partials.articles-list')

    </div>

@endsection
