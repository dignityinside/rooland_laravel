@csrf

<div class="row">
    <div class="col">
        <div class="form-group">
            <label for="category_id">@lang('articles.form_label_category')</label>
            <select class="form-control" name="category_id" id="category_id">
                @foreach ($article->getCategories() as $key => $value)
                    <option value="{{ $key }}" {{ ( $key == old('category_id', $article->category_id ?? null)) ? 'selected' : '' }}>
                        {{ $value }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <label for="status_id">@lang('articles.form_label_status')</label>
            <select class="form-control" name="status_id" id="status_id">
                @foreach ($article::getStatus() as $key => $value)
                    <option value="{{ $key }}" {{ ( $key == old('status_id', $article->status_id ?? null)) ? 'selected' : '' }}>
                        {{ $value }}
                    </option>
                @endforeach
            </select>
            @error('status_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <label for="slug">@lang('articles.form_label_slug')</label>
            <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" id="slug" value="{{ old('slug', $article->slug ?? null) }}">
            @error('slug')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <label for="thumbnail">@lang('articles.form_label_thumbnail')</label>
            <input type="text" name="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror" id="thumbnail" value="{{ old('thumbnail', $article->thumbnail ?? null) }}">
            @error('thumbnail')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="form-group">
    <label for="title">@lang('articles.form_label_title')</label>
    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" value="{{ old('title', $article->title ?? null) }}">
    @error('title')
    <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="content">@lang('articles.form_label_content')</label>
    <textarea name="content" class="form-control @error('content') is-invalid @enderror" id="content">{{ old('content', $article->content ?? null) }}</textarea>
    @error('content')
    <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="row">
    <div class="col">
        <div class="form-group">
            <label for="meta_title">@lang('articles.form_label_meta_title')</label>
            <input type="text" name="meta_title" class="form-control @error('meta_title') is-invalid @enderror" id="meta_title" value="{{ old('meta_title', $article->meta_title ?? null) }}">
            @error('meta_title')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <label for="meta_description">@lang('articles.form_label_meta_description')</label>
            <input type="text" name="meta_description" class="form-control @error('meta_description') is-invalid @enderror" id="meta_description" value="{{ old('meta_description', $article->meta_description ?? null) }}">
            @error('meta_description')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="form-group">
    <div class="form-check">
        <input type="hidden" name="allow_comments" value="0">
        <input class="form-check-input" type="checkbox" name="allow_comments" id="allow_comments" {{ old('allow_comments', $article->allow_comments ?? null) ? 'checked' : '' }} value="1">
        <label class="form-check-label" for="allow_comments">@lang('articles.form_label_allow_comments')</label>
    </div>
    @error('allow_comments')
    <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <button type="submit" class="btn btn-success btn-submit">@lang('articles.button_submit')</button>
</div>
