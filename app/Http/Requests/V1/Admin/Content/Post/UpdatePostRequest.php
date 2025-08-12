<?php

namespace App\Http\Requests\V1\Admin\Content\Post;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required','string','min:1','max:255'],
            'body' => ['required','string','min:1'],
            'image' => ['nullable','image'],
            'category_id' => ['required','integer','exists:categories,id'],
        ];
    }
}
