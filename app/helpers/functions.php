<?php

use app\helpers\Auth;

if (!function_exists('auth')) {
    function auth(): Auth
    {
        return new Auth();
    }
}

