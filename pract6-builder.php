<?php

class FormBuilder
{
    protected $html = '';
    protected $formContent = "";

    protected function addHtml($element)
    {
        $this->html .= $element . PHP_EOL . $this->formContent . '<form>' . PHP_EOL;
    }

    protected function addContent($element)
    {
        $this->formContent .= $element . PHP_EOL;
    }

    public function createForm($action = '', $method = '')
    {
        $result = '<form action="' . $action . '" method="' . $method . '">';
        $this->addHtml($result);
    }

    public function createInput($attr = [])
    {
        $attrString = '';
        if (!empty($attr) && is_array($attr)) {
            foreach ($attr as $attrName => $attrVal) {
                $attrString .= $attrName . '="' . $attrVal . '" ';
            }
        }
        $result = '<input ' . $attrString . '>';
        $this->addContent($result);
    }

    public function createTextarea($attr = [])
    {
        $attrString = '';
        if (!empty($attr) && is_array($attr)) {
            foreach ($attr as $attrName => $attrVal) {
                $attrString .= $attrName . '="' . $attrVal . '" ';
            }
        }
        $result = '<textarea ' . $attrString  . '></textarea>';
        $this->addContent($result);
    }

    public function createSelect($options = [], $attr = [])
    {
        $attrString = '';
        if (!empty($attr) && is_array($attr)) {
            foreach ($attr as $attrName => $attrVal) {
                $attrString .= $attrName . '="' . $attrVal . '" ';
            }
        }
        $optionsString = '';
        if (!empty($options) && is_array($options)) {
            foreach ($options as $k => $attrVal) {
                $optionsString .= '<option>' . $attrVal . '</option>' . PHP_EOL;
            }
        }
        $result = '<select ' . $attrString . '>' . $optionsString . '</select>';
        $this->addContent($result);
    }

    public function createButton($attr = [], $content = '')
    {
        $attrString = '';
        if (!empty($attr) && is_array($attr)) {
            foreach ($attr as $attrName => $attrVal) {
                $attrString .= $attrName . '="' . $attrVal . '" ';
            }
        }
        $result = '<button ' . $attrString . '>' . $content . '</button>';
        $this->addContent($result);
    }

    protected function getAttrString($array, $tag = '')
        
        // ДОДЕЛАТЬ
    {
        $attrString = '';
        if (!empty($array) && is_array($array)) {
            foreach ($array as $k => $val) {
                if ($tag === '') {
                    $attrString .= $k . '="' . $val . '" ';
                } else {
                    $attrString .= '<' . $tag . ' ' . $k. '>' . $val . '</' . $tag . '>';
                }
            }
        }
        return $attrString;
    }

    public function getHtml()
    {
        echo $this->html;
    }
}

class Command
{
    protected $command = [];

    public function addPlayer($player)
    {
        $this->command[] = $player;
    }

    public function getCommand()
    {
        shuffle($this->command);
        foreach ($this->command as $k => $val) {
            echo "<p>" . $val . "</p>";
        }
    }
}