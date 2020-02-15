<?php

namespace Se7enet\Florms\Elements\Inputs;

use Se7enet\Florms\FlormsFacade as Florms;

class Checkboxes extends Inputs
{
    /**
     * Key/value paired array of each checkbox in this group.
     *
     * @var array
     */
    public $options = [];

    /**
     * Default parameters/options that will be passed into each individual
     * checkbox.
     *
     * @var array
     */
    public $controlDefaults = [];

    /**
     * Populate the list of available options. The most basic $options argument
     * should be a a simple associative array where each key is the "value" 
     * attribute of the checkbox, and each value is the label text for the 
     * checkbox.
     * 
     * A more advanced version should be a 2D array, where each primary key is
     * again the attribute of the checkbox, and each value is itself an
     * associative array of the options to be passed into that checkbox. If the
     * advanced version is used, you must pass a [...'label' => 'Label Text'...]
     * element to set the label text for that checkbox.
     *
     * @param array $options
     *
     * @return $this
     */
    public function options($options = [])
    {
        $this->options = $options;

        return $this;
    }

    /**
     * An array of default parameters/options that will be passed into each 
     * individual checkbox control. Note that the "name" and "id" options will 
     * be automatically inherited from the values already passed into this 
     * group; and the "value" and "label" options will come from the $options
     * array; and finally, "formGroup" will be disabled, since the overall 
     * checkbox group should get the form group but the individual checkboxes 
     * themselves should not. If you provide any of these values in the 
     * $defaults array, your values will take precedence over what would have 
     * been automatically populated.
     *
     * @param array $defaults
     * @return void
     */
    public function defaults($defaults = [])
    {
        $this->controlDefaults = $defaults;

        return $this;
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

        foreach ($this->options as $value => $label) {
            $count++;
            $html .= $this->renderOption($value, $label, $count);
        }

        return $html;
    }

    /**
     * Render an individual checkbox into this group.
     *
     * @param string  $value
     * @param mixed   $label
     * @param integer $count
     *
     * @return string
     */
    public function renderOption($value, $label, $count = 0)
    {
        // Inherit the default settings.
        $id       = $this->getAttribute('id');
        $name     = $this->getAttribute('name');
        $defaults = $this->controlDefaults ?? [];

        // If $label is an array, then we should use that for the base $options.
        $options = [];
        if (is_array($label)) {
            $options = $label;
            $label = $options['label'] ?? '';
        }

        // Create a complete options array with our programmatic defaults,
        // merged with the provided defaults as well as any options that were
        // specified in the original advanced $label array.
        $options = array_merge([
            'id'        => sprintf('%s-%s', $id, $count),
            'name'      => $name,
            'value'     => $value,
            'label'     => $label,
            'formGroup' => false,
        ], $defaults, $options);

        $element = $this->getOptionElement($options);

        return $element->render();
    }

    /**
     * Get the element to be used in this checkbox/radio/whatever group.
     *
     * @param array $options
     *
     * @return Checkbox
     */
    public function getOptionElement($options = [])
    {
        return Florms::checkbox($options);
    }
}
