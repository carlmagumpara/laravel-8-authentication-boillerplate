<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendVerificationCode extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $user;
    protected $code;
    protected $url;

    public function __construct(User $user, int $code, $url)
    {
        $this->user = $user;
        $this->code = $code;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(config('mail.from.address'))
                    ->subject('Account verification')
                    ->markdown('emails.verification', [
                        'first_name' => $this->user->first_name,
                        'code' => $this->code,
                        'url' => $this->url,
                    ]);
    }
}
