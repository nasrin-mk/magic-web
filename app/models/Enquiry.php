<?php

require_once __DIR__ . '/../config/Database.php';

class Enquiry
{
    /**
     * Store a new enquiry in MySQL.
     */
    public static function create(array $data): bool
    {
        $db = Database::getConnection();

        $stmt = $db->prepare("
            INSERT INTO enquiries (full_name, phone, email, event_type, event_date, expected_guests, message, status, created_at)
            VALUES (:full_name, :phone, :email, :event_type, :event_date, :expected_guests, :message, :status, NOW())
        ");

        $eventDate = !empty($data['event_date']) ? $data['event_date'] : null;
        $expectedGuests = !empty($data['expected_guests']) ? $data['expected_guests'] : null;
        $status = !empty($data['status']) ? $data['status'] : 'unread';

        return $stmt->execute([
            ':full_name'       => trim($data['full_name'] ?? ''),
            ':phone'           => trim($data['phone'] ?? ''),
            ':email'           => trim($data['email'] ?? ''),
            ':event_type'      => trim($data['event_type'] ?? ''),
            ':event_date'      => $eventDate,
            ':expected_guests' => $expectedGuests,
            ':message'         => trim($data['message'] ?? ''),
            ':status'          => $status,
        ]);
    }

    /**
     * Retrieve all enquiries sorted by newest first.
     */
    public static function all(): array
    {
        $db = Database::getConnection();
        $stmt = $db->query("SELECT * FROM enquiries ORDER BY created_at DESC");
        return $stmt->fetchAll();
    }

    /**
     * Delete an enquiry by ID.
     */
    public static function delete(int $id): bool
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("DELETE FROM enquiries WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    /**
     * Find a single enquiry by ID.
     */
    public static function find(int $id): ?array
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM enquiries WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    /**
     * Update status (unread, read, archived).
     */
    public static function updateStatus(int $id, string $status): bool
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("UPDATE enquiries SET status = :status WHERE id = :id");
        return $stmt->execute([
            ':status' => $status,
            ':id'     => $id
        ]);
    }
}
