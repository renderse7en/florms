<?php

namespace Se7enet\Florms\Elements\Inputs;

use Se7enet\Florms\FlormsFacade as Florms;

class Toggles extends Checkboxes
{
    /**
     * Get the element to be used in this checkbox/radio/whatever group.
     *
     * @param array $options
     *
     * @return Toggle
     */
    public function getOptionElement($options = [])
    {
        return Florms::toggle($options);
    }
}
