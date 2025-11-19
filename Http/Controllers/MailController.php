<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Mail\MailForm;


class MailController extends Controller
{
    public function sendEmail($title, $body)
    {
        $detail = [
            'title' => $title,
            'body' => $body
        ];
        Mail::send('emails.TestMail', ['detail' => $detail], function ($message) {
            $message->subject('Tax');
            $message->to('developers4041@gmail.com');
        });
        return "Email Send"; 
    }
}
