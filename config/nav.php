<?php
return [
    [
    'icon' => 'nav-icon fas fa-tachometer-alt',
    'route'=>'dashboard.index',
    'title' =>'Dashboard',
    'active' =>'dashboard.dashboard'
    ],
    [
        'icon' => 'far fa-circle nav-icon',
        'route'=>'dashboard.categories.index',
        'title' =>'Categories',
        'active' =>'dashboard.categories.*',
        'badge' =>'New'
    ],
    [
        'icon' => 'far fa-circle nav-icon',
        'route'=>'dashboard.categories.index',
        'title' =>'Products',
        'active' =>'dashboard.categories.*',
        // 'badge' =>'Coming soon'
    ],
    [
        'icon' => 'far fa-circle nav-icon',
        'route'=>'dashboard.categories.index',
        'title' =>'Orders',
        'active' =>'dashboard.categories.*',
        'badge' =>'New'
    ],

];
