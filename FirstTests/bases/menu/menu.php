<?php

return [ //ul

    [ //a
        'link' => 'https://google.com',
        'name' => 'Google',
        'visible' => false,
    ],
    [ //a
        'link' => 'https://bing.com',
        'name' => 'Beurk',
        'menu' => [
            [
                'link' => 'http://duckduckgo.com',
                'name' => 'bestduck'
            ]
        ]
    ],
    [ //a
        'link' => 'https://aol.com',
        'name' => 'Les opticiens',
        'menu' => [ //ul
            [ //a
                'link' => 'https://lycos.com',
                'name' => 'Lycos',
            ]
        ]
    ]
];
