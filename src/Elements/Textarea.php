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
        InputCommonOptions;
    use InputDefaults {
        renderClose as renderCloseDefault;
    }

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

    /**
     * Textareas are not self-closing like regular inputs, so we need to
     * actually close the element before doing all the cleanup/container stuff.
     *
     * @return string
     */
    public function renderClose()
    {
        return '</' . $this->getTagName() . '>' . $this->renderCloseDefault();
    }
}
