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
    function csrf_field(): string
{
        return Security::csrfField();
}

    function asset(?string $path): string
{
        return $path ? BASEURL . '/' . ltrim($path, '/') : '';
}

    function tanggal($value, bool $withTime = false): string
{
if (!$value) {
        return '-';
    }

    $timestamp = strtotime((string) $value);
    if ($timestamp === false) {
        return '-';
    }

    return date($withTime ? 'd/m/Y H:i' : 'd/m/Y', $timestamp);
}
function view_shared_data(): array
{
    $current = strtolower(explode('/', trim($_GET['url'] ?? 'home', '/'))[0] ?? 'home');
    if ($current === '' || $current === 'dashboard') {
        $current = 'home';
    }

    return [
        'flash' => take_flash(),
        'loggedIn' => Middleware::isLoggedIn(),
        'user' => Middleware::user(),
        'current' => $current,
        'navItems' => [
            'employees' => ['label' => 'Data Karyawan', 'icon' => 'people', 'url' => 'employees'],
        ],
    ];
}