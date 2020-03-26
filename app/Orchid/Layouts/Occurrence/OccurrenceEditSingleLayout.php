<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Occurrence;

use App\Event;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Layouts\Rows;

class OccurrenceEditSingleLayout extends Rows
{
    public function fields(): array
    {
        return array_merge([
            DateTimer::make('occurrence.date')
                ->required()
                ->format("d.m.Y")
                ->value(now()->format('d.m.Y'))
                ->placeholder('')
                ->title(__('Date')),
        ], OccurrenceEditCommonFields::fields());
    }
}
