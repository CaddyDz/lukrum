<?php


namespace App\utils\Pmc\EmailManager;

use App\Models\Partner;
use App\utils\Pmc\EmailManager\Contracts\RecognizedEmailAddressContract;

class EmailProviderCsv extends EmailProviderAbstract implements Contracts\EmailsProviderContract
{

    public function Check(string $email): ?RecognizedEmailAddressContract
    {
        $dataFolder  = __DIR__.'/Data';
        $fileName = 'data.csv';
        $iCode = instance()->Code();
        if('default' !== $iCode) {
            $tryFile = "{$iCode}.csv";
            if(is_readable("$dataFolder/{$tryFile}")) {
                $fileName = $tryFile;
            }
        }

        if($fp = @fopen("{$dataFolder}/{$fileName}", 'r')) {

            $head = array_map('trim', fgetcsv($fp));
            $bom = pack('H*','EFBBBF');
            $head[0] = preg_replace("/^$bom/", '', $head[0]);

            if($head != $this->headReference) {
                fclose($fp);
                return null;
            }

            $hCount = count($head);
            while($r = fgetcsv($fp)) {
                if(count($r) != $hCount) continue;
                $r = array_map('trim', $r);

                $row = array_combine($head, $r);
                if(strtolower($row['Partner Email']) == strtolower($email)) {
                    fclose($fp);
                    return new RecognizedEmailFromCsv($row);
                }
            }

            fclose($fp);
        }

        return null;
    }

    private $headReference = ['Partner Email', 'Partner Navigation Level', 'Path', 'Campaign Manager', ];

}
