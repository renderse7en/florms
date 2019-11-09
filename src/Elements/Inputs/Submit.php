<?php

namespace Se7enet\Florms\Elements\Inputs;

use Se7enet\Florms\Elements\Button;
use Se7enet\Florms\Traits\InputSubmitImage;

class Submit extends Button
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

    /**
     * Defines that form elements should not be validated when submitted
     *
     * @param boolean $novalidate   Defaults to true when this method is called
     *                              with no arguments.
     *
     * @return $this
     */
    public function formNoValidate($novalidate = true)
    {
        return $this->_attribute('formnovalidate', !!$novalidate);
    }
}
