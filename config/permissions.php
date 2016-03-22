<?php

return [
    'Users.SimpleRbac.permissions' => [
        [
            'role' => '*',
            'controller' => ['Pages'],
            'action' => ['other', 'display'],
            'allowed' => true,
        ],
        [
            'role' => '*',
            'plugin' => 'CakeDC/Users',
            'controller' => '*',
            'action' => '*',
        ],
        [
            'role' => 'user',
            'plugin' => 'CakeDC/Users',
            'controller' => 'Users',
            'action' => ['register', 'edit', 'view'],
        ],
        [
            'role' => 'user',
            'plugin' => 'CakeDC/Users',
            'controller' => 'Users',
            'action' => '*',
            'allowed' => false,
        ],
    ]
];
