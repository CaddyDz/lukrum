<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PmcForm extends Model
{
    use HasFactory;


    const STATUS_NEW = 'new';
    const STATUS_FULFILLED = 'fulfilled';
    const STATUS_COMPLETED = 'completed';

    public function last8OfHash() {
        return substr($this->hash, -8);
    }

    public function customCreative() {
        return $this->hasOne(CustomCreative::class, 'form_id');
    }

    public function cib() {
        return $this->hasOne(CampaignInABox::class, 'form_id');
    }
}
