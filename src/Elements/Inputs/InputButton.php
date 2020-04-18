<?php

namespace Se7enet\Florms\Elements\Inputs;

use Se7enet\Florms\Elements\Input;

class InputButton extends Input
{
    /**
     * Constructor.
     *
     * @param array $attributes
     */
    public function __construct($attributes = [])
    {
        parent::__construct(array_merge($attributes, ['type' => 'button']));
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
     * Buttons do not need a label.
     *
     * @return void
     */
    public function needsDefaultLabel()
    {
        return false;
    }
}
