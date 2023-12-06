<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'title' => 'required|min:3|max:30',
            'description' => 'required|min:5',
            'image' => 'min:4',
            'github_link' => 'url',
        ];
    }
    public function messages(){
        return [
            'title.required' => 'Il titolo è obbligatorio',
            'title.min' => 'Il titolo deve essere minore di 3 caratteri',
            'title.max' => 'Il titolo deve essere maggiore di 30 caratteri',
            'description.required' => 'La descrizione è obbligatoria',
            'description.min' => 'La descrizione deve essere minore di 5 caratteri',
            'image.min' => 'L\'immagine deve essere maggiore di 4 caratteri',
            'github_link.url' => 'Il link deve essere un URL',

        ];
    }
}
