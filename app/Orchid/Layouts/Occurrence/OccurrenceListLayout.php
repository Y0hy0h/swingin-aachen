<?php

namespace App\Orchid\Layouts\Occurrence;

use App\Occurrence;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class OccurrenceListLayout extends Table
{
    protected $target = 'occurrences';

    protected function columns(): array
    {
        return [
            TD::set('date', 'Date')
                ->sort()
                ->render(function (Occurrence $occurrence) {
                    return $occurrence->date;
                }),
            TD::set('time', 'Time')
                ->sort()
                ->render(function (Occurrence $occurrence) {
                    return $occurrence->time;
                }),

            TD::set('created_at', 'Created')
                ->sort()
                ->defaultHidden()
                ->render(function (Occurrence $occurrence) {
                    return $occurrence->created_at->toDateTimeString();
                }),
            TD::set('updated_at', 'Updated')
                ->sort()
                ->render(function (Occurrence $occurrence) {
                    return $occurrence->updated_at->toDateTimeString();
                }),


            TD::set('id', '')
                ->render(function (Occurrence $occurrence) {
                    return DropDown::make()
                        ->icon('icon-options-vertical')
                        ->list([
                            Link::make(__('Edit'))
                                ->route(
                                    'platform.occurrences.edit',
                                    $occurrence->id
                                )
                                ->icon('icon-pencil'),

                            Button::make(__('Delete'))
                                ->method('removeOccurrence')
                                ->confirm(__('Are you sure you want to delete the occurrence?'))
                                ->parameters([
                                    'id' => $occurrence->id,
                                ])
                                ->icon('icon-trash'),
                        ]);
                }),
        ];
    }
}
