<?php

namespace Se7enet\Florms\Elements;

use Se7enet\Florms\Traits\HasParentControl;

class OptGroup extends Element
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
        return 'optgroup';
    }

    /**
     * Set the label attribute for the optgroup.
     *
     * @param string $label
     *
     * @return $this
     */
    public function label($label)
    {
        return $this->_attribute('label', $label);
    }
}
