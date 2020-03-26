<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Occurrence;

use App\Event;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Layouts\Rows;

class OccurrenceEditCommonFields
{
    public static function fields(): array
    {
        return [
            Input::make('occurrence.time')
                ->required()
                ->type('time')
                ->title(__('Time')),

            Relation::make('occurrence.event_id')
                ->fromModel(Event::class, 'title')
                ->required()
                ->title(__('Event')),
        ];
    }
}
