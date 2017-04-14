<?php

namespace view;

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
        ob_start();
        require $this->file;
        $output = ob_get_clean();

        // Include files in templates: [& path="path/to/file.tpl" ]
        if (preg_match_all('/\[&\s*path\s*=\s*\"?\\\'?(.*?.tpl)\"?\\\'?\s*\]/', $output, $matches)) {
            foreach ($matches[1] as $file) {
                $include[] = file_get_contents(__DIR__ . '/../../layout/' . $file);
            }

            foreach ($matches[0] as $key => $match) {
                $output = str_replace($match, $include[$key], $output);
            }
        }

        // For simple display of a variable: [$var]
        foreach ($this->values as $key => $value) {
            $output = preg_replace('/\[\$\s*('. $key .')\s*\]/', $value, $output);
        }

        return $output;
    }
}