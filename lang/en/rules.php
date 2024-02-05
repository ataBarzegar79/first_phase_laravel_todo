<?php

use App\Models\User;
use Illuminate\Validation\Rule;

return [
    'name_rules' => ['required', 'string', 'max:255'],
    'email_rules' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
];
