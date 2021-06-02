<?php

namespace App\Mail;

use App\Models\PmcForm as PmcModel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PmcConfirmMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @param PmcModel $model
     *
     * @return void
     */
    public function __construct(PmcModel $model)
    {
        //
        $this->model = $model;
    }

    private $model;

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.confirm')->with([
            'model' => $this->model,
        ]);
    }
}
