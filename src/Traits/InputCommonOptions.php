<?php

namespace Se7enet\Florms\Traits;

use Illuminate\Support\Str;
use Se7enet\Florms\Elements\Label;
use Se7enet\Florms\Elements\Element;
use Se7enet\Florms\FlormsFacade as Florms;
use Se7enet\Florms\Elements\Wrappers\HelpText;
use Se7enet\Florms\Elements\Wrappers\FormGroup;
use Se7enet\Florms\Elements\Wrappers\InputGroup;
use Se7enet\Florms\Elements\Wrappers\ErrorMessages;
use Se7enet\Florms\Elements\Wrappers\InputContainer;

trait InputCommonOptions
{
    /**
     * The <label> for this element.
     *
     * @var Label
     */
    public $label;

    /**
     * The <div class="form-group"> surrounding this element.
     *
     * @var FormGroup
     */
    public $formGroup;

    /**
     * The <div class="input-group"> surrounding this element.
     *
     * @var InputGroup
     */
    public $inputGroup;

    /**
     * The <small class="form-text"> for this element.
     *
     * @var HelpText
     */
    public $helpText;

    /**
     * Some controls (e.g., checkboxes and radios) need to be wrapped in their
     * own special container div inside the normal form group.
     *
     * @var InputContainer
     */
    public $inputContainer;

    /**
     * If validation fails, we need to render any error messages into a div
     * inside the form group.
     *
     * @var ErrorMessages
     */
    public $errorMessages;

    /**
     * Build our own magic caller, so we can do things like pass chained methods
     * from the parent control down into the label. For example, this lets us
     * call $text->labelAddClass() and have that translate to the addClass()
     * method of $text's label, while still chaining back the original $text.
     *
     * @param string $method
     * @param array  $arguments
     *
     * @return $this
     */
    public function __call(string $method, array $arguments)
    {
        // Lowercase the method name to check against it.
        $check = strtolower($method);

        // Shortcut for data.
        if (substr($check, 0, 4) == 'data' && strlen($check) > 4) {

            // Get kebab-case version of the complete method name.
            $attr = Str::snake(substr($method, 4), '-');

            // Prepend that onto the arguments array.
            array_unshift($arguments, $attr);

            // And then call the data() method.
            call_user_func_array([$this, 'data'], $arguments);

            // Quit now.
            return $this;
        }

        // Try to passthrough to a child object, of we can.
        $this->passThrough($method, $arguments);

        // Chain.
        return $this;
    }

    public function passThrough(string $method, array $arguments)
    {
        // Lowercase the check value.
        $check = strtolower($method);

        // Define all possible passthru methods.
        $passes = [
            'label',
            'formgroup',
            'inputgroup',
            'inputgroupappend',
            'inputgroupprepend',
            'inputcontainer',
            'helptext',
        ];

        foreach($passes as $passthru) {

            // Match on length.
            if (substr($check, 0, strlen($passthru)) != $passthru) {
                continue;
            }

            // Must actually have more characters after the matched value.
            if (strlen($check) == strlen($passthru)) {
                continue;
            }

            // Input Group Append/Prepend need an extra step here.
            if (in_array($check, ['inputgroupappend', 'inputgroupprepend'])) {
                
                // Must have an input group.
                if (!$this->inputGroup) {
                    continue;
                }

                // It must have the appropriate option.
                if (!$this->inputGroup->hasOption(substr($check, 10))) {
                    continue;
                }

                // And we must be able to get the appropriate option.
                if (!($passTo = $this->inputGroup->getOption(substr($check, 10)))) {
                    continue;
                }
            }

            // The checked attribute must be defined on the object.
            $prop = lcfirst(substr($method, 0, strlen($passthru)));
            if (empty($passTo) && !($passTo = $this->{$prop})) {
                continue;
            }

            // The passthrough object must have the method.
            if (!method_exists($passTo, ($call = lcfirst(substr($method, strlen($passthru)))))) {
                continue;
            }

            // If we've made it this far, call the method on the passthrough
            // object.
            call_user_func_array([$passTo, $call], $arguments);

            // Done. Break the loop so we don't keep trying.
            break;
        }
    }

    /**
     * Add (or disable) a form group wrapper around this element.
     *
     * @param boolean $enabled
     * @param array   $options
     *
     * @return $this
     */
    public function formGroup($enabled = true, $options = [])
    {
        // If boolean false is passed, we want to disable the form group
        // altogether. This is useful for things like checkbox groups, where
        // the overall group gets a form group but the individual options
        // should not.
        if ($enabled === false) {
            $this->formGroup = false;
        }

        // Otherwise create a new form group.
        else {
            $this->formGroup = Florms::formGroup()->attributes($options)->control($this);
        }

        // Chain.
        return $this;
    }

    /**
     * Add a help text block for this element.
     *
     * @param array   $options
     *
     * @return $this
     */
    public function helpText($options = [])
    {
        $this->helpText = Florms::helpText()->attributes($options)->control($this);

        return $this;
    }

    /**
     * Add the input container wrapper around this element.
     *
     * @param array   $options
     *
     * @return $this
     */
    public function inputContainer($options = [])
    {
        $this->inputContainer = Florms::inputContainer()->attributes($options)->control($this);

        return $this;
    }

    /**
     * Create an InputGroup and append one or more texts/icons/whatevers after
     * the element.
     *
     * @param mixed $content
     * @param array $groupOptions
     * @param array $appendOptions
     * @param array $textOptions
     *
     * @return $this
     */
    public function inputGroupAppend($content = '', $groupOptions = [], $appendOptions = [], $contentOptions = [])
    {
        // Prepare the input group.
        $this->prepareInputGroup($groupOptions);

        // Prepare the content.
        $contents = $this->prepareInputGroupContent($content, $contentOptions);

        // Create the append group.
        $append = Florms::inputGroupAppend($appendOptions)->contents($contents);

        // Add the append group to the input group.
        $this->inputGroup->append($append);

        // Chain.
        return $this;
    }

    /**
     * Create an InputGroup and prepend one or more texts/icons/whatevers after
     * the element.
     *
     * @param mixed $content
     * @param array $groupOptions
     * @param array $prependOptions
     * @param array $contentOptions
     *
     * @return $this
     */
    public function inputGroupPrepend($content = '', $groupOptions = [], $prependOptions = [], $contentOptions = [])
    {
        // Prepare the input group.
        $this->prepareInputGroup($groupOptions);

        // Prepare the content.
        $contents = $this->prepareInputGroupContent($content, $contentOptions);

        // Create the prepend group.
        $prepend = Florms::inputGroupPrepend($prependOptions)->contents($contents);

        // Add the prepend group to the input group.
        $this->inputGroup->prepend($prepend);

        // Chain.
        return $this;
    }

    /**
     * Prepare the input group.
     *
     * @param array $options
     *
     * @return void
     */
    protected function prepareInputGroup($options = [])
    {
        if (!$this->inputGroup) {
            $this->inputGroup = Florms::inputGroup()->control($this);
        }

        $this->inputGroup->attributes($options);
    }

    /**
     * Prepare the complete set of <div class="input-group-text"> elements.
     *
     * @param mixed $content
     * @param array $options
     *
     * @return InputGroupText[]
     */
    protected function prepareInputGroupContent($content = '', $options = [])
    {
        // Convert $content to an array, if necessary.
        if (!is_array($content)) {
            $content = [$content];
        }

        // Create each content element.
        $contents = [];
        foreach($content as $item) {

            // If the item is a string, we need to create a new InputGroupText
            // element to hold it.
            if (is_string($item)) {
                $contents[] = Florms::inputGroupText($options)->content($item);
            }

            // If it is an Element, it's fine as-is.
            if (is_object($item) && $item instanceof Element) {
                $contents[] = $item;
            }
        }

        // Done.
        return $contents;
    }

    /**
     * Add a label to this element.
     *
     * @param string $label
     * @param array  $options
     *
     * @return $this
     */
    public function label($label = '', $options = [])
    {
        if (empty($label)) {
            return;
        }

        $this->label = Florms::label()->content($label)->attributes($options)->control($this);

        return $this;
    }

    /**
     * Add the error messages block for this element.
     *
     * @param array   $options
     *
     * @return $this
     */
    public function errorMessages($options = [])
    {
        $this->errorMessages = Florms::errorMessages()->attributes($options)->control($this);

        return $this;
    }
}
