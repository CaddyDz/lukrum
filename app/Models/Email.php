<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class Email extends Model
{
	use HasFactory, SoftDeletes;

	public function template()
	{
		return $this->belongsTo(Template::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
