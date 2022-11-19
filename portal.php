<?php

require "system/autoload.php";

$template = new Template(__DIR__ . '/layouts/');
$loginBox = $template->render('portal/loginBox');
$base = $template->render('portal/base', [
    'content' => $loginBox
]);
echo $base;
