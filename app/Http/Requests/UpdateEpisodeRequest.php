<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEpisodeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'work_id' => 'required|exists:works,id',
            'title' => 'required|string|max:255',
            'summary' => 'nullable|string',
            'anime_episode_count' => 'nullable|integer|min:0',
            'manga_volume_count' => 'nullable|integer|min:0',
            'media_type' => 'nullable|in:anime,manga,both',
        ];
    }
}
