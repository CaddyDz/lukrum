<?php

declare(strict_types=1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CopyMail extends Mailable
{
	use Queueable, SerializesModels;

	private string $raw_content, $custom_subject;

	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct(string $raw_content, string $custom_subject)
	{
		$this->raw_content = $raw_content;
		$this->custom_subject = $custom_subject;
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build()
	{
		return $this->from(auth()->user()->email, auth()->user()->name)
				->html($this->raw_content)
				->subject($this->custom_subject);
	}
}
