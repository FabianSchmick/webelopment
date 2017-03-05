<?php

namespace application;

class Route
{
    /**
     * @var array $_listUri List of URI's to match against
     */
    private $_listUri = [];

    /**
     * @var array $_listCall List of closures to call
     */
    private $_listCall = [];

    /**
     * @var array $_target The current route config
     */
    private $_config = [];

    /**
     * @var array $_args The arguments name passed to the function
     */
    private $_argsName = [];

    /**
     * @var string $_trim Class-wide items to clean
     */
    private $_trim = '/\^$';

    /**
     * add - Adds a URI and Function to the two lists
     *
     * @param string $uri A path such as about/system
     * @param array $config The current route config
     * @param array $argsName The arguments name passed to the function
     * @param object $function An anonymous function
     */
    public function add($uri, $config, $argsName, $function)
    {
        $uri = trim($uri, $this->_trim);
        $this->_listUri[] = $uri;
        $this->_listCall[] = $function;
        $this->_config = $config;
        $this->_argsName = $argsName;
    }

    /**
     * submit - Looks for a match for the URI and runs the related function
     *
     * @return bool $findUrl If URL was found
     */
    public function submit()
    {
        $uri = isset($_REQUEST['uri']) ? $_REQUEST['uri'] : '/';
        $uri = trim($uri, $this->_trim);

        $replacementValues = array();
        $findUrl = false;
        $i = 0;

        /**
         * List through the stored URI's
         */
        foreach ($this->_listUri as $listKey => $listUri)
        {
            /**
             * See if there is a match
             */
            if (preg_match("#^$listUri$#", $uri))
            {
                /**
                 * Replace the values
                 */
                $realUri = explode('/', $uri);
                $fakeUri = explode('/', $listUri);

                /**
                 * Gather the .* values with the real values in the URI
                 */
                foreach ($fakeUri as $key => $value)
                {
                    if ($value == '.*')
                    {
                        $replacementValues['arguments'][$this->_argsName[$i]] = $realUri[$key];
                        $i += 1;
                    }
                }

                $replacementValues['config'] = $this->_config;

                /**
                 * Pass an array for arguments
                 */
                call_user_func_array($this->_listCall[$listKey], [$replacementValues]);

                $findUrl =  true;
            }
        }

        return $findUrl;
    }
}