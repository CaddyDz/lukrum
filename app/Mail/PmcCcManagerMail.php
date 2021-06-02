<?php

namespace App\Mail;

use App\Models\PmcForm as PmcModel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class PmcCcManagerMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @param PmcModel $model
     * @param Collection $filesToSend
     *
     * @return void
     */
    public function __construct(PmcModel $model, Collection $filesToSend)
    {
        //
        $this->model = clone $model;
        $cc = $model->customCreative;
        $this->filesToSend = $filesToSend;

        switch($this->model->path) {
            case 'cib':
                $this->model->program = 'Campaign in a Box';
                break;

            default:
                $this->model->program = 'Custom Creative';
                break;
        }

        $options = [
            'Slope' => 1,
            'Simple' => 2,
            'Watch' => 3,
            'Girl' => 4,
            'Blue' => 5,
        ];

        $this->model->design_option_number = ($options[$cc->layout_code] ?? 'Unknown')." ({$cc->layout_code})";
        $this->model->launch_date = $this->model->launch_date_time ? (new \DateTime($this->model->launch_date_time))->format('m/d/Y') : '';
        $this->model->submission_date = (new \DateTime($this->model->created_at))->format('m/d/Y');
    }

    private $model;
    private $filesToSend;

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $m = $this->view('emails.manager_cc')->with([
            'm' => $this->model,
            'cc' => $this->model->customCreative,
            'f' => $this->filesToSend,
        ])->subject("{$this->model->company} {$this->model->program}")
            ->bcc('ahhmed@mail.ru')
            ->bcc('crogers@pierryinc.com')
//            ->bcc('')
            ;

//        foreach($this->filesToSend as $f) {

//dump(storage_path($f['storage_path']));
//            $m->attachFromStorage(storage_path($f['storage_path']), $f['file_name']);
//            $m->attachFromStorage($f['storage_path'], $f['file_name']);
//        }

        return $m;
    }
}
