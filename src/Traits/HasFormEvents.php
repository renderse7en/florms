<?php

namespace Se7enet\Florms\Traits;

trait HasFormEvents
{
    /**
     * Fires the moment that the element loses focus
     *
     * @param string $script
     *
     * @return $this
     */
    public function onBlur($script)
    {
        return $this->_attribute('onblur', $script);
    }

    /**
     * Fires the moment when the value of the element is changed
     *
     * @param string $script
     *
     * @return $this
     */
    public function onChange($script)
    {
        return $this->_attribute('onchange', $script);
    }

    /**
     * Script to be run when a context menu is triggered
     *
     * @param string $script
     *
     * @return $this
     */
    public function onContextMenu($script)
    {
        return $this->_attribute('oncontextmenu', $script);
    }

    /**
     * Fires the moment when the element gets focus
     *
     * @param string $script
     *
     * @return $this
     */
    public function onFocus($script)
    {
        return $this->_attribute('onfocus', $script);
    }

    /**
     * Script to be run when an element gets user input
     *
     * @param string $script
     *
     * @return $this
     */
    public function onInput($script)
    {
        return $this->_attribute('oninput', $script);
    }

    /**
     * Script to be run when an element is invalid
     *
     * @param string $script
     *
     * @return $this
     */
    public function onInvalid($script)
    {
        return $this->_attribute('oninvalid', $script);
    }

    /**
     * Fires when the Reset button in a form is clicked
     *
     * @param string $script
     *
     * @return $this
     */
    public function onReset($script)
    {
        return $this->_attribute('onreset', $script);
    }

    /**
     * Fires when the user writes something in a search field (for
     * <input type="search">)
     *
     * @param string $script
     *
     * @return $this
     */
    public function onSearch($script)
    {
        return $this->_attribute('onsearch', $script);
    }

    /**
     * Fires after some text has been selected in an element
     *
     * @param string $script
     *
     * @return $this
     */
    public function onSelect($script)
    {
        return $this->_attribute('onselect', $script);
    }

    /**
     * Fires when a form is submitted
     *
     * @param string $script
     *
     * @return $this
     */
    public function onSubmit($script)
    {
        return $this->_attribute('onsubmit', $script);
    }
}
