<?php

namespace App\Orchid\Screens\Event;

use App\Event;
use App\Occurrence;
use App\Orchid\Layouts\Occurrence\OccurrenceListLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layout;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Toast;

class EventEditScreen extends Screen
{
    public $name = 'Create Event';

    public $event = null;

    public function query(Event $event): array
    {
        $this->event = $event;

        if ($this->event->exists) {
            $this->name = 'Edit Event';
        }

        return [
            'event' => $event,
            'occurrences' => $event->occurrences()->paginate()
        ];
    }

    public function commandBar(): array
    {
        return [
            Link::make('Create Occurrences')
                ->icon('icon-calendar')
                ->route('platform.occurrences.create')
                ->canSee($this->event->exists),

            Button::make('Create Event')
                ->icon('icon-pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->event->exists),

            Button::make('Save')
                ->icon('icon-check')
                ->method('createOrUpdate')
                ->canSee($this->event->exists),

            Button::make('Remove')
                ->icon('icon-trash')
                ->confirm('Do you want to remove this event?')
                ->method('remove')
                ->canSee($this->event->exists),
        ];
    }

    public function layout(): array
    {
        return [
            Layout::rows([
                Input::make('event.title')
                    ->title('Title')
                    ->required(),
            ]),
            OccurrenceListLayout::class,
        ];
    }

    public function createOrUpdate(Event $event, Request $request)
    {
        $exists = $event->exists;
        $request->validate([
            'event.title' => 'required',
        ]);
        $event->fill($request->get('event'))->save();

        if (!$exists) {
            Alert::info('You have successfully created an event.');
        } else {
            Alert::info('You have successfully edited the event.');
        }

        return redirect()->route('platform.events.list');
    }

    public function remove(Event $event)
    {
        $event->delete()
            ? Alert::info('You have successfully deleted the event.')
            : Alert::warning('An error has occurred.');

        return redirect()->route('platform.events.list');
    }

    public function removeOccurrence(Request $request)
    {
        Occurrence::findOrFail($request->get('id'))
            ->delete();

        Alert::info(__('Occurrence was removed.'));

        return back();
    }
}
