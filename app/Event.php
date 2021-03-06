<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Event extends Model
{
    use AsSource;

    protected $fillable = [
        'title'
    ];

    public function occurrences()
    {
        return $this->hasMany('App\Occurrence');
    }
}
