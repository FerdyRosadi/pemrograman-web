<?php

if (!function_exists('e')) {
    function e($value): string {
        return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('rupiah')) {
    function rupiah($value): string {
        return 'Rp ' . number_format((float)$value, 0, ',', '.');
    }
}

if (!function_exists('base_url')) {
    function base_url(string $path = ''): string {
        return BASEURL . '/' . ltrim($path, '/');
    }
}

if (!function_exists('take_flash')) {
    function take_flash(): ?array {
        if (empty($_SESSION['flash'])) return null;
        $f = $_SESSION['flash']; unset($_SESSION['flash']); return $f;
    }
}