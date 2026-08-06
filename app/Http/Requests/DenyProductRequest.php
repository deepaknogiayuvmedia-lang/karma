<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DenyProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id'           => 'required|integer|exists:products,id',
            'denied_note'  => 'required|string|max:500',
        ];
    }

    public function messages()
    {
        return [
            'id.required'          => 'Product ID is required!',
            'id.exists'            => 'Product not found!',
            'denied_note.required' => 'Rejection reason is required!',
            'denied_note.max'      => 'Rejection reason cannot exceed 500 characters!',
        ];
    }
}
