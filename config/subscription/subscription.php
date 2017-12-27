<?php

return [
    'user' => [
        'validation_rules' => [
            'subscription_id' => 'required',
            'user_id' => 'required|email',
        ]
    ],
    'subscription' => [
        'validation_rules' => [
            'name' => 'required',
            'amount_payable' => 'required|email',
            'details' => 'required',
            'plan_for' => 'required',
        ]
    ],
];
