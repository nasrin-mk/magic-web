<?php

require_once __DIR__ . '/../config/Database.php';

class GalleryImage
{
    /**
     * Insert a new gallery image record.
     */
    public static function create(string $title, string $imagePath, string $category = 'on-stage', int $displayOrder = 0): bool
    {
        $validCategories = ['on-stage', 'close-up', 'events'];
        if (!in_array($category, $validCategories, true)) {
            $category = 'on-stage';
        }

        $db = Database::getConnection();
        $stmt = $db->prepare("
            INSERT INTO gallery_images (title, image_path, category, display_order, created_at)
            VALUES (:title, :image_path, :category, :display_order, NOW())
        ");

        return $stmt->execute([
            ':title'         => trim($title),
            ':image_path'    => trim($imagePath),
            ':category'      => $category,
            ':display_order' => $displayOrder,
        ]);
    }

    /**
     * Retrieve all images ordered by display_order ASC, created_at DESC.
     */
    public static function all(): array
    {
        $db = Database::getConnection();
        $stmt = $db->query("SELECT * FROM gallery_images ORDER BY display_order ASC, created_at DESC");
        return $stmt->fetchAll();
    }

    /**
     * Find single image by ID.
     */
    public static function find(int $id): ?array
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM gallery_images WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    /**
     * Delete image record AND unlink the physical file.
     */
    public static function delete(int $id): bool
    {
        $image = self::find($id);
        if ($image && !empty($image['image_path'])) {
            $relativePath = ltrim($image['image_path'], '/');
            // Remove from public/uploads/gallery/
            $publicFile = __DIR__ . '/../../public/' . $relativePath;
            if (file_exists($publicFile) && is_file($publicFile)) {
                @unlink($publicFile);
            }
            // Remove from root uploads/gallery/ if exists
            $rootFile = __DIR__ . '/../../' . $relativePath;
            if (file_exists($rootFile) && is_file($rootFile)) {
                @unlink($rootFile);
            }
        }

        $db = Database::getConnection();
        $stmt = $db->prepare("DELETE FROM gallery_images WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
