<?php

namespace Se7enet\Florms;

use Se7enet\Florms\Elements\Div;
use Se7enet\Florms\Elements\Form;
use Se7enet\Florms\Elements\Span;
use Se7enet\Florms\Elements\Label;
use Se7enet\Florms\Elements\Legend;
use Se7enet\Florms\Elements\Option;
use Se7enet\Florms\Elements\Fieldset;
use Se7enet\Florms\Elements\OptGroup;
use Se7enet\Florms\Elements\Inputs\Tel;
use Se7enet\Florms\Elements\Inputs\Url;
use Se7enet\Florms\Elements\Inputs\Date;
use Se7enet\Florms\Elements\Inputs\File;
use Se7enet\Florms\Elements\Inputs\Text;
use Se7enet\Florms\Elements\Inputs\Time;
use Se7enet\Florms\Elements\Inputs\Week;
use Se7enet\Florms\Elements\Inputs\Color;
use Se7enet\Florms\Elements\Inputs\Email;
use Se7enet\Florms\Elements\Inputs\Image;
use Se7enet\Florms\Elements\Inputs\Month;
use Se7enet\Florms\Elements\Inputs\Radio;
use Se7enet\Florms\Elements\Inputs\Range;
use Se7enet\Florms\Elements\Inputs\Reset;
use Se7enet\Florms\Elements\Inputs\Button;
use Se7enet\Florms\Elements\Inputs\Hidden;
use Se7enet\Florms\Elements\Inputs\Number;
use Se7enet\Florms\Elements\Inputs\Radios;
use Se7enet\Florms\Elements\Inputs\Search;
use Se7enet\Florms\Elements\Inputs\Select;
use Se7enet\Florms\Elements\Inputs\Submit;
use Se7enet\Florms\Elements\Inputs\Toggle;
use Se7enet\Florms\Elements\Inputs\Toggles;
use Se7enet\Florms\Elements\Inputs\Checkbox;
use Se7enet\Florms\Elements\Inputs\Password;
use Se7enet\Florms\Elements\Inputs\Textarea;
use Se7enet\Florms\Elements\Inputs\Checkboxes;
use Se7enet\Florms\Elements\Inputs\InputReset;
use Se7enet\Florms\Elements\Wrappers\HelpText;
use Se7enet\Florms\Elements\Inputs\InputButton;
use Se7enet\Florms\Elements\Inputs\InputSubmit;
use Se7enet\Florms\Elements\Wrappers\FormGroup;
use Se7enet\Florms\Elements\Wrappers\InputGroup;
use Se7enet\Florms\Elements\Inputs\DatetimeLocal;
use Se7enet\Florms\Elements\Wrappers\ErrorMessages;
use Se7enet\Florms\Elements\Wrappers\InputContainer;
use Se7enet\Florms\Elements\Wrappers\InputGroupText;
use Se7enet\Florms\Elements\Wrappers\InputGroupAppend;
use Se7enet\Florms\Elements\Wrappers\InputGroupPrepend;

class Florms
{
    /**
     * The <form> element for this instance of the Florm Manager. Certain
     * elements may need to trigger options/attributes on the overall form, so
     * we need to keep track of this in the Manager so we can act on it later.
     *
     * @var Form
     */
    protected $form;

    /**
     * Clear all manager options upon closing the form.
     *
     * @return void
     */
    public function clear()
    {
        $this->form = null;
    }

    /**
     * Get the <form> element.
     *
     * @return Form
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * Get the current skin name.
     *
     * @return string
     */
    public function getSkin()
    {
        if ($this->form->skin) {
            return $this->form->skin;
        }

        return 'default';
    }

    /**
     * Get a specified value from the skin configuration, by providing an
     * array address relative to the skin root.
     */
    public function getSkinValue($address)
    {
        $skin = $this->getSkin();

        return config(sprintf('florms.skins.%s.%s', $skin, $address));
    }

    /**
     * Open a new <form> element.
     *
     * @param array  $options
     *
     * @return Form
     */
    public function open($options = [])
    {
        $this->form = new Form($options);

        return $this->form;
    }

    /**
     * Close the </form> element.
     *
     * @return string
     */
    public function close()
    {
        return $this->renderClose();
    }

    /**
     * Close the </form> element.
     *
     * @return string
     */
    public function renderClose()
    {
        $form = $this->form;

        $this->clear();

        return $form->renderClose();
    }

    /**
     * Add a <button> element.
     *
     * @param array $options
     *
     * @return Button
     */
    public function button($options = [])
    {
        return new Button($options);
    }

    /**
     * Add an <input type="checkbox"> element.
     *
     * @param array $options
     *
     * @return Checkbox
     */
    public function checkbox($options = [])
    {
        return new Checkbox($options);
    }

    /**
     * Add a group of related <input type="checkbox"> elements.
     *
     * @param array $options
     *
     * @return Checkboxes
     */
    public function checkboxes($options = [])
    {
        return new Checkboxes($options);
    }

    /**
     * Add an <input type="color"> element.
     *
     * @param array $options
     *
     * @return Color
     */
    public function color($options = [])
    {
        return new Color($options);
    }

    /**
     * Add an <input type="date"> element.
     *
     * @param array $options
     *
     * @return Date
     */
    public function date($options = [])
    {
        return new Date($options);
    }

    /**
     * Add an <input type="datetime-local"> element.
     *
     * @param array $options
     *
     * @return DatetimeLocal
     */
    public function datetimeLocal($options = [])
    {
        return new DatetimeLocal($options);
    }

    /**
     * Add a <div> element.
     *
     * @param array $options
     *
     * @return Div
     */
    public function div($options = [])
    {
        return new Div($options);
    }

    /**
     * Add an <input type="email"> element.
     *
     * @param array $options
     *
     * @return Email
     */
    public function email($options = [])
    {
        return new Email($options);
    }

    /**
     * Add a <div class="invalid-feedback"> element.
     *
     * @param array $options
     *
     * @return ErrorMessages
     */
    public function errorMessages($options = [])
    {
        return new ErrorMessages($options);
    }

    /**
     * Add an <fieldset> element.
     *
     * @param array $options
     *
     * @return Fieldset
     */
    public function fieldset($options = [])
    {
        return new Fieldset($options);
    }

    /**
     * Add an <input type="file"> element.
     *
     * @param array $options
     *
     * @return File
     */
    public function file($options = [])
    {
        return new File($options);
    }

    /**
     * Add a <div class="form-group"> element.
     *
     * @param array $options
     *
     * @return FormGroup
     */
    public function formGroup($options = [])
    {
        return new FormGroup($options);
    }

    /**
     * Add a <small class="form-text"> element.
     *
     * @param array $options
     *
     * @return HelpText
     */
    public function helpText($options = [])
    {
        return new HelpText($options);
    }

    /**
     * Add an <input type="hidden"> element.
     *
     * @param array $options
     *
     * @return Hidden
     */
    public function hidden($options = [])
    {
        return new Hidden($options);
    }

    /**
     * Add an <input type="image"> element.
     *
     * @param array $options
     *
     * @return Image
     */
    public function image($options = [])
    {
        return new Image($options);
    }

    /**
     * Add an <input type="button"> element.
     *
     * @param array $options
     *
     * @return InputButton
     */
    public function inputButton($options = [])
    {
        return new InputButton($options);
    }

    /**
     * Add a container div element for certain input types.
     *
     * @param array $options
     *
     * @return InputContainer
     */
    public function inputContainer($options = [])
    {
        return new InputContainer($options);
    }

    /**
     * Add a <div class="input-group"> element.
     *
     * @param array $options
     *
     * @return InputGroup
     */
    public function inputGroup($options = [])
    {
        return new InputGroup($options);
    }

    /**
     * Add a <div class="input-group-append"> element.
     *
     * @param array $options
     *
     * @return InputGroupAppend
     */
    public function inputGroupAppend($options = [])
    {
        return new InputGroupAppend($options);
    }

    /**
     * Add a <div class="input-group-prepend"> element.
     *
     * @param array $options
     *
     * @return InputGroupPrepend
     */
    public function inputGroupPrepend($options = [])
    {
        return new InputGroupPrepend($options);
    }

    /**
     * Add a <div class="input-group-text"> element.
     *
     * @param array $options
     *
     * @return InputGroupText
     */
    public function inputGroupText($options = [])
    {
        return new InputGroupText($options);
    }

    /**
     * Add an <input type="reset"> element.
     *
     * @param array $options
     *
     * @return InputReset
     */
    public function inputReset($options = [])
    {
        return new InputReset($options);
    }

    /**
     * Add an <input type="submit"> element.
     *
     * @param array $options
     *
     * @return InputSubmit
     */
    public function inputSubmit($options = [])
    {
        return new InputSubmit($options);
    }

    /**
     * Add a <label> element.
     *
     * @param array $options
     *
     * @return Label
     */
    public function label($options = [])
    {
        return new Label($options);
    }

    /**
     * Add a <legend> element.
     *
     * @param array $options
     *
     * @return Legend
     */
    public function legend($options = [])
    {
        return new Legend($options);
    }

    /**
     * Add an <input type="month"> element.
     *
     * @param array $options
     *
     * @return Month
     */
    public function month($options = [])
    {
        return new Month($options);
    }

    /**
     * Add an <input type="number"> element.
     *
     * @param array $options
     *
     * @return Number
     */
    public function number($options = [])
    {
        return new Number($options);
    }

    /**
     * Add an <option> element.
     *
     * @param array $options
     *
     * @return Option
     */
    public function option($options = [])
    {
        return new Option($options);
    }

    /**
     * Add an <optgroup> element.
     *
     * @param array $options
     *
     * @return OptGroup
     */
    public function optGroup($options = [])
    {
        return new OptGroup($options);
    }

    /**
     * Add an <input type="password"> element.
     *
     * @param array $options
     *
     * @return Password
     */
    public function password($options = [])
    {
        return new Password($options);
    }

    /**
     * Add an <input type="radio"> element.
     *
     * @param array $options
     *
     * @return Radio
     */
    public function radio($options = [])
    {
        return new Radio($options);
    }

    /**
     * Add a group of related <input type="radio"> elements.
     *
     * @param array $options
     *
     * @return Radios
     */
    public function radios($options = [])
    {
        return new Radios($options);
    }

    /**
     * Add an <input type="range"> element.
     *
     * @param array $options
     *
     * @return Range
     */
    public function range($options = [])
    {
        return new Range($options);
    }

    /**
     * Add an <button type="reset"> element.
     *
     * @param array $options
     *
     * @return Reset
     */
    public function reset($options = [])
    {
        return new Reset($options);
    }

    /**
     * Add an <input type="search"> element.
     *
     * @param array $options
     *
     * @return Search
     */
    public function search($options = [])
    {
        return new Search($options);
    }

    /**
     * Add an <select> element.
     *
     * @param array $options
     *
     * @return Select
     */
    public function select($options = [])
    {
        return new Select($options);
    }

    /**
     * Add a <span> element.
     *
     * @param array $options
     *
     * @return Span
     */
    public function span($options = [])
    {
        return new Span($options);
    }

    /**
     * Add an <button type="submit"> element.
     *
     * @param array $options
     *
     * @return Submit
     */
    public function submit($options = [])
    {
        return new Submit($options);
    }

    /**
     * Add an <input type="tel"> element.
     *
     * @param array $options
     *
     * @return Tel
     */
    public function tel($options = [])
    {
        return new Tel($options);
    }

    /**
     * Add an <input type="text"> element.
     *
     * @param array $options
     *
     * @return Text
     */
    public function text($options = [])
    {
        return new Text($options);
    }

    /**
     * Add an <textarea> element.
     *
     * @param array $options
     *
     * @return Textarea
     */
    public function textarea($options = [])
    {
        return new Textarea($options);
    }

    /**
     * Add an <input type="time"> element.
     *
     * @param array $options
     *
     * @return Time
     */
    public function time($options = [])
    {
        return new Time($options);
    }

    /**
     * Add the "switch" version of an <input type="checkbox"> element. Florms
     * calls them "toggles" since "switch" is a reserved word in PHP.
     *
     * @param array $options
     *
     * @return Toggle
     */
    public function toggle($options = [])
    {
        return new Toggle($options);
    }

    /**
     * Add a group of related "switch" <input type="checkbox"> elements.
     *
     * @param array $options
     *
     * @return Toggles
     */
    public function toggles($options = [])
    {
        return new Toggles($options);
    }

    /**
     * Add an <input type="url"> element.
     *
     * @param array $options
     *
     * @return Url
     */
    public function url($options = [])
    {
        return new Url($options);
    }

    /**
     * Add an <input type="week"> element.
     *
     * @param array $options
     *
     * @return Week
     */
    public function week($options = [])
    {
        return new Week($options);
    }
}
