<?php

namespace Se7enet\Florms\Elements;

use Se7enet\Florms\Traits\HasParentControl;

class Option extends Element
{
    /**
     * Include the traits.
     */
    use HasParentControl;

    /**
     * Get the HTML tag name.
     *
     * @return string
     */
    public function getTagName()
    {
        return 'option';
    }

    public function setDefaults()
    {
        // Set the default selected value.
        $this->setDefaultSelected();
    }

    public function setDefaultSelected()
    {
        $control = $this->getControl();

        $selectValue = $control->getOption('value');
        $optionValue = $this->getAttribute('value');

        if ((is_array($selectValue) && in_array($optionValue, $selectValue)) || $selectValue == $optionValue) {
            $this->selected();
        }
    }

    public function selected($selected = true)
    {
        return $this->_attribute('selected', !!$selected);
    }

    /**
     * Set the value of this option.
     *
     * @param mixed $value
     *
     * @return $this
     */
    public function value($value)
    {
        return $this->_attribute('value', $value);
    }
}
