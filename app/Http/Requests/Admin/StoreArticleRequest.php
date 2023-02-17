<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title'=>['required'],
            'article'=>['required'],
            'image'=>['nullable', 'image', 'dimensions:max_width=100,max_height=200'],
            'tags'=>['required'],
            'category_id'=>['required', 'integer', 'exists:categories,id']
        ];
    }
}
