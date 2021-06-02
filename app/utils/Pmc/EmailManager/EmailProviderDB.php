<?php


namespace App\utils\Pmc\EmailManager;

use App\Models\Partner;
use App\utils\Pmc\EmailManager\Contracts\RecognizedEmailAddressContract;

class EmailProviderDB extends EmailProviderAbstract implements Contracts\EmailsProviderContract
{
    public function Check(string $email): ?RecognizedEmailAddressContract
    {
        $partner = Partner::where('email', $email)->first();
        if ($partner) {
            $row['Partner Email'] = $partner->email;
            $row['Partner Navigation Level'] = $partner->navigation_level;
            $row['Path'] = $partner->path;
            $row['Campaign Manager'] = $partner->campaign_manager;
            return new RecognizedEmailFromCsv($row);
        }

        return null;
    }
}
