<?php

use Illuminate\Support\Facades\Storage;

// Generate random password
if (!function_exists('generateRandomPassword')) {
    function generateRandomPassword($length = 8) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()-_+=<>?';
        $characterCount = strlen($characters);
        $password = '';

        for ($i = 0; $i < $length; $i++) {
            $randomIndex = random_int(0, $characterCount - 1);
            $password .= $characters[$randomIndex];
        }

        return $password;
    }
}

// Get URL of the files
if (!function_exists('getURL')) {
    function getURL($path) {
        return Storage::url($path);
    }
}

// Generate random color
if (!function_exists('getRandomColor')) {
    function getRandomColor() {
        $letters = '0123456789ABCDEF';
        $color = '#';

        for ($i = 0; $i < 6; $i++) {
            $color .= $letters[random_int(0, 15)];
        }

        return $color;
    }
}

// Generate random code
if (!function_exists('getRandomCode')) {
    function getRandomCode(int $length) {
        $letters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $code = substr(str_shuffle($letters), 0, $length);

        return $code;
    }
}
