<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Occurrence;

use App\Event;
use Orchid\Platform\Models\Role;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;

class OccurrenceEditLayout extends Rows
{
    public function fields(): array
    {
        return [
            Relation::make('occurrence.event_id')
                ->fromModel(Event::class, 'title')
                ->required()
                ->title(__('Event')),

            DateTimer::make('occurrence.date')
                ->required()
                ->format("d.m.Y")
                ->value(now()->format('d.m.Y'))
                ->placeholder('')
                ->title(__('Date')),

            DateTimer::make('occurrence.time')
                ->required()
                ->allowInput()
                ->format24hr()
                ->noCalendar()
                ->placeholder('')
                ->format("H:i")
                ->title(__('Time')),
        ];
    }
}
