<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
            'start_time' => 'required|date',
            'end_time' => 'required|date|after_or_equal:start_time',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        // todo : use language files.
        return [
            'title.required' => 'The title field is required.',
            'start_time.required' => 'The start time field is required.',
            'start_time.date' => 'The start time must be a valid date.',
            'end_time.required' => 'The end time field is required.',
            'end_time.date' => 'The end time must be a valid date.',
            'end_time.after_or_equal' => 'The end time must be a date after or equal to the start time.',
        ];
    }
}
