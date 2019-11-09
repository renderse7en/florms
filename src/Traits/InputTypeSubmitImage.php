<?php

namespace Se7enet\Florms\Traits;

trait InputSubmitImage
{
    /**
     * Specifies the URL of the file that will process the input control when
     * the form is submitted (for type="submit" and type="image")
     *
     * @param string $url
     *
     * @return $this
     */
    public function formAction($url = '')
    {
        return $this->_attribute('formaction', $url);
    }

    /**
     * Specifies how the form-data should be encoded when submitting it to the
     * server (for type="submit" and type="image")
     *
     * @param string $encType   Allowed values are:
     *                          - 'text/plain'
     *                          - 'multipart/form-data'
     *                          - 'application/x-www-form-urlencoded'
     *
     * @return $this
     */
    public function formEncType($encType = 'text/plain')
    {
        return $this->_attribute('formenctype', strtolower($encType));
    }

    /**
     * Defines the HTTP method for sending data to the action URL (for
     * type="submit" and type="image")
     *
     * @param string $method    Allowed values are 'get' and 'post', defaults to
     *                          'post' if this method is called with no
     *                          arguments. Note that unlike the corresponding
     *                          method(...) method on the main Form object,
     *                          this does not support the additional 'put',
     *                          'patch', and 'delete' verbs, because the form
     *                          tag has presumably already been rendered at this
     *                          point, so we cannot inject the necessary hidden
     *                          input to use them.
     *
     * @return $this
     */
    public function formMethod($method = 'post')
    {
        return $this->_attribute('formmethod', $method);
    }

    /**
     * Specifies where to display the response that is received after submitting
     * the form (for type="submit" and type="image")
     *
     * @param string $target    Allowed values are '_blank', '_self', '_parent',
     *                          '_top', or '[frame name]'. Defaults to '_self'
     *                          when calling this method with no arguments.
     *
     * @return $this
     */
    public function formTarget($target = '_self')
    {
        return $this->_attribute('formtarget', strtolower($target));
    }
}
