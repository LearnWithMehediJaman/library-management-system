<?php

namespace Modules\Author\Http\Requests;

use Modules\Support\Http\Requests\Request;

class AuthorValidate extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'required|min:2|max:255',
            'country' => 'nullable|min:2|max:255',
        ];
    }
}
