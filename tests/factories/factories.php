<?php

$factory('App\ContentItem',[
    'user_id'=> 'factory:App\User',
    'title'=> $faker->sentence,
    'content'=> $faker->paragraph
]);

$factory('App\User',[
    'name'=> $faker->userName,
    'email'=> $faker->email,
    'password'=> Hash::make('testing1234')
]);
