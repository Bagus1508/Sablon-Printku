<?php

if (!function_exists('setTitle')) {
    function setTitle($title)
    {
        session(['page_title' => $title]);
    }
}
