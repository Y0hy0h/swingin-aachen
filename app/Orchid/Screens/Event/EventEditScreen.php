<?php

namespace App\Orchid\Screens\Event;

use App\Event;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layout;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;

class EventEditScreen extends Screen
{
    public $name = 'Create Event';

    public $exists = false;

    public function query(Event $event): array
    {
        $this->exists = $event->exists;

        if ($this->exists) {
            $this->name = 'Edit Event';
        }

        return [
            'event' => $event
        ];
    }

    public function commandBar(): array
    {
        return [
            Button::make('Create Event')
                ->icon('icon-pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->exists),

            Button::make('Update')
                ->icon('icon-note')
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
            Layout::rows([
                Input::make('event.title')
                    ->title('Title')
                ->required(),
            ])
        ];
    }

    public function createOrUpdate(Event $event, Request $request)
    {
        $request->validate([
            'event.title' => 'required|unique:events,title',
        ]);
        $event->fill($request->get('event'))->save();

        if (!$this->exists) {
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
            : Alert::warning('An error has occurred');

        return redirect()->route('platform.events.list');
    }
}
