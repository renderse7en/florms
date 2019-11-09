<?php

namespace Se7enet\Florms\Traits;

trait HasClipboardEvents
{
    /**
     * Fires when the user copies the content of an element
     *
     * @param string $script
     *
     * @return $this
     */
    public function onCopy($script)
    {
        return $this->_attribute('oncopy', $script);
    }

    /**
     * Fires when the user cuts the content of an element
     *
     * @param string $script
     *
     * @return $this
     */
    public function onCut($script)
    {
        return $this->_attribute('oncut', $script);
    }

    /**
     * Fires when the user pastes some content in an element
     *
     * @param string $script
     *
     * @return $this
     */
    public function onPaste($script)
    {
        return $this->_attribute('onpaste', $script);
    }
}
