<?php

namespace Se7enet\Florms\Elements\Inputs;

use Se7enet\Florms\Traits\InputTypeSubmitImage;

class InputSubmit extends InputButton
{
    /**
     * Include the traits.
     */
    use InputTypeSubmitImage;

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
