<?php

namespace Se7enet\Florms\Elements\Wrappers;

use Se7enet\Florms\Elements\Div;
use Se7enet\Florms\Traits\WrapperCommon;
use Se7enet\Florms\FlormsFacade as Florms;

class InputGroupAppend extends Div
{
    /**
     * Traits
     */
    use WrapperCommon;

    /**
     * Array of InputGroupText divs, which will constitute the content of this
     * InputGroupAppend.
     *
     * @var InputGroupText[]
     */
    public $contents;

    /**
     * Add an array of InputGroupText divs.
     *
     * @param InputGroupText[] $contents
     *
     * @return $this
     */
    public function contents($contents)
    {
        $this->contents = $contents;
        
        return $this;
    }

    /**
     * Render the content for this element.
     *
     * @return string
     */
    public function renderContent()
    {
        $html = '';

        $contents = $this->contents ?? [];

        foreach($contents as $content) {
            $html .= $content->render();
        }

        return $html;
    }

    /**
     * Get the default class name for the element out of the skin configuration,
     * based on its control type.
     *
     * @return string
     */
    public function getDefaultClass()
    {
        return Florms::getSkinValue('containers.inputGroupAppend');
    }
}
