<?php


namespace App\utils\Pmc\FormParts;


use App\utils\Pmc\FormPartAbstract;
use Illuminate\Http\Request;

class FormPartCalendar extends FormPartAbstract
{
    public function FillFromRequest(Request $request)
    {

        if($this->_isStep2()) {
            $this->model->cib->appointment2_raw = $request->event_details;
            $this->model->cib->save();
        } else {
//            if ($request->need_update) {
                $this->model->appointment_raw = $request->event_details;
//            }
        }
    }

    public function toJson()
    {
        $output = new \stdClass();
        $output->name = "{$this->model->first_name} {$this->model->last_name}";
        $output->email = $this->model->email;

        if($this->_isStep2()) {
            $output->appointment_exists = (bool)strlen($this->model->cib->appointment2_raw);
        } else {
            $output->appointment_exists = (bool)strlen($this->model->appointment_raw);
        }

        return $output;
    }

    private function _isStep2() {
        if('cib' === $this->model->path) {
            if('initial-asset-review' === $this->step) {
                return true;
            }
        }

        return false;
    }

    public function setStep($step) {
        $this->step = $step;
    }

    private $step;
}
