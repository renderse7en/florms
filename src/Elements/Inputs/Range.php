<?php

namespace Se7enet\Florms\Elements\Inputs;

use Se7enet\Florms\Elements\Input;
use Se7enet\Florms\Traits\InputTypeText;
use Se7enet\Florms\Traits\InputTypeNumber;

class Range extends Input
{
    /**
     * Include the traits.
     */
    use InputTypeText,
        InputTypeNumber;

    /**
     * Constructor.
     *
     * @param array $attributes
     */
    public function __construct($attributes = [])
    {
        parent::__construct(array_merge($attributes, ['type' => 'range']));
    }

    /**
     * Get the type of control, for purposes of inheriting skin settings.
     *
     * @return string
     */
    public function getControlType()
    {
        return 'range';
    }
}
