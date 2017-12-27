<?php

return [

    'category' => [
        'validation_rules' => [
            'name' => 'required',
        ]
    ],

    'subcategory' => [
        'validation_rules' => [
            'category_id' => 'required',
            'name' => 'required'
        ]
    ],

    'component' => [
        'validation_rules' => [
            'category_id' => 'required',
            'sub_category_id' => 'required'
        ]
    ],

];
