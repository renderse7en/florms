<?php

namespace Se7enet\Florms\Elements\Inputs;

use Se7enet\Florms\Traits\InputTypeNumber;

class Week extends Input
{
    /**
     * Include the traits.
     */
    use InputTypeNumber;

    /**
     * Constructor.
     *
     * @param array $attributes
     */
    public function __construct($attributes = [])
    {
        parent::__construct(array_merge($attributes, ['type' => 'week']));
    }
}
