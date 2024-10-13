<?php


namespace App\Http\Filters;

use App\Http\Filters\Abstract\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;

class BookingFilter extends AbstractFilter
{
    public const IS_CONFIRMED = 'is_confirmed';
    public const USER_ID = 'user_id';

    protected function getCallbacks(): array
    {
        return [
            self::USER_ID => [$this, 'user_id'],
            self::IS_CONFIRMED => [$this, 'is_confirmed'],
        ];
    }

    public function is_confirmed(Builder $builder, $value)
    {
        $value = filter_var($value, FILTER_VALIDATE_BOOLEAN);
        $builder->where('is_confirmed', $value);
    }

    public function user_id(Builder $builder, $value)
    {
        $builder->where('user_id', $value);
    }
}
