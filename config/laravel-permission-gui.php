<?php
return [
    "layout" => "laravel-permission-gui::app",
    "route-prefix" => "laravel-permission-gui",
    "middleware" => 'laravel-permission-gui.admin',
    "middleware-role" => 'admin'
];
