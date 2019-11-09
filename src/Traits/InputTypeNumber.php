<?php

namespace Se7enet\Florms\Traits;

trait InputTypeNumber
{
    /**
     * Specifies the maximum value for an <input> element
     *
     * @param string $max   Number or date in 'YYYY-MM-DD' format.
     *
     * @return $this
     */
    public function max($max = '')
    {
        return $this->_attribute('max', $max);
    }

    /**
     * Specifies the minimum value for an <input> element
     *
     * @param string $min   Number or date in 'YYYY-MM-DD' format.
     *
     * @return $this
     */
    public function min($min = '')
    {
        return $this->_attribute('min', $min);
    }

    /**
     * Specifies the interval between legal numbers in an input field
     *
     * @param integer|float $step
     *
     * @return $this
     */
    public function step($step = 0)
    {
        return $this->_attribute('step', $step);
    }
}
