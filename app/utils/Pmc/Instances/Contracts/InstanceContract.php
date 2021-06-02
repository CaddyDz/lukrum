<?php


namespace App\utils\Pmc\Instances\Contracts;


interface InstanceContract
{

    public function Code(): string;

    public function FrontEndJson();
    public function Favicon();

    public function CssLinkTag();

    public function Cib(): InstanceCibContract;

    public function LayoutsManager(): string;

    public function HasPayment(): bool;
    public function HasCalendly(): bool;

    public function S3Folder(): string;
}
