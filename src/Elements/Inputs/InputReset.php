<?php

namespace Se7enet\Florms\Elements\Inputs;

class InputReset extends InputButton
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
