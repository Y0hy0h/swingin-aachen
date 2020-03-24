<?php

namespace App\Orchid\Screens\Occurrence;

use App\Occurrence;
use App\Orchid\Layouts\Occurrence\OccurrenceCreateBatchLayout;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;

class OccurrenceBatchCreateScreen extends Screen
{
    public $name = 'Create Occurrences';

    public function query(): array
    {
        return [];
    }

    public function commandBar(): array
    {
        return [

            Button::make('Create Occurrences')
                ->icon('icon-pencil')
                ->method('createBatch'),
        ];
    }

    public function layout(): array
    {
        return [
            OccurrenceCreateBatchLayout::class
        ];
    }


    public function createBatch(Request $request)
    {
        $request->validate([
            'occurrence.event_id' => 'required',
            'occurrence.dates' => [
                    'required',
                    // Check date format
                    function ($attribute, $value, $fail) {
                        $dates = explode(", ", $value);
                        foreach ($dates as $date) {
                            try {
                                new Carbon($date);
                            } catch (\Exception $e) {
                                $fail($attribute . ' contains invalid date: ' . $date);
                            }
                        }
                    },
                ],
            'occurrence.time' => 'required',
        ]);
        $rawFields = $request->get('occurrence');
        $dates = explode(", ", $rawFields['dates']);
        $fields = array_merge(
            $rawFields,
            [
                'time' => (new Carbon($rawFields['time']))->format('h:i'),
            ]
        );
        foreach ($dates as $date) {
            $fields = array_merge(
                $rawFields,
                [
                    'date' => (new Carbon($date))->format('Y-m-d'),
                ]
            );
            Occurrence::create($fields);
        }

        Alert::info('You have successfully created ' . count($dates) . ' occurrences.');

        return redirect()->route('platform.events.list', $request->get('occurrence.event_id'));
    }
}
