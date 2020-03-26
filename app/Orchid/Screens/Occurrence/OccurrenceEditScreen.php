<?php

namespace App\Orchid\Screens\Occurrence;

use App\Occurrence;
use App\Orchid\Layouts\Occurrence\OccurrenceEditSingleLayout;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;

class OccurrenceEditScreen extends Screen
{
    public $name = 'Create Occurrence';

    public $exists = false;

    public function query(Occurrence $occurrence): array
    {
        $this->exists = $occurrence->exists;

        if ($this->exists) {
            $this->name = 'Edit Occurrence';
        }

        return [
            'occurrence' => $occurrence,
        ];
    }

    public function commandBar(): array
    {
        return [
            Button::make('Create Occurrence')
                ->icon('icon-pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->exists),

            Button::make('Save')
                ->icon('icon-check')
                ->method('createOrUpdate')
                ->canSee($this->exists),

            Button::make('Remove')
                ->icon('icon-trash')
                ->method('remove')
                ->canSee($this->exists),
        ];
    }

    public function layout(): array
    {
        return [
            OccurrenceEditSingleLayout::class,
        ];
    }

    public function createOrUpdate(Occurrence $occurrence, Request $request)
    {
        $exists = $occurrence->exists;
        $request->validate([
            'occurrence.event_id' => 'required',
            'occurrence.date' => 'required',
            'occurrence.time' => 'required',
        ]);
        $fields = $request->get('occurrence');
        $fields = array_merge(
            $fields,
            [
                'date' => (new Carbon($fields['date']))->format('Y-m-d'),
                'time' => (new Carbon($fields['time']))->format('h:i'),
            ]
        );
        $occurrence->fill($fields)->save();

        if (!$exists) {
            Alert::info('You have successfully created an occurrence.');
        } else {
            Alert::info('You have successfully edited the occurrence.');
        }

        return redirect()->route('platform.events.edit', $occurrence->event);
    }
}
