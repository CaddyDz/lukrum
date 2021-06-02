<?php


namespace App\utils\Pmc\ManagerManager;


class ManagerManager
{
    public function GetByCode(string $code): ?array {
        $code = strtolower($code);
        if(isset($this->list[$code])) {
            return $this->list[$code];
        }
        return null;
    }

    private $list = [

        'az' => [
            'name' => 'Developer Test',
            'email' => 'ahhmed@mail.ru',
        ],

        'cr' => [
            'name' => 'Clay Robeson',
            'email' => 'crobeson@pierryinc.com',
        ],
        'im' => [
            'name' => 'Iris Mori',
            'email' => 'imori@pierryinc.com',
        ],
        'ym' => [
            'name' => 'Yvonne Mosley',
            'email' => 'ymosley@pierryinc.com',
        ],
        'sm' => [
            'name' => 'Sonia Mokdad',
            'email' => 'sonia.mokdad@wundermanthompson.com',
        ],
        'rk' => [
            'name' => 'Robin Kennedy',
            'email' => 'Robin.Kennedy@wundermanthompson.com',
        ],
        'kc' => [
            'name' => 'Kevin Caputo',
            'email' => 'kcaputo@pierryinc.com',
        ],

        'cs' => [
            'name' => 'Christine Schlict',
            'email' => 'cschlict@pierryinc.com',
        ],

        'qa' => [
            'name' => 'quality assurance',
            'email' => 'qa@dms.partners',
        ],

    ];
}
