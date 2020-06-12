<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class CategoryRequest
 *
 * @package App\Http\Requests
 *
 * @author Alexander Schilling
 */
class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name'        => ['required', 'min:3', 'max:25'],
            'description' => ['nullable', 'min:3', 'max:255'],
            'slug'        => ['nullable', 'alpha_dash', 'min:3', 'max:255'],
            'material_id' => ['required', 'integer'],
            'order'       => ['nullable', 'integer'],
        ];

        if ($this->method() === 'PUT' || $this->method() === 'PATCH') {
            $slug = Rule::unique('categories')->where('material_id', (int) request('material_id'))
                                                   ->ignore($this->category->id);
            array_push($rules['slug'], $slug);

        } else {
            $slug = Rule::unique('categories')->where('material_id', (int) request('material_id'));
            array_push($rules['slug'], $slug);
        }

        return $rules;
    }
}
