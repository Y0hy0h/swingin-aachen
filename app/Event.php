<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Event extends Model
{
    use AsSource;

    /**
     * @var array
     */
    protected $fillable = [
        'title'
    ];
}
