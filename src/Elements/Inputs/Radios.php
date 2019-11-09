<?php

namespace Se7enet\Florms\Elements\Inputs;

use Se7enet\Florms\FlormsFacade as Florm;

class Radios extends Checkboxes
{
    /**
     * Get the element to be used in this checkbox/radio/whatever group.
     *
     * @param array $options
     *
     * @return Radio
     */
    public function getOptionElement($options = [])
    {
        return Florm::radio($options);
    }
}
