<?php


namespace App\utils\Pmc\EmailManager\Contracts;


interface RecognizedEmailAddressContract
{
    public function Email(): string;
    public function NavigationLevel(): string;
    public function Path(): string;
    public function PathNice(): string;
    public function CampaignManager(): string;

        //Partner Email	            Partner Navigation Level	Path	Campaign Manager
        //crobeson@pierryinc.com   	N4MC	                    cc	    cr

}
