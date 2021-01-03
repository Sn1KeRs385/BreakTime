<?php

namespace App\Traits\Models;

use Illuminate\Database\Eloquent\Builder;

trait HasCompositePrimaryKey
{
    public function getIncrementing()
    {
        return false;
    }

    protected function setKeysForSaveQuery(Builder $query)
    {
        foreach ($this->getKeyName() as $key) {
            // UPDATE: Added isset() per devflow's comment.
            if (isset($this->$key))
                $query->where($key, '=', $this->$key);
            else
                throw new \Exception(__METHOD__ . 'Missing part of the primary key: ' . $key);
        }

        return $query;
    }

    public static function find($ids, $columns = ['*'])
    {
        $me = new self;
        $query = $me->newQuery();
        foreach ($me->getKeyName() as $key) {
            $query->where($key, '=', $ids[$key]);
        }
        return $query->first($columns);
    }
}

