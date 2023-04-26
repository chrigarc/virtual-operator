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
    const FUN_FACT = 'fun-fact';
    const ASK = 'ask';
    const BYE = 'bye';

    public function scopeWelcome(Builder $query)
    {
        $query->where('type', self::WELCOME);
    }

    public function scopeFunFact(Builder $query)
    {
        $query->where('type', self::FUN_FACT);
    }

    public function scopeAsk(Builder $query)
    {
        $query->where('type', self::ASK);
    }

    public function scopeBye(Builder $query)
    {
        $query->where('type', self::BYE);
    }

    public function getLanguageDataAttribute()
    {
        return [self::LANGUAGE => $this->attributes['language']];
    }
}
