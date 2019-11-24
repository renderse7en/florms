<?php

namespace Se7enet\Florms\Elements\Inputs;

use Se7enet\Florms\Elements\Input;
use Se7enet\Florms\FlormsFacade as Florms;

class Buttons extends Input
{
    /**
     * Array of Button elements for this group.
     *
     * @var Button[]
     */
    public $buttons = [];

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
        $this->buttons[] = Florms::submit($options)->content($content)->formGroup(false);

        return $this;
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
        $this->buttons[] = Florms::reset($options)->content($content)->formGroup(false);

        return $this;
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
        $this->buttons[] = Florms::button($options)->content($content)->formGroup(false);

        return $this;
    }

    /**
     * Open the element and all of the various wrapper pieces that should come
     * before it. For
     *
     * @return string
     */
    public function renderOpen()
    {
        $input = parent::renderOpen();

        $html = '';

        if ($this->formGroup) {
            $html .= $this->formGroup->renderOpen();
        }

        if ($this->label && $this->labelBeforeElement()) {
            $html .= $this->label->render();
        }

        return $html;
    }

    /**
     * Close the element and all of the various wrapper pieces that should come
     * after it.
     *
     * @return string
     */
    public function renderClose()
    {
        $html = '';

        if ($this->label && $this->labelAfterElement()) {
            $html .= $this->label->render();
        }

        if ($this->formGroup) {
            $html .= $this->formGroup->renderClose();
        }

        return $html;
    }

    /**
     * Render all checkboxes in the group.
     *
     * @return string
     */
    public function renderContent()
    {
        $html  = '';
        $count = 0;

        foreach ($this->buttons as $button) {
            $count++;
            $html .= $button->render() . PHP_EOL;
        }

        return $html;
    }
}
