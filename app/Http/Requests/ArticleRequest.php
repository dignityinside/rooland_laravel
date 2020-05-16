<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ArticleRequest
 *
 * @package App\Http\Requests
 *
 * @author Alexander Schilling
 */
class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $rules = [
            'category_id' => ['required', 'integer'],
            'title' => ['required', 'min:3', 'max:255'],
            'content' => ['required', 'string'],
            'slug' => ['nullable', 'alpha_dash', 'min:3', 'max:255'],
            'thumbnail' => ['nullable', 'url', 'min:3', 'max:255'],
            'status_id' => ['alpha'],
            'hits' => ['integer'],
            'allow_comments' => ['integer', 'between:0,1'],
            'meta_title' => ['nullable', 'min:3', 'max:69'],
            'meta_description' => ['nullable', 'min:3', 'max:255'],
        ];

        if ($this->method() === 'PUT' || $this->method() === 'PATCH') {
            array_push($rules['slug'], 'unique:articles,slug,' . $this->article->id);
        } else {
            array_push($rules['slug'], 'unique:articles,slug');
        }

        return $rules;
    }
}
