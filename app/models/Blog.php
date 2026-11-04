<?php

class Blog
{
    private const FEED_URL = 'https://www.magicnas.com/feeds/posts/default?alt=rss&max-results=3';
    private const CACHE_TTL = 3600; // 1 hour

    /**
     * Retrieve the latest blog posts from Blogger RSS feed with file caching.
     *
     * @param int $limit Maximum number of posts to return
     * @return array Array of blog items [title, link, date, thumbnail, snippet]
     */
    public static function getLatestPosts(int $limit = 3): array
    {
        $cacheFile = __DIR__ . '/../../public/cache_blog.json';

        // Check cache validity (1 hour TTL)
        if (file_exists($cacheFile) && (time() - filemtime($cacheFile) < self::CACHE_TTL)) {
            $cachedContent = file_get_contents($cacheFile);
            $cachedData = json_decode($cachedContent, true);
            if (is_array($cachedData) && !empty($cachedData)) {
                return array_slice($cachedData, 0, $limit);
            }
        }

        // Fetch fresh feed via cURL
        $posts = self::fetchFromFeed($limit);

        if (!empty($posts)) {
            // Save parsed posts to cache
            @file_put_contents($cacheFile, json_encode($posts, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
            return $posts;
        }

        // Fallback: If fetch failed, try serving stale cache if available
        if (file_exists($cacheFile)) {
            $staleContent = file_get_contents($cacheFile);
            $staleData = json_decode($staleContent, true);
            if (is_array($staleData)) {
                return array_slice($staleData, 0, $limit);
            }
        }

        // Safe fallback if both network and cache fail
        return [];
    }

    /**
     * Fetch and parse RSS feed.
     */
    private static function fetchFromFeed(int $limit): array
    {
        $xmlContent = null;

        if (function_exists('curl_init')) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, self::FEED_URL);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 6);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 4);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_USERAGENT, 'MagicnasBlogReader/1.0 (XAMPP/PHP)');
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $xmlContent = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($httpCode !== 200 || empty($xmlContent)) {
                $xmlContent = null;
            }
        }

        // Fallback to file_get_contents if cURL was empty
        if (empty($xmlContent) && ini_get('allow_url_fopen')) {
            $context = stream_context_create([
                'http' => [
                    'timeout' => 6,
                    'user_agent' => 'MagicnasBlogReader/1.0 (XAMPP/PHP)'
                ]
            ]);
            $xmlContent = @file_get_contents(self::FEED_URL, false, $context);
        }

        if (empty($xmlContent)) {
            return [];
        }

        libxml_use_internal_errors(true);
        $xml = simplexml_load_string($xmlContent);
        if (!$xml || !isset($xml->channel->item)) {
            return [];
        }

        $posts = [];
        $baseUrl = defined('BASE_URL') ? BASE_URL : '';
        $defaultThumb = $baseUrl . '/images/blog-default.jpg';

        foreach ($xml->channel->item as $item) {
            $title = trim((string)$item->title);
            $link = trim((string)$item->link);

            // Format date as d M, Y (e.g. 04 Nov, 2026)
            $pubDateRaw = (string)$item->pubDate;
            $timestamp = !empty($pubDateRaw) ? strtotime($pubDateRaw) : time();
            $formattedDate = date('d M, Y', $timestamp);

            // Extract thumbnail image from description
            $descriptionHtml = (string)$item->description;
            $thumbnail = $defaultThumb;
            if (preg_match('/<img[^>]+src=["\']([^"\']+)["\']/i', $descriptionHtml, $matches)) {
                $thumbnail = $matches[1];
            }

            // Clean snippet: strip tags, decode entities, collapse whitespace, truncate to 140 chars
            $cleanText = html_entity_decode(strip_tags($descriptionHtml), ENT_QUOTES | ENT_HTML5, 'UTF-8');
            // Remove non-breaking spaces and symbols
            $cleanText = str_replace(["\xc2\xa0", '&nbsp;'], ' ', $cleanText);
            $cleanText = trim(preg_replace('/\s+/', ' ', $cleanText));
            // Strip leading hashtag / markdown titles if present
            $cleanText = ltrim($cleanText, '# ');

            if (mb_strlen($cleanText) > 140) {
                $snippet = mb_substr($cleanText, 0, 140) . '...';
            } else {
                $snippet = $cleanText;
            }

            $posts[] = [
                'title'     => $title,
                'link'      => $link,
                'date'      => $formattedDate,
                'thumbnail' => $thumbnail,
                'snippet'   => $snippet,
            ];

            if (count($posts) >= $limit) {
                break;
            }
        }

        return $posts;
    }
}
