<?php

namespace Se7enet\Florms\Elements\Inputs;

use Se7enet\Florms\Elements\Input;

class Hidden extends Input
{
    /**
     * Constructor.
     *
     * @param array $attributes
     */
    public function __construct($attributes = [])
    {
        parent::__construct(array_merge($attributes, ['type' => 'hidden']));
    }

    /**
     * The hidden input type is, obviously, invisible, so it does not need a
     * default class.
     *
     * @return boolean
     */
    public function needsDefaultClass()
    {
        return false;
    }

    /**
     * The hidden input type is, obviously, invisible, so it does not need a
     * form group wrapper.
     *
     * @return boolean
     */
    public function needsDefaultFormGroup()
    {
        return false;
    }
}
