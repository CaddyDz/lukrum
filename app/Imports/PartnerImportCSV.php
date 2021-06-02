<?php

namespace App\Imports;

use App\Models\Models\Partner as ModelsPartner;
use App\Models\Partner;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class PartnerImportCSV implements ToCollection, WithStartRow
{
    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }
    
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            $exists = Partner::where('email', $row[0])->first();
            if (!$exists) {
                Partner::create([
                    'email' => $row[0],
                    'navigation_level' => $row[1],
                    'path' => $row[2],
                    'campaign_manager' => $row[3],
                ]);
            }
        }
    }
}
