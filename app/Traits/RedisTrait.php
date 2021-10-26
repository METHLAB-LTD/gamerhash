<?php

namespace App\Traits;

use Illuminate\Support\Facades\Redis;

trait RedisTrait {
    public function getArrayFromRedis(string $index): array
    {
        $storedValue = Redis::get($index);
        if(is_null($storedValue)) {
            return [];
        }

        return (array) json_decode($storedValue);
    }

    public function setNewArrayToRedis(string $index, array $array): array
    {
        Redis::set($index, json_encode($array));

        return $array;
    }

    public function pushToArrayInRedis(string $index, array $array): array
    {
        $storedValue = $this->getArrayFromRedis($index);
        $newValue = array_merge($storedValue, $array);
        Redis::set($index, json_encode($newValue));

        return $newValue;
    }
}
