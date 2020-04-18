<?php

namespace Se7enet\Florms\Elements\Inputs;

use Se7enet\Florms\Elements\Button as ButtonElement;

class Button extends ButtonElement
{
    /**
     * Constructor.
     *
     * @param array $attributes
     */
    public function __construct($attributes = [])
    {
        parent::__construct(array_merge($attributes, ['type' => 'button']));
    }

    /**
     * Buttons do not need a value.
     *
     * @return void
     */
    public function needsDefaultValue()
    {
        return false;
    }

    /**
     * Buttons do not need a label.
     *
     * @return void
     */
    public function needsDefaultLabel()
    {
        return false;
    }

    /**
     * Specifies the type <button> element to display
     *
     * @param string $type  Allowed values are:
     *                      - 'button'
     *                      - 'reset'
     *                      - 'submit'
     *
     * @return $this
     */
    public function type($type = 'button')
    {
        return $this->_attribute('type', $type);
    }

    /**
     * Specifies the value of an <input> element
     *
     * @param string $value
     *
     * @return $this
     */
    public function value($value = '')
    {
        return $this->_attribute('value', $value);
    }
}
