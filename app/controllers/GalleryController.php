<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Video.php';

class GalleryController extends Controller
{
    /**
     * Fetch all gallery videos and render the gallery view.
     */
    public function index(): void
    {
        $videos = Video::all();

        $this->render('pages/gallery', [
            'pageTitle' => 'Gallery & Video Showcase | Magicnas',
            'activeNav' => 'gallery',
            'videos'    => $videos,
        ]);
    }
}
