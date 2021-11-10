<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait ApiTrait
{
    public function scopeIncluded(Builder $query)
    {
        if (empty($this->allowIncluded) || empty(request('included')))
            return;
        $relations = explode(',', request('included')); // explode ( ",", post,relations2) => ['posts', 'relations2']
        $allowIncluded = collect($this->allowIncluded);

        foreach ($relations as $key => $relationShip) {
            if (!$allowIncluded->contains($relationShip))
                unset($relations[$key]);
        }

        $query->with($relations);
    }

    public function scopeFilter(Builder $query)
    {
        if (empty($this->allowFilter) || empty(request('filter')))
            return;
        $filters = request('filter');
        $allowFilter = collect($this->allowFilter);
        foreach ($filters as $filter => $value) {
            if ($allowFilter->contains($filter))
                $query->where($filter, 'LIKE', '%' . $value . '%');
        }
    }

    public function scopeSort(Builder $query)
    {
        if (empty($this->allowSort) || empty(request('sort')))
            return;
        $sortFields = explode(',', request('sort')); // sort=name => [name]
        $allowSort = collect($this->allowSort);
        foreach ($sortFields as $sortField) {
            $order = 'asc';
            if (substr($sortField, 0, 1) == '-') {
                $order = 'desc';
                $sortField = substr($sortField, 1);
            }

            if ($allowSort->contains($sortField))
                $query->orderBy($sortField, $order);
        }
    }

    public function scopeGetOrPaginate(Builder $query)
    {
        if (request('perPage')) {
            $perPage = intval(request('perPage'));
            if ($perPage)
                return $query->paginate($perPage);
        }
        return $query->get();
    }
}
