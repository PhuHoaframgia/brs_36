<?php
return [
    'paginate' => '9',
    'avatar_path' => '/uploads/images/',
    'avatar_default' => 'default.jpg',
    'image_url' => 'image/',
    'image_default' => 'default.jpg',
    'result' => [
        'success' => 'Success',
        'fail' => 'Fail',
    ],
    'reviews' => 'reviews',
    'marks' => 'marks',
    'favorites' => 'favorites',
    'comments' => 'comments',
    'likes' => 'likes',
    'follow' => 'relationships',
    'rates' => 'rates',
    'target_type' => [
        'comments' => 'App\Models\Comment',
        'reviews' => 'App\Models\Review',
        'favorites' => 'App\Models\Favorite',
        'marks' => 'App\Models\Mark',
        'follow' => 'App\Models\Relationship',
        'rates' => 'App\Models\Rate', 
    ],
];
