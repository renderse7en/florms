<?php

namespace Se7enet\Florms\Elements\Wrappers;

use Se7enet\Florms\Elements\Div;
use Se7enet\Florms\Traits\WrapperCommon;
use Se7enet\Florms\FlormsFacade as Florm;
use Se7enet\Florms\Traits\HasParentControl;

class ErrorMessages extends Div
{
    /**
     * Traits
     */
    use HasParentControl, 
        WrapperCommon;

    /**
     * Get the default class name for the element out of the skin configuration,
     * based on its control type.
     *
     * @return string
     */
    public function getDefaultClass()
    {
        return Florm::getSkinValue('containers.invalidFeedback');
    }
}
