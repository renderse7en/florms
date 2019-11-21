<?php

namespace Se7enet\Florms\Traits;

trait HasParentControl
{
    /**
     * The parent control to which this element belongs to.
     *
     * @var mixed
     */
    public $control;

    /**
     * Set the control to which this label belongs.
     *
     * @param mixed $control
     *
     * @return $this
     */
    public function control($control)
    {
        $this->control = $control;

        return $this;
    }

    /**
     * Get the control to which this label belongs.
     *
     * @return mixed
     */
    public function getControl()
    {
        return $this->control;
    }
}
