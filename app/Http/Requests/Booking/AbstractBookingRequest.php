<?php

namespace App\Http\Requests\Booking;

use App\Http\Requests\Abstract\AbstractRequest;

abstract class AbstractBookingRequest extends AbstractRequest
{
    protected $mutation_rules = [
        'user_id' => 'nullable|exists:users,id',
        'is_confirmed' => 'boolean'
    ];

    protected $query_rules;

    public function __construct()
    {
        $this->query_rules = array_merge(
            $this->base_query_rules,
            [
                'user_id' => 'exists:users,id',
                'is_confirmed' => 'boolean'
            ]
        );
    }
}
