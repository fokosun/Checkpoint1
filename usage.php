<?php

declare (strict_types=1);

require __DIR__.'/vendor/autoload.php';

$dic = new \Florence\Dictionary();

var_dump($dic->find('buzzinga'));

var_dump(
    $dic->add(
        'Buzzingwe',
        'An exclamation of astonishment, originally used in "The X-Files"',
        'Yeah, Miley Cyrus is totally classy.... Buzzinga.'
    )
);

var_dump(
    $dic->delete(
        'Tight'
    )
);

print_r($dic->rankAndSort('i love good good maths'));
