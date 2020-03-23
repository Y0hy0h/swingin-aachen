<?php

namespace App\Orchid\Layouts\Event;

use App\Event;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class EventListLayout extends Table
{
    /**
     * Data source.
     *
     * @var string
     */
    protected $target = 'events';

    /**
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::set('title', 'Title')
                ->sort()
                ->render(function (Event $event) {
                    return Link::make($event->title)
                        ->route('platform.events.edit', $event);
                }),

            TD::set('created_at', 'Created')
                ->sort()
                ->defaultHidden()
                ->render(function (Event $event) {
                    return $event->created_at->toDateTimeString();
                }),
            TD::set('updated_at', 'Updated')
                ->sort()
                ->render(function (Event $event) {
                    return $event->updated_at->toDateTimeString();
                }),
        ];
    }
}
