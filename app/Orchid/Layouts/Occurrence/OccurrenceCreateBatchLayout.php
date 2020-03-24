<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Occurrence;

use App\Orchid\Screens\Fields\DateTimer;
use Orchid\Screen\Layouts\Rows;

class OccurrenceCreateBatchLayout extends Rows
{
    public function fields(): array
    {
        return array_merge([
            DateTimer::make('occurrence.dates')
                ->multipleSelections()
                ->required()
                ->format("d.m.Y")
                ->placeholder('')
                ->title(__('Dates')),
        ], OccurrenceEditCommonFields::fields());
    }
}
