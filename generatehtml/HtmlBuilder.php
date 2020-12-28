<?php


/**
 * Class HtmlBuilder
 * @todo
 * 1. Учитывать закрывающийся тэг (одиночный тэг)
 * 2. Реализовать вложенность элементов
 */
class HtmlBuilder
{
    /**
     * @var string
     */
    protected $html = '';

    /**
     * HtmlBuilder constructor.
     */
    public function __construct()
    {

    }

    /**
     * @param $element
     */
    protected function addHtml($element)
    {
        $this->html .= $element . PHP_EOL;
    }


    /**
     * @param $elementName
     * @param string $content
     * @param array $attr
     */
    public function createElement($elementName, $content = '', $attr = [])
    {
        $attrString = '';

        if (!empty($attr) && is_array($attr)) {
            foreach ($attr as $name => $value) {
                $attrString .= $name . '="' . $value . '" ';
            }
        }

        $element = '<' . $elementName . ' '. $attrString . '>' . $content . '</' . $elementName . '>';
        $this->addHtml($element);
    }

    /**
     *
     */
    public function getHtml()
    {
        echo $this->html;
    }

}