<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Quote extends Model
{
    use HasFactory;

    const WELCOME = 'welcome';
    const LANGUAGE = 'language';

    public function scopeWelcome(Builder $query)
    {
        $query->where('type', self::WELCOME);
    }

    public function getLanguageDateAttribute()
    {
        return [self::LANGUAGE => $this->attributes['language']];
    }
}
