<?php


namespace App\utils\Pmc\EmailManager\Contracts;


interface EmailsProviderContract
{
    public function Check(string $email): ?RecognizedEmailAddressContract;
}
