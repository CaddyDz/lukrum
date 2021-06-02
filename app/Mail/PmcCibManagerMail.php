<?php

namespace App\Mail;

use App\Models\PmcForm as PmcModel;
use App\utils\Pmc\EmailManager\EmailManager;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class PmcCibManagerMail extends Mailable
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
//        $cib = $model->cib;
        $this->filesToSend = $filesToSend;

        $this->model->program = EmailManager::NicePath($this->model->path);

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

        ['setup' => $setup, 'common' => $common, 'questions' => $questions] = instance($this->model->instance)->Cib()->Copies();

        $touchpoints = [
            'tp1' => ['title' => 'INTRO'],
            'tp2' => ['title' => 'WHY'],
            'tp3' => ['title' => 'HOW'],
            'tp4' => ['title' => 'CONSULT'],
        ];
        foreach($touchpoints as $tpCode => $info) {
            if(!$common[$tpCode]['enabled']) {
                unset($touchpoints[$tpCode]);
            } else {
                $touchpoints[$tpCode]['steps'] = $common[$tpCode]['pages'];
                $touchPoints[$tpCode]['title'] = strtoupper($common[$tpCode]['short_title']);
            }
        }

        $m = $this->view('emails.manager_cib')->with([
            'm' => $this->model,
            'cib' => $this->model->cib,
            'f' => $this->filesToSend,
            'touchpoints' => $touchpoints,
            'questions' => $questions['enabled'],
        ])->subject("{$this->model->company} {$this->model->program}")
            ->bcc('ahhmed@mail.ru')
            ->bcc('crogers@pierryinc.com')
        ;

//        foreach($this->filesToSend as $f) {

//dump(storage_path($f['storage_path']));
//            $m->attachFromStorage(storage_path($f['storage_path']), $f['file_name']);
//            $m->attachFromStorage($f['storage_path'], $f['file_name']);
//        }

        return $m;
    }
}
