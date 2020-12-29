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
        $attrString = $this->getAttrString($attr);
        $result = '<input ' . $attrString . '>';
        $this->addContent($result);
    }

    public function createTextarea($attr = [])
    {
        $attrString = $this->getAttrString($attr);
        $result = '<textarea ' . $attrString  . '></textarea>';
        $this->addContent($result);
    }

    public function createSelect($options = [], $attr = [])
    {
        $attrString = $this->getAttrString($attr);
        $optionsString = $this->getAttrString($options, "option");
        $result = '<select ' . $attrString . '>' . $optionsString . '</select>';
        $this->addContent($result);
    }

    public function createButton($attr = [], $content = '')
    {
        $attrString = $this->getAttrString($attr);
        $result = '<button ' . $attrString . '>' . $content . '</button>';
        $this->addContent($result);
    }

    protected function getAttrString($array, $tag = '')
    {
        $attrString = '';
        if (!empty($array) && is_array($array)) {
            foreach ($array as $k => $val) {
                if ($tag === '') {
                    $attrString .= $k . '="' . $val . '" ';
                } else {
                    $attrString .= '<' . $tag . '>' . $val . '</' . $tag . '>';
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