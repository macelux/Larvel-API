<?php
namespace App\Traits;
use Illuminate\Database\Eloquent\Builder;
use Exception;

trait HasCompositePrimaryKeyTrait
{


    public function getIncrementing()
    {
        return false;
    }


    //Set the keys for a save update query.
    protected function setKeysForSaveQuery($query)
    {

        foreach ($this->getKeyName() as $key) {
            // UPDATE: Added isset() per devflow's comment.
            if (isset($this->$key)) {
                $query->where($key, '=', $this->$key);
            } else
                throw new Exception(__METHOD__ . 'Missing part of the primary key: ' . $key);
        }
        return $query;
    }


//    protected function getKeyForSaveQuery($keyName = null)
//    {
//
//        if (is_null($keyName)) {
//            $keyName = $this->getKeyName();
//        }
//
//        if (isset($this->original[$keyName])) {
//            return $this->original[$keyName];
//        }
//
//        return $this->getAttribute($keyName);
//    }


    //Execute a query for a single record by ID.
    protected static function find($ids, $columns = ['*'])
    {
        $me = new self;
        $query = $me->newQuery();
        $i=0;

        foreach ($me->getKeyName() as $key) {
            $query->where($key, '=', $ids[$i]);
            $i++;
        }

        return $query->first($columns);
    }

}

