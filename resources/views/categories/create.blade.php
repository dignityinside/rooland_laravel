@extends('layouts.app')

@section('title', __('categories.create_headline'))

@section('content')

    <div id="categories_create">

        <h1 class="text-white pb-3">
            @lang('categories.create_headline')
        </h1>

        <div class="bg-white px-3 pt-3 pb-1 rounded-lg">

            @include('partials.message')

            <form method="POST" action="{{ route('categories.store') }}">
                @include('categories.form')
            </form>

        </div>

    </div>

@endsection
