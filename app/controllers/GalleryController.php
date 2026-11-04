<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/GalleryImage.php';
require_once __DIR__ . '/../models/Video.php';

class GalleryController extends Controller
{
    /**
     * Fetch all gallery images and videos, and render the public gallery view.
     */
    public function index(): void
    {
        $images = GalleryImage::all();
        $videos = Video::all();

        $this->render('pages/gallery', [
            'pageTitle' => 'Gallery | Captured Moments | Magicnas',
            'activeNav' => 'gallery',
            'images'    => $images,
            'videos'    => $videos,
        ]);
    }
}
