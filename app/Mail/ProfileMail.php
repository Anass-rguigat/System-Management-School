<?php
namespace App\Mail;

use App\Models\User;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProfileMail extends Mailable
{
    use SerializesModels;

    public $user;
    public $plaintextPassword;

    /**
     * Create a new message instance.
     *
     * @param string $plaintextPassword
     * @param User $user
     */
    public function __construct($plaintextPassword, User $user)
    {
        $this->plaintextPassword = $plaintextPassword;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return \Illuminate\Mail\Mailable
     */
    public function build()
    {
        return $this->view('emails.welcome')
                    ->with([
                        'userName' => $this->user->name,
                        'userEmail' => $this->user->email,
                        'plaintextPassword' => $this->plaintextPassword, 
                    ])
                    ->subject('Your account in school');
    }
}

