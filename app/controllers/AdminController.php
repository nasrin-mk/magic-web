<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Admin.php';
require_once __DIR__ . '/../models/Enquiry.php';
require_once __DIR__ . '/../models/GalleryImage.php';
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
     * GET /admin/media or GET /admin/videos
     */
    public function media(): void
    {
        $this->requireAuth();
        $images = GalleryImage::all();
        $videos = Video::all();

        $this->render('admin/media', [
            'pageTitle' => 'Media Manager | Admin Control Panel',
            'activeTab' => 'media',
            'images'    => $images,
            'videos'    => $videos,
        ]);
    }

    /**
     * Alias for media() to support /admin/videos
     */
    public function videos(): void
    {
        $this->media();
    }

    /**
     * POST /admin/images/upload or POST /admin/images/add
     */
    public function uploadImage(): void
    {
        $this->requireAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title        = trim($_POST['title'] ?? '');
            $category     = trim($_POST['category'] ?? 'on-stage');
            $displayOrder = (int)($_POST['display_order'] ?? 0);

            if (empty($title)) {
                $this->setFlash('error', 'Photo title is required.');
                $this->redirect('/admin/media');
                return;
            }

            if (empty($_FILES['image_file']) || $_FILES['image_file']['error'] !== UPLOAD_ERR_OK) {
                $this->setFlash('error', 'Please select a valid image file to upload.');
                $this->redirect('/admin/media');
                return;
            }

            $file = $_FILES['image_file'];

            // Limit file size to 8MB (8 * 1024 * 1024 bytes)
            $maxBytes = 8 * 1024 * 1024;
            if ($file['size'] > $maxBytes) {
                $this->setFlash('error', 'Image file exceeds the 8MB size limit.');
                $this->redirect('/admin/media');
                return;
            }

            // Validate extension and MIME type
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
            $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            if (!in_array($ext, $allowedExtensions, true)) {
                $this->setFlash('error', 'Invalid file extension. Allowed formats: JPG, JPEG, PNG, WEBP.');
                $this->redirect('/admin/media');
                return;
            }

            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimeType = finfo_file($finfo, $file['tmp_name']);
            finfo_close($finfo);

            $allowedMimes = ['image/jpeg', 'image/png', 'image/webp'];
            if (!in_array($mimeType, $allowedMimes, true)) {
                $this->setFlash('error', 'Invalid image MIME type: ' . htmlspecialchars($mimeType));
                $this->redirect('/admin/media');
                return;
            }

            // Target directory
            $uploadDir = __DIR__ . '/../../public/uploads/gallery/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            // Unique hash filename (e.g. img_67290_a1b2c3d4.webp)
            $filename = 'img_' . uniqid() . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
            $destination = $uploadDir . $filename;

            if (move_uploaded_file($file['tmp_name'], $destination)) {
                // Mirror to root uploads/gallery if present
                $rootUploadDir = __DIR__ . '/../../uploads/gallery/';
                if (is_dir($rootUploadDir)) {
                    @copy($destination, $rootUploadDir . $filename);
                }

                $saved = GalleryImage::create($title, 'uploads/gallery/' . $filename, $category, $displayOrder);
                if ($saved) {
                    $this->setFlash('success', 'Photo "' . htmlspecialchars($title) . '" uploaded successfully!');
                } else {
                    $this->setFlash('error', 'File was saved, but database insertion failed.');
                }
            } else {
                $this->setFlash('error', 'Could not move the uploaded file. Check folder write permissions.');
            }
        }

        $this->redirect('/admin/media');
    }

    /**
     * POST /admin/images/delete
     */
    public function deleteImage(): void
    {
        $this->requireAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int)($_POST['id'] ?? 0);
            if ($id > 0) {
                GalleryImage::delete($id);
                $this->setFlash('success', 'Photo #' . $id . ' and its image file were permanently deleted.');
            } else {
                $this->setFlash('error', 'Invalid photo ID.');
            }
        }

        $this->redirect('/admin/media');
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
            $category     = trim($_POST['category'] ?? 'on-stage');
            $displayOrder = (int)($_POST['display_order'] ?? 0);

            if (empty($title) || empty($youtubeUrl)) {
                $this->setFlash('error', 'Both title and YouTube URL are required.');
                $this->redirect('/admin/media');
                return;
            }

            $youtubeId = Video::extractYoutubeId($youtubeUrl);
            if (!$youtubeId) {
                $this->setFlash('error', 'Could not detect a valid YouTube Video ID. Please check the URL format.');
                $this->redirect('/admin/media');
                return;
            }

            $saved = Video::create($title, $youtubeUrl, $category, $displayOrder);
            if ($saved) {
                $this->setFlash('success', 'YouTube video "' . htmlspecialchars($title) . '" was added successfully!');
            } else {
                $this->setFlash('error', 'Failed to save the video to the database.');
            }
        }

        $this->redirect('/admin/media');
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
                $this->setFlash('success', 'YouTube video #' . $id . ' has been removed.');
            } else {
                $this->setFlash('error', 'Invalid video ID.');
            }
        }

        $this->redirect('/admin/media');
    }
}
