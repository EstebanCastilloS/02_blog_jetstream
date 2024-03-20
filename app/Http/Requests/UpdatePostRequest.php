<?php

namespace App\Http\Requests;

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
            'title' => 'required',
            'slug' => 'required|unique:posts,slug,' . $this->post->id,
            'excerpt' => $this->post->published ?'required' :'',
            'body' => $this->post->published ? 'required' :'',
            'image_path' => '',
            'published' => 'required|boolean',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
            'published_at' => '',
            'image' => 'nullable|image|max:1024',


        ];
    }
}
