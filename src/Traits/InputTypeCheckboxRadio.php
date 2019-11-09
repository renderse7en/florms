<?php

namespace Se7enet\Florms\Traits;

trait InputTypeCheckboxRadio
{
    /**
     * For checkboxes and radios, we'll get the current default value out of
     * the session input or model, and then set the "checked" attribute
     * accordingly.
     *
     * @return void
     */
    public function setDefaultValue()
    {
        // If this already has the 'checked' attribute specified, we don't need
        // to do anything else.
        if (!$this->needsDefaultValue()) {
            return;
        }

        // Get the default value.
        $defaultValue = $this->getDefaultValue();

        // Get the actual specified value.
        $actualValue = $this->getAttribute('value');

        // If both are empty, leave everything as is.
        if (empty($defaultValue) && empty($actualValue)) {
            return;
        }

        // Set the checked attribute based on whether they match or not..
        $this->checked(($defaultValue == $actualValue));
    }

    /**
     * We need to calculate the default value if the "checked" attribute
     * doesn't exist yet.
     *
     * @return boolean
     */
    public function needsDefaultValue()
    {
        return !$this->hasAttribute('checked');
    }

    /**
     * Switches, checkboxes, and radios need their label to be rendered after
     * the element instead of before it.
     *
     * @return void
     */
    public function labelBeforeElement()
    {
        return false;
    }

    /**
     * Specifies that an <input> element should be pre-selected when the page
     * loads (for type="checkbox" or type="radio")
     *
     * @param boolean $checked  Defaults to true when this method is called with
     *                          no arguments.
     *
     * @return $this
     */
    public function checked($checked = true)
    {
        return $this->_attribute('checked', !!$checked);
    }
}
