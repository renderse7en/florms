<?php

namespace Se7enet\Florms\Traits;

trait HasMouseEvents
{
    /**
     * Fires on a mouse click on the element
     *
     * @param string $script
     *
     * @return $this
     */
    public function onClick($script)
    {
        return $this->_attribute('onclick', $script);
    }

    /**
     * Fires on a mouse double-click on the element
     *
     * @param string $script
     *
     * @return $this
     */
    public function onDblClick($script)
    {
        return $this->_attribute('ondblclick', $script);
    }

    /**
     * Fires when a mouse button is pressed down on an element
     *
     * @param string $script
     *
     * @return $this
     */
    public function onMouseDown($script)
    {
        return $this->_attribute('onmousedown', $script);
    }

    /**
     * Fires when the mouse pointer is moving while it is over an element
     *
     * @param string $script
     *
     * @return $this
     */
    public function onMouseMove($script)
    {
        return $this->_attribute('onmousemove', $script);
    }

    /**
     * Fires when the mouse pointer moves out of an element
     *
     * @param string $script
     *
     * @return $this
     */
    public function onMouseOut($script)
    {
        return $this->_attribute('onmouseout', $script);
    }

    /**
     * Fires when the mouse pointer moves over an element
     *
     * @param string $script
     *
     * @return $this
     */
    public function onMouseOver($script)
    {
        return $this->_attribute('onmouseover', $script);
    }

    /**
     * Fires when a mouse button is released over an element
     *
     * @param string $script
     *
     * @return $this
     */
    public function onMouseUp($script)
    {
        return $this->_attribute('onmouseup', $script);
    }

    /**
     * Use the onwheel attribute instead
     *
     * @deprecated
     *
     * @param string $script
     *
     * @return $this
     */
    public function onMouseWheel($script)
    {
        return $this->onWheel($script);
    }

    /**
     * Fires when the mouse wheel rolls up or down over an element
     *
     * @param string $script
     *
     * @return $this
     */
    public function onWheel($script)
    {
        return $this->_attribute('onwheel', $script);
    }
}
