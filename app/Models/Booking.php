<?php

namespace App\Models;

use App\Models\Abstract\AbstractModel;
use App\Models\Traits\Filterable;

class Booking extends AbstractModel
{
    use Filterable;
    protected $fillable = [
        'user_id',
        'checkin_date',
        'is_confirmed'
    ];

    protected function casts(): array
    {
        return [
            'checkin_date' => 'datetime',
            'is_confirmed' => 'boolean'
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
