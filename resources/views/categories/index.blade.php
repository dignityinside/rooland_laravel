@extends('layouts.app')

@section('title', __('categories.index_headline'))

@section('content')

    <div id="categories_index">

        <div class="row">

            <div class="col-md-10">
                <h1 class="text-white">@lang('categories.index_headline')</h1>
            </div>

            <div class="col-md-2">
                <a href="{{ route('categories.create') }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">
                    <i class="fas fa-plus-square"></i> @lang('categories.button_create')
                </a>
            </div>

            <div class="col-md-12">
                <hr>
            </div>

        </div>

        <div class="row bg-white pt-3 rounded-lg">

            <div class="col-md-12">

                @if($categories->count() > 0)

                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('categories.thead_name')</th>
                            <th>@lang('categories.thead_slug')</th>
                            <th>@lang('categories.thead_material_id')</th>
                            <th>@lang('categories.thead_order')</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->slug }}</td>
                                <td>{{ \App\Material::getMaterials()[$category->material_id] }}</td>
                                <td>{{ $category->order }}</td>
                                <td>
                                    @if((int) $category->material_id === \App\Material::MATERIAL_ARTICLE_ID)
                                        <a href="{{ route('articles.category', ['id' => $category->slug]) }}">
                                            <i class="far fa-eye"></i>
                                        </a>
                                    @endif
                                    <a href="{{ route('categories.edit', ['category' => $category->id]) }}">
                                        <i class="far fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    {{ $categories->links() }}

                @else

                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="pb-3">
                                @lang('categories.empty_text')
                            </div>
                        </div>
                    </div>

                @endif

            </div>

        </div>

    </div>

@endsection
