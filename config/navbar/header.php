<?php
/**
 * Supply the basis for the navbar as an array.
 */



return [
    // Use for styling the menu
    "wrapper" => null,
    "class" => "my-navbar rm-default rm-desktop",

    // Here comes the menu items
    "items" => [
        [
            "text" => "Home",
            "url" => "",
            "title" => "Homepage",
        ],
        [
            "text" => "Users",
            "url" => "users",
            "title" => "List of users",
        ],
        [
            "text" => "Questions",
            "url" => "questions",
            "title" => "List of questions",
        ],
        [
            "text" => "Tags",
            "url" => "tags",
            "title" => "List of tags",
        ],
        [
            "text" => "About",
            "url" => "about",
            "title" => "About this site",
        ],
        [
            "text" => "Profile",
            "url" => "profile",
            "title" => "My profile",
        ],
        [
            "text" => "Log in",
            "url" => "profile",
            "title" => "My profile",
        ],
    ],
];
