<?php

namespace Se7enet\Florms\Elements;

use Se7enet\Florms\Traits\HasFormEvents;
use Se7enet\Florms\FlormsFacade as Florms;

class Form extends Element
{
    /**
     * Include the traits.
     */
    use HasFormEvents;

    /**
     * Get the HTML tag name.
     *
     * @return string
     */
    public function getTagName()
    {
        return 'form';
    }

    /**
     * Render the opening form tag and any necessary hidden inputs that should
     * go along with it.
     *
     * @return string
     */
    public function render()
    {
        $this->setDefaults();

        $html = $this->renderOpen() .
            $this->getHiddenCSRF() .
            $this->getHiddenMethod();

        return $html;
    }

    /**
     * Get the hidden CSRF field, rendered as HTML.
     *
     * @return string
     */
    public function getHiddenCSRF()
    {
        if (!$this->needsHiddenCSRF()) {
            return '';
        }

        $token = csrf_token();
        $csrf  = Florms::hidden()->name('_token')->value($token);

        return "\n" . $csrf->render();
    }

    /**
     * Does the form need to use the hidden CSRF field?
     *
     * @return boolean
     */
    public function needsHiddenCSRF()
    {
        if (!$this->hasOption('csrf')) {
            return true;
        }

        return !!$this->getOption('csrf');
    }

    /**
     * Get the hidden method field, rendered as HTML.
     *
     * @return string
     */
    public function getHiddenMethod()
    {
        if (!$this->needsHiddenMethod()) {
            return '';
        }

        $method = $this->getOption('method');
        $hidden = Florms::hidden()->name('_method')->value($method);

        return "\n" . $hidden->render();
    }

    /**
     * Does the form need to use the hidden method field?
     *
     * @param string $method
     *
     * @return boolean
     */
    public function needsHiddenMethod($method = null)
    {
        if (is_null($method)) {
            $method = $this->getOption('method');
        }

        return in_array(strtoupper($method), ['PUT', 'PATCH', 'DELETE']);
    }

    /**
     * Set some default options and attributes prior to rendering the final
     * HTML.
     *
     * @return void
     */
    public function setDefaults()
    {
        $this->setDefaultMethod();
        $this->setDefaultSkin();
        $this->setDefaultClass();
    }

    /**
     * Set the default form method, if necessary.
     *
     * @return void
     */
    public function setDefaultMethod()
    {
        if (!$this->hasAttribute('method')) {
            $this->post();
        }
    }

    /**
     * Set the default form wrapper skin, if necessary.
     *
     * @return void
     */
    public function setDefaultSkin()
    {
        if (!$this->hasOption('skin')) {
            $this->skin('default');
        }
    }

    /**
     * Append the default class name onto the element.
     *
     * @return void
     */
    public function setDefaultClass()
    {
        $class = $this->getDefaultClass();

        if (!empty($class)) {
            $this->prependAttribute('class', $class);
        }
    }

    /**
     * Get the default class name for the element out of the skin configuration,
     * based on its control type.
     *
     * @return string
     */
    public function getDefaultClass()
    {
        return Florms::getSkinValue('containers.form');
    }

    /**
     * Enable or disable the CSRF hidden input.
     *
     * @param boolean $csrf
     *
     * @return $this
     */
    public function csrf($csrf = true)
    {
        return $this->_option('csrf', !!$csrf);
    }

    /**
     * Set the model to be used by the form field autofiller.
     *
     * @param mixed $model
     *
     * @return $this
     */
    public function model($model = null)
    {
        return $this->_option('model', $model);
    }

    /**
     * Shortcut for $this->url() by generating a URL based on a Controller 
     * Action.
     *
     * @param string $action
     * @param array $parameters
     * 
     * @return $this
     */
    public function action($action, $parameters = [])
    {
        $url = action($action, $parameters);

        return $this->url($url);
    }

    /**
     * Shortcut for $this->url() by generating a URL based on a named route.
     *
     * @param string $route
     * @param array $parameters
     * @param boolean $absolute
     *
     * @return $this
     */
    public function route($route, $parameters = [], $absolute = true)
    {
        $url = route($route, $parameters, $absolute);

        return $this->url($url);
    }

    /**
     * The action attribute specifies where to send the form-data when a form is
     * submitted.
     *
     * @param string $url
     *
     * @return $this
     */
    public function url($url)
    {
        return $this->_attribute('action', $url);
    }

    /**
     * Set the skin to be used for the wrapper elements.
     *
     * @param string $skin
     *
     * @return $this
     */
    public function skin($skin = 'default')
    {
        return $this->_option('skin', $skin);
    }

    /**
     * The accept-charset attribute specifies the character encodings that are
     * to be used for the form submission.
     *
     * @param string $charset
     *
     * @return $this
     */
    public function acceptCharset($charset = '')
    {
        return $this->_attribute('accept-charset', $charset);
    }

    /**
     * The autocomplete attribute specifies whether a form should have
     * autocomplete on or off. When autocomplete is on, the browser
     * automatically complete values based on values that the user has entered
     * before.
     *
     * @param string $autocomplete  Allowed values are 'on' and 'off'. Defaults
     *                              to 'on' when calling this method with no
     *                              arguments.
     *
     * @return $this
     */
    public function autocomplete($autocomplete = 'on')
    {
        return $this->_attribute('autocomplete', strtolower($autocomplete));
    }

    /**
     * The enctype attribute specifies how the form-data should be encoded when
     * submitting it to the server. Only used when the form method is POST.
     *
     * @param string $encType   Allowed values are:
     *                          - 'text/plain'
     *                          - 'multipart/form-data'
     *                          - 'application/x-www-form-urlencoded'
     * @return $this
     */
    public function encType($encType = 'text/plain')
    {
        return $this->_attribute('enctype', $encType);
    }

    /**
     * Shortcut for $this->encType('multipart/form-data');
     *
     * @return $this
     */
    public function hasFiles()
    {
        return $this->encType('multipart/form-data');
    }

    /**
     * The method attribute specifies how to send form-data (the form-data is
     * sent to the page specified in the action attribute).
     *
     * @param string $method    Allowed values are 'get', 'post', 'put',
     *                          'patch', and 'delete'. Defaults to 'post' when
     *                          this method is called with no arguments. Note
     *                          that HTML forms do not actually support anything
     *                          but 'get' and 'post', so if the other three
     *                          verbs are used, it will actually set the method
     *                          on the form itself to 'post', and then include
     *                          a hidden input inside the form which will be
     *                          used by Laravel's routing system, e.g.,
     *                          <input type="hidden" name="_method" value="put">
     *
     * @return $this
     */
    public function method($method = 'POST')
    {
        if ($this->needsHiddenMethod($method)) {

            // Set the option value to the original method.
            $this->_option('method', $method);

            // But set the "real" method to POST.
            return $this->post();
        }

        return $this->_attribute('method', strtoupper($method));
    }

    /**
     * Shortcut for $this->method('get');
     *
     * @return $this
     */
    public function get()
    {
        return $this->method('GET');
    }

    /**
     * Shortcut for $this->method('post');
     *
     * @return $this
     */
    public function post()
    {
        return $this->method('POST');
    }

    /**
     * Shortcut for $this->method('put');
     *
     * @return $this
     */
    public function put()
    {
        return $this->method('PUT');
    }

    /**
     * Shortcut for $this->method('patch');
     *
     * @return $this
     */
    public function patch()
    {
        return $this->method('PATCH');
    }

    /**
     * Shortcut for $this->method('delete');
     *
     * @return $this
     */
    public function delete()
    {
        return $this->method('DELETE');
    }

    /**
     * The name attribute specifies the name of a form.
     *
     * @param string $name
     *
     * @return $this
     */
    public function name($name = '')
    {
        return $this->_attribute('name', $name);
    }

    /**
     * The novalidate attribute is a boolean attribute. When present, it
     * specifies that the form-data (input) should not be validated when
     * submitted.
     *
     * @param boolean $noValidate   Defaults to true when calling this method
     *                              with no arguments.
     *
     * @return $this
     */
    public function noValidate($noValidate = true)
    {
        return $this->_attribute('novalidate', !!$noValidate);
    }

    /**
     * The target attribute specifies a name or a keyword that indicates where
     * to display the response that is received after submitting the form.
     *
     * @param string $target    Allowed values are '_blank', '_self', '_parent',
     *                          '_top', or '[frame name]'. Defaults to '_self'
     *                          when calling this method with no arguments.
     *
     * @return $this
     */
    public function target($target = '_self')
    {
        return $this->_attribute('target', strtolower($target));
    }
}
