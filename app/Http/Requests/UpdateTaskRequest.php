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
            'title.required' => __('messages.title_required'),
            'start_time.required' => __('messages.start_time_required'),
            'start_time.date' => __('messages.start_time_date'),
            'end_time.required' => __('messages.end_time_required'),
            'end_time.date' => __('messages.end_time_date'),
            'end_time.after_or_equal' => __('messages.end_time_after_or_equal'),
        ];
    }

}
