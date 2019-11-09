<?php

namespace Se7enet\Florms\Traits;

trait HasKeyboardEvents
{
    /**
     * Fires when a user is pressing a key
     *
     * @param string $script
     *
     * @return $this
     */
    public function onKeyDown($script)
    {
        return $this->_attribute('onkeydown', $script);
    }

    /**
     * Fires when a user presses a key
     *
     * @param string $script
     *
     * @return $this
     */
    public function onKeyPress($script)
    {
        return $this->_attribute('onkeypress', $script);
    }

    /**
     * Fires when a user releases a key
     *
     * @param string $script
     *
     * @return $this
     */
    public function onKeyUp($script)
    {
        return $this->_attribute('onkeyup', $script);
    }
}
