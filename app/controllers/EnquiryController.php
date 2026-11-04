<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Enquiry.php';

class EnquiryController extends Controller
{
    /**
     * Handle POST /enquiry/submit
     */
    public function submit(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/contact');
            return;
        }

        // Sanitize and extract input fields
        $fullName       = trim(strip_tags($_POST['full_name'] ?? $_POST['name'] ?? ''));
        $phone          = trim(strip_tags($_POST['phone'] ?? ''));
        $email          = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
        $eventType      = trim(strip_tags($_POST['event_type'] ?? ''));
        $eventDate      = trim(strip_tags($_POST['event_date'] ?? ''));
        $expectedGuests = trim(strip_tags($_POST['expected_guests'] ?? $_POST['guests'] ?? ''));
        $message        = trim(strip_tags($_POST['message'] ?? ''));

        // Basic validation
        $errors = [];
        if (empty($fullName)) {
            $errors[] = 'Full name is required.';
        }
        if (empty($phone)) {
            $errors[] = 'Phone number is required.';
        }
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'A valid email address is required.';
        }
        if (empty($eventType)) {
            $errors[] = 'Event type is required.';
        }
        if (empty($message)) {
            $errors[] = 'Message is required.';
        }

        // Format event date (validate YYYY-MM-DD if provided)
        $formattedDate = null;
        if (!empty($eventDate)) {
            $d = DateTime::createFromFormat('Y-m-d', $eventDate);
            if ($d && $d->format('Y-m-d') === $eventDate) {
                $formattedDate = $eventDate;
            }
        }

        if (!empty($errors)) {
            $this->setFlash('error', implode(' ', $errors));
            // Redirect back to referring page or contact
            $redirectUrl = !empty($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/contact';
            $this->redirect($redirectUrl);
            return;
        }

        $created = Enquiry::create([
            'full_name'       => $fullName,
            'phone'           => $phone,
            'email'           => $email,
            'event_type'      => $eventType,
            'event_date'      => $formattedDate,
            'expected_guests' => $expectedGuests,
            'message'         => $message,
            'status'          => 'unread',
        ]);

        if ($created) {
            $this->setFlash('success', 'Thank you! Your enquiry has been received. We will get back to you within 24 hours.');
        } else {
            $this->setFlash('error', 'Something went wrong while submitting your enquiry. Please try again.');
        }

        $redirectUrl = !empty($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/contact';
        $this->redirect($redirectUrl);
    }
}
