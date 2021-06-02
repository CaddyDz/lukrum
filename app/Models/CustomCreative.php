<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomCreative extends Model
{
    use HasFactory;

    protected $table = 'custom_creative';

    public function form() {
        return $this->belongsTo(PmcForm::class, 'form_id');
    }
}
