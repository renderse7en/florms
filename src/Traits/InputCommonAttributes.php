<?php

namespace Se7enet\Florms\Traits;

trait InputCommonAttributes
{
    /**
     * Specifies that an <input> element should automatically get focus when the
     * page loads
     *
     * @param boolean $autofocus    Defaults to true when this method is called
     *                              with no arguments.
     *
     * @return $this
     */
    public function autofocus($autofocus = true)
    {
        return $this->_attribute('autofocus', !!$autofocus);
    }

    /**
     * Specifies that an <input> element should be disabled
     *
     * @param boolean $disabled Defaults to true when this method is called
     *                          with no arguments.
     *
     * @return $this
     */
    public function disabled($disabled = true)
    {
        return $this->_attribute('disabled', !!$disabled);
    }

    /**
     * Specifies the form the <input> element belongs to
     *
     * @param string $formId
     *
     * @return $this
     */
    public function form($formId = '')
    {
        return $this->_attribute('form', $formId);
    }

    /**
     * Specifies the name of an <input> element
     *
     * @param string $name
     *
     * @return $this
     */
    public function name($name = '')
    {
        return $this->_attribute('name', $name);
    }

    /**
     * Specifies that an input field must be filled out before submitting the
     * form
     *
     * @param boolean $required Defaults to true when this method is called with
     *                          no arguments.
     *
     * @return $this
     */
    public function required($required = true)
    {
        return $this->_attribute('required', !!$required);
    }
}
