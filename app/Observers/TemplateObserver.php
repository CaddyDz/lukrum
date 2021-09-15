<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Template;

class TemplateObserver
{
	/**
	 * Handle the Template "creating" event.
	 *
	 * @param  \App\Models\Template  $template
	 * @return void
	 */
	public function creating(Template $template)
	{
		if (auth()->check()) {
			$template->user_id = auth()->id();
		}
	}

	/**
	 * Handle the Template "created" event.
	 *
	 * @param  \App\Models\Template  $template
	 * @return void
	 */
	public function created(Template $template)
	{
		//
	}

	/**
	 * Handle the Template "updated" event.
	 *
	 * @param  \App\Models\Template  $template
	 * @return void
	 */
	public function updated(Template $template)
	{
		//
	}

	/**
	 * Handle the Template "deleted" event.
	 *
	 * @param  \App\Models\Template  $template
	 * @return void
	 */
	public function deleted(Template $template)
	{
		//
	}

	/**
	 * Handle the Template "restored" event.
	 *
	 * @param  \App\Models\Template  $template
	 * @return void
	 */
	public function restored(Template $template)
	{
		//
	}

	/**
	 * Handle the Template "force deleted" event.
	 *
	 * @param  \App\Models\Template  $template
	 * @return void
	 */
	public function forceDeleted(Template $template)
	{
		//
	}
}
