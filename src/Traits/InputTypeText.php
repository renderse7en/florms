<?php

namespace Se7enet\Florms\Traits;

trait InputTypeText
{
    /**
     * Specifies whether an <input> element should have autocomplete enabled
     *
     * @param string $autocomplete  Allowed values are 'on' and 'off', defaults
     *                              to 'on' when this method is called with no
     *                              arguments.
     *
     * @return $this
     */
    public function autocomplete($autocomplete = 'on')
    {
        return $this->_attribute('autocomplete', strtolower($autocomplete));
    }
}
