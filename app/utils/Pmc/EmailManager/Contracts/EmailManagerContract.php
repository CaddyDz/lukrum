<?php


namespace App\utils\Pmc\EmailManager\Contracts;


interface EmailManagerContract
{
    public function CheckEmail(string $email): ?RecognizedEmailAddressContract;
}
