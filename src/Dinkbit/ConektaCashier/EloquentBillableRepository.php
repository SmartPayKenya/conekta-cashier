<?php

namespace Dinkbit\ConektaCashier;

use Illuminate\Support\Facades\Config;
use Dinkbit\ConektaCashier\Contracts\Billable as BillableContract;

class EloquentBillableRepository implements BillableRepositoryInterface
{
	/**
	 * Find a BillableInterface implementation by Conekta ID.
	 *
	 * @param  string  $conektaId
	 * @return \Dinkbit\ConektaCashier\BillableInterface
	 */
	public function find($conektaId)
	{
		$model = $this->createCashierModel(Config::get('services.conekta.model'));

		return $model->where($model->getConektaIdName(), $conektaId)->first();
	}

	/**
	 * Create a new instance of the Auth model.
	 *
	 * @param  string  $model
	 * @return \Dinkbit\ConektaCashier\BillableInterface
	 */
	protected function createCashierModel($class)
	{
		$model = new $class;

		if (! $model instanceof BillableContract) {
			throw new \InvalidArgumentException("Model does not implement Billable.");
		}

		return $model;
	}

}
