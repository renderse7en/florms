<?php

namespace Se7enet\Florms\Elements\Inputs;

use Se7enet\Florms\Traits\InputSubmitImage;

class InputSubmit extends InputButton
{
    /**
     * Include the traits.
     */
    use InputSubmitImage;

    /**
     * Constructor.
     *
     * @param array $attributes
     */
    public function __construct($attributes = [])
    {
        parent::__construct(array_merge($attributes, ['type' => 'submit']));
    }
}
