<?php


namespace App\utils\Pmc\FormParts;


use App\Models\PmcForm as Model;
use App\utils\Pmc\EmailManager\EmailManager;
use App\utils\Pmc\FormPartAbstract;
use Illuminate\Http\Request;

class FormPartEmail extends FormPartAbstract
{

    public function FillFromRequest(Request $request)
    {
        parent::FillFromRequest($request);

        if($recognized = (new EmailManager())->CheckEmail($request->email)) { // Has to always be true here, but let's check anyway
            $this->model->navigation_level = $recognized->NavigationLevel();
            $this->model->path = $recognized->Path();
            $this->model->campaign_manager = $recognized->CampaignManager();
        }

    }

    protected $fields = ['email', 'lang', ];
}
