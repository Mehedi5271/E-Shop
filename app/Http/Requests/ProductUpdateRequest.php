<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
            'title' => 'required||min:5|',
            'price' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:png,jpg,jpeg,webp|max:2048'

        ];
    }

    public function messages()
    {
        return[
            'title.required' => 'The title field is required.',
            'title.min' => 'minimum 5 character dite hobe',

        ];
    }
}
