<?php

namespace App\Traits;

use Carbon\Carbon;

trait FormatDates
{
    public function getFormatDate($value, $format = 'Y-m-d')
    {
        if ($format === false) {
            return ! empty($value) ? Carbon::parse($value)->timezone(config('app.timezone')) : null;
        }

        return ! empty($value) ? Carbon::parse($value)->timezone(config('app.timezone'))->format($format) : null;
    }

    public function setFormatDate($field, $value, $format = 'Y-m-d')
    {
        $this->attributes[$field] = ! empty($value) ? Carbon::createFromFormat($format, $value, config('app.timezone'))->tz(config('app.timezone')) : null;
    }

    public function getCreatedAtAttribute($value)
    {
        return $this->getFormatDate($value, false);
    }

    public function setCreatedAtAttribute($value)
    {
        $this->setFormatDate('created_at', $value, 'Y-m-d H:i:s');
    }

    public function getUpdatedAtAttribute($value)
    {
        return $this->getFormatDate($value, false);
    }

    public function setUpdatedAtAttribute($value)
    {
        $this->setFormatDate('updated_at', $value, 'Y-m-d H:i:s');
    }

    public function dateIsGreaterThan($date, $date_)
    {
        return $this->getFormatDate($date, false)->greaterThan($this->getFormatDate($date_, false));
    }

    public function dateIsLessThan($date, $date_)
    {
        return $this->getFormatDate($date, false)->lessThan($this->getFormatDate($date_, false));
    }

    public function currentTime()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now(), config('app.timezone'))->tz(config('app.timezone'));
    }
}
