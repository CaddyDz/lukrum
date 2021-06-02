<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignInABox extends Model
{
    use HasFactory;

    protected $table = 'cib';

    public function form() {
        return $this->belongsTo(PmcForm::class, 'form_id');
    }
}
