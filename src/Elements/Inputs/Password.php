<?php

namespace Se7enet\Florms\Elements\Inputs;

use Se7enet\Florms\Elements\Input;
use Se7enet\Florms\Traits\InputTypeText;

class Password extends Input
{
    /**
     * Include the traits.
     */
    use InputTypeText;

    /**
     * Constructor.
     *
     * @param array $attributes
     */
    public function __construct($attributes = [])
    {
        parent::__construct(array_merge($attributes, ['type' => 'password']));
    }

    /**
     * Password fields do not need a default value.
     *
     * @return boolean
     */
    public function needsDefaultValue()
    {
        return false;
    }

    /**
     * Password fields should not get a default value.
     *
     * @return null
     */
    public function getDefaultValue()
    {
        return null;
    }
}
