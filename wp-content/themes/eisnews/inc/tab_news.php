<?php
function get_tab_one_data()
{
  return
    [
      [
        'name' => 'সাহিত্য ও সংস্কৃতি',
        'slug' => 'literature-and-culture',
        'bg_color' => 'bg-pink',
        'border_color' => 'border-pink'
      ],
      [
        'name' => 'সম্পাদকীয়',
        'slug' => 'editorial',
        'bg_color' => 'bg-yellow',
        'border_color' => 'border-yellow',
      ],
      [
        'name' => 'উপ-সম্পাদকীয়',
        'slug' => 'op-editorial',
        'bg_color' => 'bg-green',
        'border_color' => 'border-green'
      ],
    ];
}

function get_tab_two_data()
{
  return
    [
      [
        'name' => 'প্রবাস',
        'slug' => 'emigrant',
        'default_bg' => 'bg-gray-200',
        'bg_color' => 'yellow-bg',
        'border_color' => 'border-yellow',
      ],
      [
        'name' => 'আবহাওয়া',
        'slug' => 'weather',
        'default_bg' => 'bg-gray-200',
        'bg_color' => 'green-bg',
        'border_color' => 'border-green'
      ],
      [
        'name' => 'চাকরি',
        'slug' => 'job',
        'default_bg' => 'bg-gray-200',
        'bg_color' => 'pink-bg',
        'border_color' => 'border-pink'
      ],
    ];
}
