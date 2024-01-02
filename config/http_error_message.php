<?php

// config/http_error_messages.php

return [
    'general' => [
        'error_updating' => 'Error occurred while updating',
        'error_fetching' => 'Error occurred while fetching',
        'error_creating' => 'Error occurred while creating',
        'not_found' => 'Not Found',
        'pokémon_cannot_learn_these_skills' => 'Pokémon cannot learn these skills',
    ],

    'auth' => [
        'unauthorized' => 'Unauthorized',
        'forbidden' => 'Forbidden',
        'invalid_token' => 'Invalid Token',
    ],

    'friendship' => [
        'already_friends' => 'You are already friends',
        'cannot_send_request_to_yourself' => 'You cannot send a friend request to yourself',
        'already_accepted' => 'Friend invitation already accepted',
        'already_processed' => 'Friend invitation already processed',
        'friend_not_found/not_accepted' => 'Friend not found or not accepted',
    ]
];
