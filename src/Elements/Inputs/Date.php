<?php

namespace Se7enet\Florms\Elements\Inputs;

use Se7enet\Florms\Elements\Input;
use Se7enet\Florms\Traits\InputTypeText;
use Se7enet\Florms\Traits\InputTypeNumber;

class Date extends Input
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
        parent::__construct(array_merge($attributes, ['type' => 'date']));
    }
}
