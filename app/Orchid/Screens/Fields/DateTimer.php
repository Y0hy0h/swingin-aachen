<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Fields;

/**
 * A variant of Orchid's `DateTimer` that can be configured for
 * selection of multiple dates at once.
 */
class DateTimer extends \Orchid\Screen\Fields\DateTimer
{
    function __construct()
    {
        $this->attributes = array_merge($this->attributes, [
            'data-fields--datetime-mode' => 'single',
        ]);
        $this->inlineAttributes = array_merge($this->inlineAttributes, [
            'data-fields--datetime-mode',
        ]);
    }


    /**
     * Enable selection of multiple dates.
     *
     * @param bool $multiple
     *
     * @return \Orchid\Screen\Fields\DateTimer
     */
    public function multipleSelections(bool $multiple = true): self
    {
        $this->set('data-fields--datetime-mode', 'multiple');

        return $this;
    }
}
