@extends('layouts.app')

@section('title', __('categories.edit_headline'))

@section('content')

    <div id="categories_edit">

        <h1 class="text-white pb-3">
            @lang('categories.edit_headline')
        </h1>

        <div class="bg-white px-3 pt-3 pb-1 rounded-lg">

            @include('partials.message')

            <form method="post" action="{{ route('categories.update', ['category' => $category->id]) }}">

                @method('PATCH')
                @csrf

                @include('categories.form')

            </form>

            <form method="post" action="{{ route('categories.destroy', ['category' => $category->id]) }}">

                @method('DELETE')
                @csrf

                <div class="form-group">
                    <button type="submit" class="btn btn-danger btn-submit">@lang('categories.button_delete')</button>
                </div>

            </form>

        </div>

    </div>

@endsection
