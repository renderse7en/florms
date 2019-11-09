<?php

namespace Se7enet\Florms\Elements\Inputs;

use Se7enet\Florms\Traits\InputTypeCheckboxRadio;

class Toggle extends Checkbox
{
    /**
     * Include the traits.
     */
    use InputTypeCheckboxRadio;

    /**
     * Constructor.
     *
     * @param array $attributes
     */
    public function __construct($attributes = [])
    {
        parent::__construct(array_merge($attributes, ['type' => 'checkbox']));
    }

    /**
     * Get the type of control, for purposes of inheriting skin settings. This
     * can be overridden by other classes, but the default is simply 'text' as
     * that is the most common.
     *
     * @return string
     */
    public function getControlType()
    {
        return 'switch';
    }
}
