<?php
$json = file_get_contents('php://input');
$request = json_decode($json);
file_put_contents("SaveFinance.txt", $request, FILE_APPEND);
echo $request;