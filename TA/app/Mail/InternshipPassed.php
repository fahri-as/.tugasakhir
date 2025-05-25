<?php

namespace App\Mail;

use App\Models\Pelamar;
use App\Models\Magang;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InternshipPassed extends Mailable
{
    use Queueable, SerializesModels;

    public $pelamar;
    public $magang;

    /**
     * Create a new message instance.
     *
     * @param  Pelamar  $pelamar
     * @param  Magang  $magang
     * @return void
     */
    public function __construct(Pelamar $pelamar, Magang $magang)
    {
        $this->pelamar = $pelamar;
        $this->magang = $magang;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Congratulations! You have successfully completed your internship')
                    ->markdown('emails.internship-passed')
                    ->with([
                        'pelamar' => $this->pelamar,
                        'magang' => $this->magang
                    ]);
    }
}
