<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Occurrence extends Model
{
    use AsSource;

    protected $fillable = [
        'event_id',
        'date',
        'time'
    ];

    public function event()
    {
        return $this->belongsTo('App\Event');
    }
}
