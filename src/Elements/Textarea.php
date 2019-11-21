<?php

namespace Se7enet\Florms\Elements;

use Se7enet\Florms\Traits\HasFormEvents;
use Se7enet\Florms\Traits\InputDefaults;
use Se7enet\Florms\Traits\InputCommonOptions;
use Se7enet\Florms\Traits\InputCommonAttributes;

class Textarea extends Element
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
        return 'textarea';
    }

    /**
     * Get the type of control, for purposes of inheriting skin settings.
     *
     * @return string
     */
    public function getControlType()
    {
        return 'text';
    }
}
