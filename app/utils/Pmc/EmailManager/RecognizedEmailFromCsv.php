<?php


namespace App\utils\Pmc\EmailManager;


class RecognizedEmailFromCsv implements Contracts\RecognizedEmailAddressContract
{

    public function __construct(array $row)
    {
        $this->email = $row['Partner Email'];
        $this->navigationLevel = $row['Partner Navigation Level'];
        $this->path = $row['Path'];
        $this->campaignManager = $row['Campaign Manager'];
    }

    private $email;
    private $navigationLevel;
    private $path;
    private $campaignManager;

    public function Email(): string
    {
        return $this->email;
    }

    public function NavigationLevel(): string
    {
        return $this->navigationLevel;
    }

    public function Path(): string
    {
        return $this->path;
    }

    public function PathNice(): string
    {
        return EmailManager::NicePath($this->path);
    }

    public function CampaignManager(): string
    {
        return $this->campaignManager;
    }
}
