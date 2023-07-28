<?php

return
[
	'views_style_directory'=> 'crudgen',
	'separate_style_according_to_actions' =>
    [
        'index'=>
        [
            'extends'=>'layouts.backend.index',
            'section'=>'content'
        ],
        'show'=>
        [
            'extends'=>'layouts.backend.index',
            'section'=>'content'
        ],
    ],

];
