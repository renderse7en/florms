<?php

namespace Se7enet\Florms\Elements\Inputs;

use Se7enet\Florms\FlormsFacade as Florms;

class Buttons extends Inputs
{
    /**
     * Add a Submit button to this button group.
     *
     * @param string $content
     * @param array $options
     *
     * @return $this
     */
    public function submit($content = '', $options = [])
    {
        $button = Florms::submit($options)->content($content)->formGroup(false);

        return $this->addChild($button);
    }

    /**
     * Add a Reset button to this button group.
     *
     * @param string $content
     * @param array $options
     *
     * @return $this
     */
    public function reset($content = '', $options = [])
    {
        $button = Florms::reset($options)->content($content)->formGroup(false);

        return $this->addChild($button);
    }

    /**
     * Add a generic button to this button group.
     *
     * @param string $content
     * @param array $options
     *
     * @return $this
     */
    public function button($content = '', $options = [])
    {
        $button = Florms::button($options)->content($content)->formGroup(false);

        return $this->addChild($button);
    }
}
