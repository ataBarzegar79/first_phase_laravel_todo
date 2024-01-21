<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexTaskRequest extends FormRequest
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
            'search' => ['nullable'], //todo : what do you search ? give it as a name.
            'select' => ['nullable','in:NotCompleted,Completed'], // todo : use enums!, you haven't behaved consistent throughout your code.
        ];
    } // todo : select is not an appropriate name for your query parameter.
}
