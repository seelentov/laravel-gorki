<?php

namespace App\Http\Requests\Booking;

class IndexBookingRequest extends AbstractBookingRequest
{
    public function __construct()
    {
        parent::__construct();
    }
    public function rules()
    {
        return $this->query_rules;
    }
}
