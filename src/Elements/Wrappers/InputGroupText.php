<?php

namespace Se7enet\Florms\Elements\Wrappers;

use Se7enet\Florms\Elements\Div;
use Se7enet\Florms\Traits\WrapperCommon;
use Se7enet\Florms\FlormsFacade as Florm;

class InputGroupText extends Div
{
    /**
     * Traits
     */
    use WrapperCommon;

    /**
     * Add content to the input group.
     *
     * @param string $content
     *
     * @return $this
     */
    public function content($content)
    {
        return $this->_option('content', $content);
    }

    /**
     * Render the content for this element.
     *
     * @return string
     */
    public function renderContent()
    {
        return $this->getOption('content');
    }

    /**
     * Get the default class name for the element out of the skin configuration,
     * based on its control type.
     *
     * @return string
     */
    public function getDefaultClass()
    {
        return Florm::getSkinValue('containers.inputGroupText');
    }
}
