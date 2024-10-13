<?php

namespace App\Http\Requests\Abstract;

use Illuminate\Foundation\Http\FormRequest;

abstract class AbstractRequest extends FormRequest
{
    protected $base_query_rules = [
        "limit" => "integer",
        "offset" => "integer",
    ];

    public function authorize()
    {
        return true;
    }
}
