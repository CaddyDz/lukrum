<?php

declare(strict_types=1);

namespace App\Nova;

use Illuminate\Http\Request;
use App\Nova\Actions\CreateEmail;
use Laravel\Nova\Fields\{ID, Text, Trix};
use NumaxLab\NovaCKEditor5Classic\CKEditor5Classic;

class Template extends Resource
{
	/**
	 * The model the resource corresponds to.
	 *
	 * @var string
	 */
	public static $model = \App\Models\Template::class;

	/**
	 * The single value that should be used to represent the resource when being displayed.
	 *
	 * @var string
	 */
	public static $title = 'name';

	/**
	 * The columns that should be searched.
	 *
	 * @var array
	 */
	public static $search = [
		'name', 'content',
	];

	/**
	 * Get the fields displayed by the resource.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return array
	 */
	public function fields(Request $request)
	{
		return [
			ID::make(__('ID'), 'id')->sortable(),
			Text::make(__('Name'), 'name')->sortable()->required(),
			Trix::make(__('Content'), 'content')->required(),
			// CKEditor5Classic::make('Content')->withFiles('public'),
		];
	}

	/**
	 * Get the cards available for the request.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return array
	 */
	public function cards(Request $request)
	{
		return [];
	}

	/**
	 * Get the filters available for the resource.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return array
	 */
	public function filters(Request $request)
	{
		return [];
	}

	/**
	 * Get the lenses available for the resource.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return array
	 */
	public function lenses(Request $request)
	{
		return [];
	}

	/**
	 * Get the actions available for the resource.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return array
	 */
	public function actions(Request $request)
	{
		return [
			(new CreateEmail)->onlyOnTableRow()
		];
	}
}
