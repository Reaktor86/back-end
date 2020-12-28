<?php
// HTML builder
require ('HtmlBuilder.php');


$attributes = [
    'class' => 'my-class',
    'id' => 'first'
];

$obj = new HtmlBuilder();
$obj->createElement('h2', 'Title2', $attributes);
$obj->createElement('p', 'Text');
$obj->createElement('p', 'Text2');
$obj->createElement('a', 'Link', ['href' => 'https://google.com']);
?>


<div>
    <div>
        <h1>Static title</h1>
        <? $obj->getHtml();?>
    </div>
</div>

