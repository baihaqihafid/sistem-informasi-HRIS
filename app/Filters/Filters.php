// File: app/Config/Filters.php
// Tambahkan di dalam array $aliases yang sudah ada:

public array $aliases = [
    'csrf'     => \CodeIgniter\Filters\CSRF::class,
    'toolbar'  => \CodeIgniter\Filters\DebugToolbar::class,
    'honeypot' => \CodeIgniter\Filters\Honeypot::class,
    'invalidchars' => \CodeIgniter\Filters\InvalidChars::class,
    'secureheaders' => \CodeIgniter\Filters\SecureHeaders::class,

    // Filter autentikasi custom
    'auth' => \App\Filters\AuthFilter::class,
];