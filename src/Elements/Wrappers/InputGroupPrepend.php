<?php

namespace Se7enet\Florms\Elements\Wrappers;

use Se7enet\Florms\FlormsFacade as Florms;

class InputGroupPrepend extends InputGroupAppend
{
    /**
     * Get the default class name for the element out of the skin configuration,
     * based on its control type.
     *
     * @return string
     */
    public function getDefaultClass()
    {
        return Florms::getSkinValue('containers.inputGroupPrepend');
    }
}
