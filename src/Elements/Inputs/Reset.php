<?php

namespace Se7enet\Florms\Elements\Inputs;

use Se7enet\Florms\Elements\Button;

class Reset extends Button
{
    /**
     * Constructor.
     *
     * @param array $attributes
     */
    public function __construct($attributes = [])
    {
        parent::__construct(array_merge($attributes, ['type' => 'reset']));
    }
}
