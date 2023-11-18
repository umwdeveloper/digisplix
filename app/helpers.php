<?php

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
