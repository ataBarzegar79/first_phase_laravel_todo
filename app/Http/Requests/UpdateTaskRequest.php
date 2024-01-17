<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
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
            'started_at' => 'required|date',
            'ended_at' => 'required|date|after_or_equal:started_at',
            'status' => 'string',
        ];
    }

    public function messages()
    {
        // todo : use language files.
        return [
            'title.required' => 'The title field is required.',
            'started_at.required' => 'The start time field is required.',
            'started_at.date' => 'The start time must be a valid date.',
            'ended_at.required' => 'The end time field is required.',
            'ended_at.date' => 'The end time must be a valid date.',
            'ended_at.after_or_equal' => 'The end time must be a date after or equal to the start time.',
        ];
    }

}
