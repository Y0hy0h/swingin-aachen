<?php

namespace App\Orchid\Screens\Event;

use App\Event;
use App\Orchid\Layouts\Event\EventListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\Layout;

class EventListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Events';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'events' => Event::paginate(),
        ];
    }

    /**
     * Button commands.
     *
     * @return Action[]
     */
    public function commandBar(): array
    {
        return [
            Link::make('Create new')
                ->icon('icon-pencil')
                ->route('platform.events.new')
        ];
    }

    /**
     * Views.
     *
     * @return Layout[]
     */
    public function layout(): array
    {
        return [
            EventListLayout::class
        ];
    }
}
