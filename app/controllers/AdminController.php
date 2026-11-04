<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Admin.php';
require_once __DIR__ . '/../models/Enquiry.php';
require_once __DIR__ . '/../models/Video.php';

class AdminController extends Controller
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE && !headers_sent()) {
            session_start();
        }
    }

    /**
     * Ensure the user has an active admin session.
     */
    private function requireAuth(): void
    {
        if (empty($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            $this->setFlash('error', 'Please log in to access the admin dashboard.');
            $this->redirect('/admin/login');
            exit;
        }
    }

    /**
     * GET /admin or GET /admin/login
     */
    public function login(): void
    {
        if (!empty($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
            $this->redirect('/admin/enquiries');
            return;
        }

        $this->render('admin/login', [
            'pageTitle' => 'Admin Login | Magicnas Control Panel',
        ]);
    }

    /**
     * POST /admin/login
     */
    public function authenticate(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/admin/login');
            return;
        }

        $username = trim($_POST['username'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if (empty($username) || empty($password)) {
            $this->setFlash('error', 'Please enter both username and password.');
            $this->redirect('/admin/login');
            return;
        }

        $admin = Admin::authenticate($username, $password);

        if ($admin) {
            session_regenerate_id(true);
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_username'] = $admin['username'];

            $this->setFlash('success', 'Welcome back, ' . htmlspecialchars($admin['username']) . '!');
            $this->redirect('/admin/enquiries');
            return;
        }

        $this->setFlash('error', 'Invalid username or password.');
        $this->redirect('/admin/login');
    }

    /**
     * GET /admin/logout or POST /admin/logout
     */
    public function logout(): void
    {
        unset($_SESSION['admin_logged_in']);
        unset($_SESSION['admin_id']);
        unset($_SESSION['admin_username']);
        session_destroy();

        if (session_status() === PHP_SESSION_NONE && !headers_sent()) {
            session_start();
        }
        $this->setFlash('success', 'You have been securely logged out.');
        $this->redirect('/admin/login');
    }

    /**
     * GET /admin/enquiries
     */
    public function enquiries(): void
    {
        $this->requireAuth();
        $enquiries = Enquiry::all();

        $this->render('admin/enquiries', [
            'pageTitle'  => 'Manage Enquiries | Admin Dashboard',
            'activeTab'  => 'enquiries',
            'enquiries'  => $enquiries,
        ]);
    }

    /**
     * POST /admin/enquiries/delete
     */
    public function deleteEnquiry(): void
    {
        $this->requireAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int)($_POST['id'] ?? 0);
            if ($id > 0) {
                Enquiry::delete($id);
                $this->setFlash('success', 'Enquiry #' . $id . ' has been deleted.');
            } else {
                $this->setFlash('error', 'Invalid enquiry ID.');
            }
        }

        $this->redirect('/admin/enquiries');
    }

    /**
     * POST /admin/enquiries/status
     */
    public function updateEnquiryStatus(): void
    {
        $this->requireAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int)($_POST['id'] ?? 0);
            $status = trim($_POST['status'] ?? 'read');
            if ($id > 0 && in_array($status, ['unread', 'read', 'archived'], true)) {
                Enquiry::updateStatus($id, $status);
                $this->setFlash('success', 'Enquiry #' . $id . ' marked as ' . $status . '.');
            }
        }

        $this->redirect('/admin/enquiries');
    }

    /**
     * GET /admin/videos
     */
    public function videos(): void
    {
        $this->requireAuth();
        $videos = Video::all();

        $this->render('admin/videos', [
            'pageTitle' => 'Manage YouTube Videos | Admin Dashboard',
            'activeTab' => 'videos',
            'videos'    => $videos,
        ]);
    }

    /**
     * POST /admin/videos/add
     */
    public function addVideo(): void
    {
        $this->requireAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title        = trim($_POST['title'] ?? '');
            $youtubeUrl   = trim($_POST['youtube_url'] ?? '');
            $displayOrder = (int)($_POST['display_order'] ?? 0);

            if (empty($title) || empty($youtubeUrl)) {
                $this->setFlash('error', 'Both title and YouTube URL are required.');
                $this->redirect('/admin/videos');
                return;
            }

            $youtubeId = Video::extractYoutubeId($youtubeUrl);
            if (!$youtubeId) {
                $this->setFlash('error', 'Could not detect a valid YouTube Video ID. Please check the URL format.');
                $this->redirect('/admin/videos');
                return;
            }

            $saved = Video::create($title, $youtubeUrl, $displayOrder);
            if ($saved) {
                $this->setFlash('success', 'YouTube video "' . htmlspecialchars($title) . '" was added successfully!');
            } else {
                $this->setFlash('error', 'Failed to save the video to the database.');
            }
        }

        $this->redirect('/admin/videos');
    }

    /**
     * POST /admin/videos/delete
     */
    public function deleteVideo(): void
    {
        $this->requireAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int)($_POST['id'] ?? 0);
            if ($id > 0) {
                Video::delete($id);
                $this->setFlash('success', 'Video #' . $id . ' has been removed.');
            } else {
                $this->setFlash('error', 'Invalid video ID.');
            }
        }

        $this->redirect('/admin/videos');
    }
}
