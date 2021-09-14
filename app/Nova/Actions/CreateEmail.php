<?php

declare(strict_types=1);

namespace App\Nova\Actions;

use Mail;
use App\Mail\CopyMail;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Illuminate\Queue\InteractsWithQueue;
use Laravel\Nova\Fields\{ActionFields, Text, Trix};

class CreateEmail extends Action
{
	use InteractsWithQueue, Queueable;

	/**
	 * Perform the action on the given models.
	 *
	 * @param \Laravel\Nova\Fields\ActionFields $fields
	 * @param \Illuminate\Support\Collection $models
	 * @return mixed
	 */
	public function handle(ActionFields $fields, Collection $models)
	{
		foreach ($models as $model) {
			Mail::to($fields->email)->send(new CopyMail($model->content));
		}
	}

	/**
	 * Get the fields available on the action.
	 *
	 * @return array
	 */
	public function fields(): array
	{
		return [
			Text::make(__('Email'), 'email')->required(),
			Trix::make(__('Content'), 'content')->required(),
		];
	}
}
