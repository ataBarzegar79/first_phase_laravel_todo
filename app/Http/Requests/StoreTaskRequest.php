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
            'title' => ['required','max:100'],
            'task_status' => ['required','in:NotCompleted,Completed'], // todo : use enums
            'description' => ['required'], // todo : it seems sensible to set a limit
            'deadline' => ['required','date','after:today']
        ];
    }
}
