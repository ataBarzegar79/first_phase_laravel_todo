<?php

namespace App\Http\Requests;

use App\Enums\Order;
use App\Enums\Sort;
use App\Enums\Status;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

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
            'filter' => ['string', new Enum(Status::class)],
            'sort' => ['string', new Enum(Sort::class)],
            'order' => ['string', new Enum(Order::class)],
        ];
    }
}
