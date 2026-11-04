<?php

require_once __DIR__ . '/../config/Database.php';

class Admin
{
    /**
     * Find an admin by username.
     */
    public static function findByUsername(string $username): ?array
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM admins WHERE username = :username LIMIT 1");
        $stmt->execute([':username' => trim($username)]);
        $admin = $stmt->fetch();
        return $admin ?: null;
    }

    /**
     * Verify credentials against admins table using password_verify.
     */
    public static function authenticate(string $username, string $password): ?array
    {
        $admin = self::findByUsername($username);
        if ($admin && password_verify($password, $admin['password_hash'])) {
            return $admin;
        }
        return null;
    }
}
