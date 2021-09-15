<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Email;

class EmailObserver
{
	/**
	 * Handle the Email "creating" event.
	 *
	 * @param  \App\Models\Email  $email
	 * @return void
	 */
	public function creating(Email $email)
	{
		if (auth()->check()) {
			$email->user_id = auth()->id();
		}
	}

	/**
	 * Handle the Email "created" event.
	 *
	 * @param  \App\Models\Email  $email
	 * @return void
	 */
	public function created(Email $email)
	{
		//
	}

	/**
	 * Handle the Email "updated" event.
	 *
	 * @param  \App\Models\Email  $email
	 * @return void
	 */
	public function updated(Email $email)
	{
		//
	}

	/**
	 * Handle the Email "deleted" event.
	 *
	 * @param  \App\Models\Email  $email
	 * @return void
	 */
	public function deleted(Email $email)
	{
		//
	}

	/**
	 * Handle the Email "restored" event.
	 *
	 * @param  \App\Models\Email  $email
	 * @return void
	 */
	public function restored(Email $email)
	{
		//
	}

	/**
	 * Handle the Email "force deleted" event.
	 *
	 * @param  \App\Models\Email  $email
	 * @return void
	 */
	public function forceDeleted(Email $email)
	{
		//
	}
}
