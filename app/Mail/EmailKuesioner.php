<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailKuesioner extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The demo object instance.
     *
     * @var Ronda
     */
    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        //
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->from(
            $this->data->senderEmail,
            $this->data->email,
            $this->data->senderName,
            $this->data->subject,
            $this->data->message,
            $this->data->name,
            $this->data->no_tiket,
        )
            ->subject($this->data->subject)->to($this->data->email)->markdown('mails.belumkuoesioner')->with([
                'message' => $this->data->message,
                'sender' => $this->data->senderName,
                'subject' => $this->data->subject,
            ]);
    }
}
