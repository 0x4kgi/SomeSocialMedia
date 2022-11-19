<?php

require __DIR__ . '/system/Template.php';

$folder = __DIR__ . '/layouts/';

$base = new Template($folder);

$array = [
    'test',
    '1',
    '2',
    '3',
    '4',
    '5',
    '6',
    '7',
    '8',
    '9',
    '0',
    '1',
    '2',
    '3',
    '4',
];

$divs = '';

foreach ($array as $value) {
    $divs .= $base->render('tests/testDiv', [
        'content' => $value,
    ]);
}

$html = $base->render('tests/base', [
    'title' => 'this is a title',
    'content' => 'this is content' . $divs,
]);

print $html;
