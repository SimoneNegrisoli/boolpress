<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'title' => ['required', 'min:3', 'max:200', 'unique:posts'],
            'body' => ['nullable'],
            'image' => ['nullable', 'url']
        ];
    }


    public function messages()
    {
        return [
            'title.required' => 'il titolo è obbligatorio',
            'title.min' => 'il titolo deve essere di almeno :min',
            'title.max' => 'il titolo deve essere di almeno :max',
            'title.unique' => 'il titolo deve essere unico',
            'image.url' => 'L\'immagine deve essere di tipo url',
        ];
    }
}

