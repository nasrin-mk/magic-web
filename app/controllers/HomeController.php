<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Blog.php';

class HomeController extends Controller
{
    /**
     * Render the main landing page.
     */
    public function index(): void
    {
        $blogs = Blog::getLatestPosts(3);

        $this->render('pages/home', [
            'pageTitle' => 'Magicnas | Professional Magician in Dubai',
            'activeNav' => 'home',
            'blogs'     => $blogs,
        ]);
    }

    /**
     * Render the About page.
     */
    public function about(): void
    {
        $this->render('pages/about', [
            'pageTitle' => 'About | Magicnas - Professional Magician in Dubai',
            'activeNav' => 'about',
        ]);
    }

    /**
     * Render the Services page.
     */
    public function services(): void
    {
        $this->render('pages/services', [
            'pageTitle' => 'Services | Magicnas - Professional Magician in Dubai',
            'activeNav' => 'services',
        ]);
    }

    /**
     * Render the Contact page with the enquiry form.
     */
    public function contact(): void
    {
        $this->render('pages/contact', [
            'pageTitle' => 'Contact & Bookings | Magicnas',
            'activeNav' => 'contact',
        ]);
    }
}
