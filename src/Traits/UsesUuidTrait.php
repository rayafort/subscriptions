<?php


namespace RayaFort\Subscriptions\Traits;

use Illuminate\Support\Str;

trait UsesUuidTrait
{
	protected static function bootUsesUuidTrait()
	{
		static::creating(function ($model) {
			if (! $model->getKey()) {
				$model->{$model->getKeyName()} = (string) Str::orderedUuid();
			}
		});
	}

	public function getIncrementing()
	{
		return false;
	}

	public function getKeyType()
	{
		return 'string';
	}
}