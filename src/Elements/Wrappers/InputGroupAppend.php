<?php

namespace Se7enet\Florms\Elements\Wrappers;

use Se7enet\Florms\Elements\Div;
use Se7enet\Florms\Traits\WrapperCommon;
use Se7enet\Florms\FlormsFacade as Florm;

class InputGroupAppend extends Div
{
    /**
     * Traits
     */
    use WrapperCommon;

    /**
     * Add an array of InputGroupText divs.
     *
     * @param InputGroupText[] $contents
     *
     * @return $this
     */
    public function contents($contents)
    {
        return $this->_option('contents', $contents);
    }

    /**
     * Render the content for this element.
     *
     * @return string
     */
    public function renderContent()
    {
        $html = '';

        $contents = $this->getOption('contents');

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
        return Florm::getSkinValue('containers.inputGroupAppend');
    }
}
