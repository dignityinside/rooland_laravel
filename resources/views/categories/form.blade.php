@csrf

<div class="row">
    <div class="col">
        <div class="form-group">
            <label for="material_id">
                @lang('categories.form_label_material_id')
            </label>
            <select class="form-control" name="material_id" id="material_id">
                @foreach ($category::getMaterials() as $key => $value)
                    <option value="{{ $key }}" {{ ( $key == old('material_id', $category->material_id ?? null)) ? 'selected' : '' }}>
                        {{ $value }}
                    </option>
                @endforeach
            </select>
            @error('material_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <label for="slug">@lang('categories.form_label_slug')</label>
            <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" id="slug" value="{{ old('slug', $category->slug ?? null) }}">
            @error('slug')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <label for="order">@lang('categories.form_label_order')</label>
            <input type="text" name="order" class="form-control @error('order') is-invalid @enderror" id="order" value="{{ old('order', $category->order ?? null) }}">
            @error('order')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="form-group">
    <label for="name">@lang('categories.form_label_name')</label>
    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name', $category->name ?? null) }}">
    @error('name')
    <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="description">@lang('categories.form_label_description')</label>
    <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description">{{ old('description', $category->description ?? null) }}</textarea>
    @error('description')
    <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <button type="submit" class="btn btn-success btn-submit">@lang('categories.button_submit')</button>
</div>
