<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class DateTimeAfterNow implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $date = $value['date'] ?? null;
        $time = $value['time'] ?? null;

        if (is_null($date)) {
            if (is_null($time)) {
                return true;
            } else {
                return false;
            }
        }

        $dateTime = Carbon::parse($date . ' ' . ($time ?? '00:00'));

        return $dateTime > Carbon::now();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Некорректное время действия ссылки.';
    }
}
