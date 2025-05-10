<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Pelamar;
use App\Models\Interview;

class InterviewScheduled extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The pelamar instance.
     *
     * @var \App\Models\Pelamar
     */
    public $pelamar;

    /**
     * The interview instance.
     *
     * @var \App\Models\Interview
     */
    public $interview;

    /**
     * Create a new message instance.
     *
     * @param  \App\Models\Pelamar  $pelamar
     * @param  \App\Models\Interview  $interview
     * @return void
     */
    public function __construct(Pelamar $pelamar, Interview $interview)
    {
        $this->pelamar = $pelamar;
        $this->interview = $interview;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Jadwal Interview - ' . $this->pelamar->job->nama_job,
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'emails.interview-scheduled',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}