<?php


namespace App\utils\Pmc;

use Illuminate\Http\Request;

use App\Models\PmcForm as Model;

abstract class FormPartAbstract
{
    /**
     * @param Model $model
     * @return static
     */
    public static function FromModel(Model $model) {
        $instance = new static();
        $instance->model = $model;
        $instance->init();
        return $instance;
    }


    /**
     * @var Model
     */
    protected $model;

    protected function __construct()
    {
    }

    public function FillFromRequest(Request $request) {
        foreach($this->fields as $f) {
            $this->model->{$f} = $request->{$f};
        }
    }

    protected $fields = [];

    public function toJson() {
        $output = new \stdClass();
        foreach($this->fields as $f) {
            $output->{$f} = $this->model->{$f};
        }
        return $output;
    }

    protected function init() {

    }
}
