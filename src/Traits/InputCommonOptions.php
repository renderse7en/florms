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

    /**
     * Pass a given option to one of the wrapper elements.
     *
     * @param string $method
     * @param array $arguments
     * 
     * @return $this
     */
    public function passThrough(string $method, array $arguments)
    {
        // Check to make sure we can passthrough first.
        if ($result = $this->canPassThrough($method, $arguments)) {

            // Break out the results into variables.
            list($passTo, $call, $arguments) = $result;

            // And then call the passthrough method.
            call_user_func_array([$passTo, $call], $arguments);
        }

        return $this;
    }

    /**
     * Determine whether a given option can be passed to a wrapper element.
     *
     * @param string $method
     * @param array $arguments
     * 
     * @return boolean
     */
    public function canPassThrough(string $method, array $arguments)
    {
        // Lowercase the check value.
        $check = strtolower($method);

        // Define all possible passthru methods.
        $passes = [
            'label',
            'formgroup',
            'inputgroupappend',
            'inputgroupprepend',
            'inputgroup',
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
            if (in_array($passthru, ['inputgroupappend', 'inputgroupprepend'])) {
                
                // Must have an input group.
                if (!$this->inputGroup) {
                    continue;
                }

                // Get the name of the child node.
                $child = substr($passthru, 10);

                // It must have the appropriate option.
                if (!$this->inputGroup->{$child}) {
                    continue;
                }

                // And we must be able to get the appropriate option.
                if (!($passTo = $this->inputGroup->{$child})) {
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

            // If we've made it this far, we're good, so return the array of
            // necessary pieces to perform the passthrough.
            return [$passTo, $call, $arguments];
        }

        // Nope.
        return false;
    }

    /**
     * Add (or disable) a form group wrapper around this element.
     *
     * @param array|boolean   $options
     *
     * @return $this
     */
    public function formGroup($options = [])
    {
        // If boolean false is passed, we want to disable the form group
        // altogether. This is useful for things like checkbox groups, where
        // the overall group gets a form group but the individual options
        // should not.
        if ($options === false) {
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
     * @param string  $text
     * @param array   $options
     *
     * @return $this
     */
    public function helpText($text = '', $options = [])
    {
        $this->helpText = Florms::helpText()->content($text)->attributes($options)->control($this);

        return $this;
    }

    /**
     * Add the input container wrapper around this element.
     *
     * @param array|boolean   $options
     *
     * @return $this
     */
    public function inputContainer($options = [])
    {
        // If boolean false is passed, we want to disable the input container
        // wrapper altogether.
        if ($options === false) {
            $this->inputContainer = false;
        }
        
        // Otherwise create the wrapper and pass the options into it.
        else {
            $this->inputContainer = Florms::inputContainer()->attributes($options)->control($this);
        }
        
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
        // Disable auto label, if boolean false is passed.
        if ($label === false) {
            $this->label = false;
        }

        // Just do nothing if an empty-ish value is passed.
        if (empty($label)) {
            return $this;
        }

        // Create the label.
        $this->label = Florms::label()->content($label)->attributes($options)->control($this);

        // Done.
        return $this;
    }

    /**
     * Add the error messages block for this element.
     *
     * @param array|boolean   $options
     *
     * @return $this
     */
    public function errorMessages($options = [])
    {
        // If boolean false is passed, we want to disable the error messages
        // container altogether.
        if ($options === false) {
            $this->errorMessages = false;
        }

        // Otherwise create the container and pass the options into it.
        else {
            $this->errorMessages = Florms::errorMessages()->attributes($options)->control($this);
        }
        
        return $this;
    }

    /**
     * Disable the automatic form-group, label, and error messages blocks.
     *
     * @return $this
     */
    public function plain()
    {
        $this->formGroup(false);
        $this->label(false);
        $this->errorMessages(false);

        return $this;
    }
}
