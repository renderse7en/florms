<?php

namespace Se7enet\Florms\Traits;

use Str;
use Illuminate\Support\MessageBag;
use Se7enet\Florms\FlormsFacade as Florms;

trait InputDefaults
{
    /**
     * Open the element and all of the various wrapper pieces that should come
     * before it.
     *
     * @return string
     */
    public function renderOpen()
    {
        // Initialize any necessary defaults.
        $input = $this->setDefaults();

        // Start with an empty string.
        $html = '';

        // Add the form group opener.
        if ($this->formGroup) {
            $html .= $this->formGroup->renderOpen();
        }

        // Add the input container opener.
        if ($this->inputContainer) {
            $html .= $this->inputContainer->renderOpen();
        }

        // Add the label, if it comes before the element.
        if ($this->label && $this->labelBeforeElement()) {
            $html .= $this->label->render();
        }

        // Add the input group opener.
        if ($this->inputGroup) {
            $html .= $this->inputGroup->renderOpen();
        }

        // Then open the tag.
        $html .= $this->renderOpenTag();

        // Send it all back.
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
        // Start with the closing tag, if it is necessary.
        $html = $this->renderCloseTag();

        // Add the input group closer.
        if ($this->inputGroup) {
            $html .= $this->inputGroup->renderClose();
        }

        // Add the label, if it comes after the element.
        if ($this->label && $this->labelAfterElement()) {
            $html .= $this->label->render();
        }

        // Add the input container closer.
        if ($this->inputContainer) {

            // Help text goes inside the container.
            if ($this->helpText) {
                $html .= $this->helpText->render();
            }

            // Error messages go inside the container.
            if ($this->errorMessages) {
                $html .= $this->errorMessages->render();
            }

            // Container closer.
            $html .= $this->inputContainer->renderClose();
        }

        // Add the help text, if we haven't already done so.
        if ($this->helpText && !$this->inputContainer) {
            $html .= $this->helpText->render();
        }

        // Add the errors, if we haven't already done so.
        if ($this->errorMessages && !$this->inputContainer) {
            $html .= $this->errorMessages->render();
        }

        // And finally the form group closer.
        if ($this->formGroup) {
            $html .= $this->formGroup->renderClose();
        }

        // Send it all back.
        return $html;
    }

    /**
     * Set some default options and attributes prior to rendering the final
     * HTML.
     *
     * @return void
     */
    protected function setDefaults()
    {
        $this->setDefaultId();
        $this->setDefaultValue();
        $this->setDefaultClass();
        $this->setDefaultFormGroup();
        $this->setDefaultLabel();
        $this->setDefaultInputContainer();
        $this->setDefaultErrorMessages();
    }

    /**
     * Set the default 'value' attribute, if necessary.
     *
     * @return void
     */
    protected function setDefaultValue()
    {
        if (!$this->needsDefaultValue()) {
            return;
        }

        $value = $this->getDefaultValue();

        if (!empty($value)) {
            $this->value($value);
        }
    }

    /**
     * Do we need to populate a default 'value' attribute?
     *
     * @return boolean
     */
    protected function needsDefaultValue()
    {
        // It must at least have a name.
        if (!$this->hasAttribute('name')) {
            return false;
        }

        // Otherwise we check whether it already has a defined value or not.
        return !$this->hasAttribute('value');
    }

    /**
     * Attempt to get the default value of this field, so it can be populated
     * when rendering the field.
     *
     * @return mixed
     */
    protected function getDefaultValue()
    {
        // Get the name of the field.
        $key = $this->getAttribute('name');

        // If the field does not have a name, we cannot inherit a default value.
        if (empty($key)) {
            return null;
        }

        // Only do this if the old input inheritance is enabled in the config.
        if (config('florms.session')) {

            // If the field exists in the old data, use that first.
            if ($this->hasKeyInSession($key)) {
                return $this->getDefaultValueFromSession($key);
            }

            // If *any* data exists in the session - that is, if the form has
            // already been submitted - then we need to quit trying to get a 
            // default value. If we kept going, it could result in a user 
            // legitimately trying to clear out the contents of a field, and 
            // that value getting repopulated from the original model value, if
            // the form ended up having validation errors and sending them back.
            // So if we have any session data at all, and we're still here, just
            // quit now.
            if (session()->hasOldInput()) {
                return null;
            }
        }

        // If we've made it this far, then no form was submitted previously, so
        // we can attempt to retrieve the data from the original model.
        if ($this->hasKeyInModel($key)) {
            return $this->getDefaultValueFromModel($key);
        }

        // Otherwise just return null.
        return null;
    }

    /**
     * Check to see if the specified key exists in the session's input bag.
     *
     * @param string $key
     *
     * @return boolean
     */
    protected function hasKeyInSession($key)
    {
        return session()->hasOldInput($key);
    }

    /**
     * Get the value of the specified key from the session's input bag.
     *
     * @param string $key
     *
     * @return mixed
     */
    protected function getDefaultValueFromSession($key)
    {
        return session()->getOldInput($key);
    }

    /**
     * Check to see if the specified key exists as a property on the model.
     *
     * @param string $key
     *
     * @return boolean
     */
    protected function hasKeyInModel($key)
    {
        if (!($model = $this->getAttachedModel())) {
            return false;
        }

        return isset($model->{$key});
    }

    /**
     * Get the model attached to the parent form, if one exists.
     *
     * @return mixed
     */
    protected function getAttachedModel()
    {
        $form = Florms::getForm();

        return $form->model;
    }

    /**
     * Get the value of the specified key from the model attached to the form.
     *
     * @param string $key
     *
     * @return mixed
     */
    protected function getDefaultValueFromModel($key)
    {
        $model = $this->getAttachedModel();

        return $model->{$key};
    }

    /**
     * Set the default 'id' attribute, if necessary.
     *
     * @return void
     */
    protected function setDefaultId()
    {
        if (!$this->needsDefaultId()) {
            return;
        }

        $id = $this->getDefaultId();

        $this->id($id);
    }

    /**
     * Do we need to populate a default 'id' attribute?
     *
     * @return boolean
     */
    protected function needsDefaultId()
    {
        return !$this->hasAttribute('id');
    }

    /**
     * Generate a default 'id' attribute based on the existing 'name' attribute.
     *
     * @return string
     */
    protected function getDefaultId()
    {
        // Start with the field name.
        $id = $this->getAttribute('name');

        // Clean it.
        $id = $this->fixArraySyntax($id);

        // That's all, folks.
        return $id;
    }

    /**
     * Get a clean ID from a given string by, e.g., stripping or converting any
     * array syntax.
     *
     * @param string  $id
     * @param boolean $strip
     * 
     * @return string
     */
    protected function fixArraySyntax($id = '', $strip = false)
    {
        // Define the array pattern.
        $arrayPattern = '/\[(?<key>[^\]])*\]/';

        // If we are stripping it entirely, let's just do that.
        if ($strip) {
            return preg_replace($arrayPattern, '', $id);
        }

        // If this is an array field (e.g., a multi-option select, or a range
        // of checkboxes, as determined by [] or [something] at the end of the
        // field name), then we need to append some stuff.

        // First, try to match the array brackets syntax, and capture any key
        // that has been specified.
        if (preg_match($arrayPattern, $id, $match)) {

            // Did they specify a key?
            if ($match && !empty($match['key'])) {
                $key = '-' . $match['key'];
            }

            // If not, just generate a big random number.
            else {
                $key = '-' . mt_rand(0, mt_getrandmax());
            }

            // Strip off the array syntax and replace it with the key we came
            // up with.
            $id = preg_replace($arrayPattern, $key, $id);
        }

        // That's all, folks.
        return $id;
    }

    /**
     * Append the default class name onto the element.
     *
     * @return void
     */
    public function setDefaultClass()
    {
        if (!$this->needsDefaultClass()) {
            return;
        }

        $class = $this->getDefaultClass();

        if (!empty($class)) {
            $this->prependClass($class);
        }
    }

    /**
     * Most input elements need a default class prepended to anything else
     * that's already been set, however, we'll leave the ability to disable this
     * on a per-type basis.
     *
     * @return boolean
     */
    public function needsDefaultClass()
    {
        // Is the default class already defined?
        $class = $this->getDefaultClass();

        // If there is no class, we don't need to add it.
        if (!$class) {
            return false;
        }

        // If it's already part of the currently defined class, we don't need
        // to add it again.
        if ($this->hasClass($class)) {
            return false;
        }

        // Otherwise we assume we need to add the default class.
        return true;
    }

    /**
     * Get the default class name for the element out of the skin configuration,
     * based on its control type.
     *
     * @return string
     */
    public function getDefaultClass()
    {
        return Florms::getSkinValue('controls.' . $this->getControlType() . '.control');
    }

    /**
     * Create a default form group div, if necessary.
     *
     * @return void
     */
    public function setDefaultFormGroup()
    {
        if (!$this->needsDefaultFormGroup()) {
            return;
        }

        $this->getDefaultFormGroup();
    }

    /**
     * Decide whether we need to generate a default form group div.
     *
     * @return boolean
     */
    public function needsDefaultFormGroup()
    {
        if ($this->formGroup === false) {
            return false;
        }

        return !$this->formGroup;
    }

    /**
     * Build the default form group div.
     *
     * @return void
     */
    public function getDefaultFormGroup()
    {
        $this->formGroup();
    }

    /**
     * Create a default input container, if necessary.
     *
     * @return void
     */
    public function setDefaultInputContainer()
    {
        if (!$this->needsDefaultInputContainer()) {
            return;
        }

        $this->getDefaultInputContainer();
    }

    /**
     * Decide whether we need to generate a default input container div.
     * 
     * @return boolean
     */
    public function needsDefaultInputContainer()
    {
        if ($this->inputContainer === false) {
            return false;
        }

        $containerClass = Florms::getSkinValue('controls.' . $this->getControlType() . '.container');

        if (!$containerClass) {
            return false;
        }

        return !$this->inputContainer;
    }

    /**
     * Build the default input container div.
     *
     * @return void
     */
    public function getDefaultInputContainer()
    {
        $this->inputContainer = Florms::inputContainer()->control($this);
    }

    /**
     * Create a default form group div, if necessary.
     *
     * @return void
     */
    public function setDefaultLabel()
    {
        if (!$this->needsDefaultLabel()) {
            return;
        }

        $this->getDefaultLabel();
    }

    /**
     * Decide whether we need to generate a default form group div.
     *
     * @return boolean
     */
    public function needsDefaultLabel()
    {
        // Check if it is disabled in the config.
        if (!config('florms.labels')) {
            return false;
        }

        // The field must at least have a name.
        if (!$this->hasAttribute('name')) {
            return false;
        }
        
        // The label class attribute must not be set to hard false.
        if ($this->label === false) {
            return false;
        }
        
        // Otherwise check to see if it's already been defined.
        return !$this->label;
    }

    /**
     * Build the default form group div.
     *
     * @return void
     */
    public function getDefaultLabel()
    {
        // Start with the field name.
        $label = $this->getAttribute('name');

        // If this is an array field (e.g., a multi-option select, or a range
        // of checkboxes, as determined by [] or [something] at the end of the
        // field name), then we need to change stuff up a bit.

        // Try to match the array brackets syntax, and capture any key that has
        // been specified.
        $arrayPattern = '/\[(?<key>[^\]])*\]/';
        if (preg_match($arrayPattern, $label, $match)) {

            // If they did specify a key, we'll use that as the automatic label.
            if ($match && !empty($match['key'])) {
                $label = $match['key'];
            }
        }

        // Convert it to Title Case
        $label = Str::title(str_replace('_', ' ', Str::snake($label)));
        
        // Create a Label out of it.
        $this->label($label);
    }

    /**
     * For most inputs, the label should come before the element. However,
     * certain types (checkboxes and radios) need it to come after.
     *
     * @return string
     */
    public function labelBeforeElement()
    {
        return true;
    }

    /**
     * This is the opposite of the labelBeforeElement() check.
     *
     * @return string
     */
    public function labelAfterElement()
    {
        return !$this->labelBeforeElement();
    }

    /**
     * Create a default errors div, if necessary.
     *
     * @return void
     */
    public function setDefaultErrorMessages()
    {
        if (!$this->needsDefaultErrorMessages()) {
            return;
        }

        $this->getDefaultErrorMessages();
    }

    /**
     * Decide whether we need to generate a default validation error messages
     * div.
     *
     * @return boolean
     */
    public function needsDefaultErrorMessages()
    {
        // If the error message block has already been set to hard false, we do
        // not need to make a default one.
        if ($this->errorMessages === false) {
            return false;
        }

        // Check if this field actually has any error messages.
        $errors = session()->get('errors', new MessageBag());
        if (!$errors->has($this->getAttribute('name'))) {
            return false;
        }

        // If the error messages block is otherwise empty, we need to make a
        // default one. Oherwise we can assume it's already been done.
        return !$this->errorMessages;
    }

    /**
     * Build the default error messages div.
     *
     * @return void
     */
    public function getDefaultErrorMessages()
    {
        // Get all the errors from the session.
        $allErrors = session()->get('errors', new MessageBag());

        // Get the errors for this field.
        $fieldErrors = $allErrors->get($this->getAttribute('name'));

        // Get the config setting for how to split up multiple error messages.
        $split = Florms::getSkinValue('containers.invalidSplit');

        // Collapse them all.
        $errors = implode($split, $fieldErrors);

        // Get the error class.
        $errorClass = Florms::getSkinValue('containers.invalid');

        // Add the error class to the form group.
        $this->addClass($errorClass);

        // And finally, create the error messages.
        $this->errorMessages(['content' => $errors]);
    }
}
