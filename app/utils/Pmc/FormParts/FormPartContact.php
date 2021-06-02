<?php


namespace App\utils\Pmc\FormParts;


use App\Models\PmcForm as Model;
use App\utils\Pmc\EmailManager\EmailManager;
use App\utils\Pmc\FormPartAbstract;
use Illuminate\Http\Request;

class FormPartContact extends FormPartAbstract
{

    protected $fields = ['first_name', 'last_name', 'company', 'job_title',
//        'email',
        'phone', 'country', 'country', 'state', 'address', 'city', 'zip_code', 'company_url', ];

    public function toJson()
    {
        $output = parent::toJson();

        $output->email = $this->model->email;
        $output->navigator_level = $this->model->navigation_level;
        $output->program = EmailManager::NicePath($this->model->path);
        $output->logins = Model::where('email', $this->model->email)->select(['id'])->get()->count();
        return $output;
    }

}
