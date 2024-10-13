<?php

namespace App\Http\Requests\Booking;

class UpdateBookingRequest extends AbstractBookingRequest
{
    public function __construct()
    {
        parent::__construct();
    }
    public function rules()
    {
        return  array_merge($this->mutation_rules, [
            'checkin_date' => 'date'
        ]);
    }
}
