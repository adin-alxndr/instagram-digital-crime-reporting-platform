<?php
// app/Http/Controllers/UserwebController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserwebController extends Controller
{
    /**
     * Display home page
     */
    public function home()
    {
        return view('user-web.home');
    }

    /**
     * Display topics listing page
     */
    public function topics()
    {
        return view('user-web.topics');
    }

    /**
     * Display contact page
     */
    public function contact()
    {
        return view('user-web.contact');
    }

    /**
     * Handle contact form submission
     */
    public function submitContact(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10|max:5000',
        ], [
            'name.required' => 'Nama harus diisi',
            'name.string' => 'Nama harus berupa teks',
            'name.max' => 'Nama maksimal 255 karakter',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.max' => 'Email maksimal 255 karakter',
            'subject.required' => 'Subjek harus diisi',
            'subject.string' => 'Subjek harus berupa teks',
            'subject.max' => 'Subjek maksimal 255 karakter',
            'message.required' => 'Pesan harus diisi',
            'message.min' => 'Pesan minimal 10 karakter',
            'message.max' => 'Pesan maksimal 5000 karakter',
        ]);

        try {
            // Simpan contact message ke database (opsional)
            // ContactMessage::create($validated);

            // Send email notification (opsional)
            // Mail::send('emails.contact-notification', $validated, function($message) {
            //     $message->to(config('mail.from.address'))
            //             ->subject('New Contact Form Submission: ' . request()->input('subject'));
            // });

            return redirect()->route('user-web.contact')
                ->with('success', 'Pesan Anda telah berhasil dikirim. Kami akan segera menghubungi Anda.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Terjadi kesalahan saat mengirim pesan: ' . $e->getMessage()])
                ->withInput();
        }
    }
}