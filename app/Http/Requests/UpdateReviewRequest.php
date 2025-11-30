<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReviewRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'work_id' => 'required|exists:works,id',
            'title' => 'required|string|max:100',
            'body' => 'required|string|max:500',
            'score' => 'required|numeric|min:1|max:5',
            'is_spoiler' => 'nullable|boolean',
            'photos' => 'nullable|array|max:4',
            'photos.*' => 'image|mimes:jpeg,jpg,png,gif,webp|max:5120',
        ];
    }
}
