<?php

namespace Se7enet\Florms\Elements\Wrappers;

use Se7enet\Florms\Elements\Div;
use Se7enet\Florms\Traits\WrapperCommon;
use Se7enet\Florms\FlormsFacade as Florms;

class InputGroupText extends Div
{
    /**
     * Traits
     */
    use WrapperCommon;

    /**
     * The input group's HTML content.
     *
     * @var string
     */
    public $content;

    /**
     * Add content to the input group.
     *
     * @param string $content
     *
     * @return $this
     */
    public function content($content)
    {
        $this->content = $content;
        
        return $this;
    }

    /**
     * Render the content for this element.
     *
     * @return string
     */
    public function renderContent()
    {
        return $this->content ?? '';
    }

    /**
     * Get the default class name for the element out of the skin configuration,
     * based on its control type.
     *
     * @return string
     */
    public function getDefaultClass()
    {
        return Florms::getSkinValue('containers.inputGroupText');
    }
}
