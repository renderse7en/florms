<?php

namespace Se7enet\Florms\Elements;

use Se7enet\Florms\Traits\HasFormEvents;
use Se7enet\Florms\Traits\InputDefaults;
use Se7enet\Florms\FlormsFacade as Florm;
use Se7enet\Florms\Traits\InputCommonOptions;
use Se7enet\Florms\Traits\InputCommonAttributes;

class Select extends Element
{
    /**
     * Include the traits.
     */
    use HasFormEvents,
        InputCommonAttributes,
        InputCommonOptions;
    use InputDefaults {
        renderClose as renderCloseDefault;
    }

    /**
     * Get the HTML tag name.
     *
     * @return string
     */
    public function getTagName()
    {
        return 'select';
    }

    /**
     * Get the type of control, for purposes of inheriting skin settings.
     *
     * @return string
     */
    public function getControlType()
    {
        return 'select';
    }

    /**
     * Render each <option> and/or <optgroup> inside this <select> box.
     *
     * @return string
     */
    public function renderContent()
    {
        $html = '';

        foreach ($this->getOption('options') as $key => $value) {

            // If the value is also an array (or similar), it indicates that
            // this should be an <optgroup>.
            if (is_iterable($value)) {

                $options = '';

                foreach ($value as $groupKey => $groupValue) {
                    $options .= $this->renderOption($groupKey, $groupValue);
                }

                $html .= $this->renderOptGroup($key, $options);
            }

            // Otherwise just render the individual option.
            else {
                $html .= $this->renderOption($key, $value);
            }
        }

        return $html;
    }

    /**
     * Render an <optgroup> into this <select>.
     *
     * @param string $label
     * @param string $content
     *
     * @return string
     */
    public function renderOptGroup($label, $content)
    {
        $optgroup = Florm::optgroup()->control($this)->label($label)->content($content);

        return $optgroup->render();
    }

    /**
     * Render an <option> into this <select> or <optgroup>.
     *
     * @param string $value
     * @param string $content
     *
     * @return string
     */
    public function renderOption($value, $content)
    {
        $option = Florm::option()->control($this)->value($value)->content($content);

        return $option->render();
    }

    /**
     * Selects are not self-closing like regular inputs, so we need to
     * actually close the element before doing all the cleanup/container stuff.
     *
     * @return string
     */
    public function renderClose()
    {
        return '</' . $this->getTagName() . '>' . $this->renderCloseDefault();
    }
}
