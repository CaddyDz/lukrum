<?php

declare(strict_types=1);

namespace App\Nova\Actions;

use Mail;
use App\Mail\CopyMail;
use App\Models\Template;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Illuminate\Queue\InteractsWithQueue;
use Laravel\Nova\Fields\{ActionFields, Text, Trix};

class CreateEmail extends Action
{
	use InteractsWithQueue, Queueable;

	/**
	 * The text to be used for the action's confirm button.
	 *
	 * @var string
	 */
	public $confirmButtonText = 'Send Email';

	/**
	 * The text to be used for the action's confirmation text.
	 *
	 * @var string
	 */
	public $confirmText = 'Are you sure you want to send this email?';

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
			Mail::to($fields->email)->send(new CopyMail($fields->content));
		}
	}

	/**
	 * Get the fields available on the action.
	 *
	 * @return array
	 */
	public function fields(): array
	{
		$content = Template::first()->content;
		return [
			Text::make(__('Email'), 'email')->required(),
			Trix::make(__('Content'), 'content')->required()
			->default(fn () => $content),
		];
	}
}
