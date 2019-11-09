<?php

namespace Se7enet\Florms\Traits;

trait HasParentControl
{
    /**
     * Set the control to which this label belongs.
     *
     * @param mixed $control
     *
     * @return $this
     */
    public function control($control)
    {
        return $this->_option('control', $control);
    }

    /**
     * Get the control to which this label belongs.
     *
     * @return mixed
     */
    public function getControl()
    {
        return $this->getOption('control');
    }
}
