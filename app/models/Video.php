<?php

require_once __DIR__ . '/../config/Database.php';

class Video
{
    /**
     * Helper to extract YouTube video ID from various YouTube URL formats:
     * - Standard watch URL: https://www.youtube.com/watch?v=VIDEO_ID
     * - Short URL: https://youtu.be/VIDEO_ID
     * - Embed URL: https://www.youtube.com/embed/VIDEO_ID
     * - Shorts URL: https://www.youtube.com/shorts/VIDEO_ID
     * - Or direct 11-char ID
     */
    public static function extractYoutubeId(string $url): ?string
    {
        $url = trim($url);
        if (empty($url)) {
            return null;
        }

        // Direct 11-character alphanumeric ID
        if (preg_match('/^[a-zA-Z0-9_-]{11}$/', $url)) {
            return $url;
        }

        // Regex matching watch?v=, embed/, v/, shorts/, and youtu.be/
        $pattern = '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?|shorts)\/|.*[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/i';
        if (preg_match($pattern, $url, $matches)) {
            return $matches[1];
        }

        return null;
    }

    /**
     * Create a YouTube video record in the gallery_videos table.
     */
    public static function create(string $title, string $url, string $category = 'on-stage', int $displayOrder = 0): bool
    {
        $youtubeId = self::extractYoutubeId($url);
        if (!$youtubeId) {
            return false;
        }

        $validCategories = ['on-stage', 'close-up', 'events'];
        if (!in_array($category, $validCategories, true)) {
            $category = 'on-stage';
        }

        $db = Database::getConnection();
        $stmt = $db->prepare("
            INSERT INTO gallery_videos (title, youtube_url, youtube_id, category, display_order, created_at)
            VALUES (:title, :youtube_url, :youtube_id, :category, :display_order, NOW())
        ");

        return $stmt->execute([
            ':title'         => trim($title),
            ':youtube_url'   => trim($url),
            ':youtube_id'    => $youtubeId,
            ':category'      => $category,
            ':display_order' => $displayOrder,
        ]);
    }

    /**
     * Fetch all videos ordered by display_order ASC, created_at DESC.
     */
    public static function all(): array
    {
        $db = Database::getConnection();
        $stmt = $db->query("SELECT * FROM gallery_videos ORDER BY display_order ASC, created_at DESC");
        return $stmt->fetchAll();
    }

    /**
     * Find a single video by ID.
     */
    public static function find(int $id): ?array
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM gallery_videos WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    /**
     * Delete a video record by ID.
     */
    public static function delete(int $id): bool
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("DELETE FROM gallery_videos WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
