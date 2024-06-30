<?php

namespace Modules\Category\Http\Requests;

use Modules\Support\Http\Requests\Request;

class CategoryValidate extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'required',
        ];
    }
}
