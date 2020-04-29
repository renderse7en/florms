<?php

namespace Se7enet\Florms\Elements;

use Se7enet\Florms\Traits\HasFormEvents;
use Se7enet\Florms\Traits\InputDefaults;
use Se7enet\Florms\Traits\InputCommonOptions;
use Se7enet\Florms\Traits\InputCommonAttributes;

class Button extends Element
{
    /**
     * Include the traits.
     */
    use HasFormEvents,
        InputCommonAttributes,
        InputCommonOptions,
        InputDefaults;

    /**
     * Get the HTML tag name.
     *
     * @return string
     */
    public function getTagName()
    {
        return 'button';
    }

    /**
     * Get the type of control, for purposes of inheriting skin settings.
     *
     * @return string
     */
    public function getControlType()
    {
        return 'button';
    }

    /**
     * Buttons do not need a value.
     *
     * @return void
     */
    public function needsDefaultValue()
    {
        return false;
    }

    /**
     * Buttons do not need a label.
     *
     * @return void
     */
    public function needsDefaultLabel()
    {
        return false;
    }
}
