<?php

return [
    'youtube_urls_range'=>[
        'min' => 1,
        'max' => 2
    ],
    'images_range'=>[
        'min' => 1,
        'max' => 2
    ],
    'paragraph_lines_range'=>[
        'min' => 4,
        'max' => 10
    ],
    'paragraphs_range' =>[
        'min' => 6,
        'max' => 9
    ],
    'lists_range' =>[
        'min' => 1,
        'max' => 2
    ],
    'items_list_range' =>[
        'min' => 2,
        'max' => 4
    ],
    'headers_range' =>[
        'min' => 3,
        'max' => 7
    ],
    'files' => [
        'youtube_file' => __DIR__.'/../../files/youtube.txt',
        'img_file' => __DIR__.'/../../files/img.txt',
        'content_file' => __DIR__.'/../../files/content.txt',
        'key_file' => __DIR__.'/../../files/keys.txt',
        'name_file' => __DIR__.'/../../files/names.txt',
    ],
    'path_to_save' =>  __DIR__.'/../../content'
];