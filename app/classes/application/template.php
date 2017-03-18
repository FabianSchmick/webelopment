<?php

namespace application;

/**
 * Simple template engine class (use [@tag] tags in your templates).
 *
 * TODO: Do PHP functions in tpl files accessible
 */
class Template
{
    /**
     * @var string $file The filename of the template to load.
     */
    private $file;

    /**
     * @var array $values An array of values for replacing each tag on the template (the key for each value is its corresponding tag).
     */
    private $values = array();

    /**
     * Creates a new Template object and sets its associated file.
     *
     * @param string $file the filename of the template to load
     */
    public function __construct($file)
    {
        $this->file = $file;
    }

    /**
     * Sets a value for replacing a specific tag.
     *
     * @param array $values Array with values for replacing
     */
    public function set($values)
    {
        foreach ($values as $key => $value) {
            $this->values[$key] = $value;
        }
    }

    /**
     * Outputs the content of the template, replacing the keys for its respective values.
     *
     * @return string $output The output
     */
    public function output()
    {
        if (!file_exists($this->file)) {
            return "Error loading template file ($this->file).<br />";
        }
        $output = file_get_contents($this->file);

        foreach ($this->values as $key => $value) {
            $tagToReplace = "[@$key]";
            $output = str_replace($tagToReplace, $value, $output);
        }

        return $output;
    }
}