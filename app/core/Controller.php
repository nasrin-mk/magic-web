<?php

class Controller
{
    /**
     * Render a view file with data.
     *
     * @param string $view Relative view path e.g. 'pages/home' or 'admin/enquiries'
     * @param array $data Data variables extracted into the view
     */
    protected function render(string $view, array $data = []): void
    {
        extract($data);
        $viewFile = __DIR__ . '/../views/' . $view . '.php';

        if (!file_exists($viewFile)) {
            http_response_code(500);
            echo "View not found: " . htmlspecialchars($view);
            return;
        }

        require $viewFile;
    }

    /**
     * Redirect to another URL or route.
     */
    protected function redirect(string $path): void
    {
        // If absolute URL
        if (preg_match('/^https?:\/\//i', $path)) {
            header("Location: " . $path);
            exit;
        }

        $base = defined('BASE_URL') ? BASE_URL : '';
        $path = '/' . ltrim($path, '/');
        header("Location: " . $base . $path);
        exit;
    }

    /**
     * Set a flash message in session.
     */
    protected function setFlash(string $key, string $message): void
    {
        if (session_status() === PHP_SESSION_NONE && !headers_sent()) {
            session_start();
        }
        $_SESSION['flash_' . $key] = $message;
    }
}
