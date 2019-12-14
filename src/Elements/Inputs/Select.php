<?php

namespace Se7enet\Florms\Elements\Inputs;

use Se7enet\Florms\Elements\Select as SelectElement;

class Select extends SelectElement
{
    /**
     * Specifies that a user can enter more than one value in an <input>
     * element
     *
     * @param boolean $multiple
     *
     * @return $this
     */
    public function multiple($multiple = true)
    {
        return $this->_attribute('multiple', !!$multiple);
    }

    /**
     * Set the array of all possible options for the <select> element. If a
     * 1D array is passed, each entry's key will be the option's value, and the
     * entry's value will be the option's content (displayed text). If a 2D
     * array is passed, each element in the 1st dimension will be rendered
     * as an <optgroup> with its key as the label, and the 2nd dimension will
     * become the options within that <optgroup>.
     *
     * @param array $options
     *
     * @return $this
     */
    public function options($options = [])
    {
        $this->options = $options;
        
        return $this;
    }

    /**
     * Defines the number of visible options in a drop-down list
     *
     * @param integer $size
     *
     * @return $this
     */
    public function size($size = 0)
    {
        return $this->_attribute('size', intval($size));
    }

    /**
     * Set the selected <option> for this <select> tag.
     *
     * @param mixed $value
     *
     * @return $this
     */
    public function value($value = '')
    {
        $this->value = $value;

        return $this;
    }
}
