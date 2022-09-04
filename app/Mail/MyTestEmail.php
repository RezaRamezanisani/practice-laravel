<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MyTestEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $name = 'reza';
    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.wellcome')->subject('Wellcome to Site market');
        //Tips:
        //php artisan make:mail MyTestEmail
        //methods build
        //view for HTML ,text for text(path) ,attach(path/to/file),subject(),from() فرستنده ی ایمیل که اگر مشخص کنیم اون فرستنده ی پیش فرض رد می شود.
        // public for send data to view
    }
}
