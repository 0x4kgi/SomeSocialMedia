<?php

/**
 * Class Template - a very simple PHP class for rendering PHP templates
 * 
 * https://www.daggerhartlab.com/simple-php-template-class/
 */
class Template
{
    /**
     * Location of expected template
     *
     * @var string
     */
    private $folder;
    /**
     * Template constructor.
     *
     * @param $folder
     */
    public function __construct($folder = null)
    {
        if ($folder) {
            $this->set_folder($folder);
        }
    }

    /**
     * Simple method for updating the base folder where templates are located.
     *
     * @param string $folder
     */
    private function set_folder($folder)
    {
        // normalize the internal folder value by removing any final slashes
        $this->folder = rtrim($folder, '/');
    }

    /**
     * Find and attempt to render a template with variables
     *
     * @param string|string[] $suggestions
     * @param array $variables
     *
     * @return string
     */
    public function render($suggestions, $variables = array())
    {
        $template = $this->find_template($suggestions);
        $output = '';
        if ($template) {
            $output = $this->render_template($template, $variables);
        }
        return $output;
    }

    /**
     * Look for the first template suggestion
     *
     * @param string|array $suggestions
     *
     * @return bool|string
     */
    private function find_template($suggestions)
    {
        if (!is_array($suggestions)) {
            $suggestions = array($suggestions);
        }
        $suggestions = array_reverse($suggestions);
        $found = false;
        foreach ($suggestions as $suggestion) {
            $file = "{$this->folder}/{$suggestion}.php";
            if (file_exists($file)) {
                $found = $file;
                break;
            }
        }
        return $found;
    }

    /**
     * Execute the template by extracting the variables into scope, and including
     * the template file.
     *
     * @internal param $template
     * @internal param $variables
     *
     * @return string
     */
    private function render_template( /*$template, $variables*/)
    {
        ob_start();
        foreach (func_get_args()[1] as $key => $value) {
            ${$key} = $value;
        }
        include func_get_args()[0];
        return ob_get_clean();
    }
}
