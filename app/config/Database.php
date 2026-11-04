<?php

class Database
{
    private static ?PDO $instance = null;

    private function __construct() {}
    private function __clone() {}

    public static function getConnection(): PDO
    {
        if (self::$instance === null) {
            $host = '127.0.0.1';
            $db   = 'magic_db';
            $user = 'root';
            $pass = '';
            $charset = 'utf8mb4';

            $dsn = "mysql:host={$host};dbname={$db};charset={$charset}";
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            try {
                self::$instance = new PDO($dsn, $user, $pass, $options);
            } catch (PDOException $e) {
                // Fallback to localhost if socket/networking requires it
                try {
                    $dsnFallback = "mysql:host=localhost;dbname={$db};charset={$charset}";
                    self::$instance = new PDO($dsnFallback, $user, $pass, $options);
                } catch (PDOException $ex) {
                    die("Database connection error: " . htmlspecialchars($e->getMessage()));
                }
            }
        }

        return self::$instance;
    }
}
