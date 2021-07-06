<?php

namespace Sqits\Searchable\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

trait HasSearchable
{
    public function scopeSearchable(Builder $query, Request $request = null) : Builder
    {
        if ($request === null) {
            $request = request();
        }

        if ($request->get(config('searchable.parameter')) === null || ! is_array($request->get(config('searchable.parameter')))) {
            return $query;
        }

        $searchables = array_intersect_key(
            $request->get(config('searchable.parameter')),
            $this->getSearchables()
        );

        if ($searchables) {
            $this->addSearchablesToBuilder($searchables, $query);
        }

        return $query;
    }

    private function addSearchablesToBuilder(array $searchables, Builder $query) : Builder
    {
        $query->where(function (Builder $query) use ($searchables) {
            foreach ($searchables as $key => $value) {
                if (empty($value)) {
                    continue;
                }

                $searchable = $this->searchables[$key];

                if (is_array($searchable)) {

                    // TODO: handle when the value is also an array with multiple values to search on

                    // TODO: handle relationships which has an array

                    $query->where(function ($query) use ($searchable, $value) {
                        foreach ($searchable as $column => $operator) {
                            if ($operator === 'like') {
                                $value = '%'.$value.'%';
                            }

                            $query->orWhere($column, $operator, $value);
                        }
                    });
                } else {
                    if (is_array($value)) {
                        $values = $value;

                        if (method_exists($query->getModel(), $key)) {
                            $query->whereHas($key, function ($query) use ($key, $values) {
                                $query->where(function($query) use ($key, $values) {
                                    foreach ($values as $value) {
                                        if ($this->searchables[$key] === 'like') {
                                            $value = '%'.$value.'%';
                                        }

                                        $query->orWhere('id', $this->searchables[$key], $value);
                                    }
                                });
                            });
                        } else {
                            $query->where(function ($query) use ($key, $values) {
                                foreach ($values as $value) {
                                    if ($this->searchables[$key] === 'like') {
                                        $value = '%'.$value.'%';
                                    }

                                    $query->orWhere($key, $this->searchables[$key], $value);
                                }
                            });
                        }

                    } else {
                        if ($this->searchables[$key] === 'like') {
                            $value = '%'.$value.'%';
                        }

                        if (method_exists($query->getModel(), $key)) {
                            $query->whereHas($key, function ($query) use ($key, $value) {
                                $query->where('id', $this->searchables[$key], $value);
                            });
                        } else {
                            $query->where($key, $this->searchables[$key], $value);
                        }
                    }
                }
            }
        });

        return $query;
    }


    private function getSearchables() : array
    {
        return $this->searchables ?? [];
    }
}
