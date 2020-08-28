<?php

return [
    'tags' => [
        'tag_limit' => 12,
    ],

    'users' => [
        'user_limit' => 12,
    ],

    'posts' => [
        'post_limit' => 15,
        'type' => [
            'followings' => 'followings',
            'newest' => 'newest',
            'drafts' => 'drafts',
            'publish' => 'publish',
        ],
        'popular' => 15,
        'up_vote' => 1,
        'down_vote' => 0,
        'remove_vote' => 2,
        'published' => 1,
        'un_published' => 0,
    ],
];
