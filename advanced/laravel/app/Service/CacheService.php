<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 20/05/2020
 * Time: 12:44
 */

namespace App\Service;

use \App\Service\Contract\CacheInterface;
use Illuminate\Support\Facades\Cache;

/**
 * Class CacheService
 * @package App\Service
 */
class CacheService  implements CacheInterface
{
    /**
     * @param string $key
     * @return bool
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function deleteKey(string $key): bool
    {
        return Cache::store('redis')->delete($key);
    }
    
    /**
     * @param string $key
     * @return array|null
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function getKey(string $key): ?array
    {
        return Cache::store('redis')->get($key);
    }
    
    /**
     * @param string $key
     * @param $array
     * @param int $time
     * @return bool
     */
    public function setKey(string $key, $array, int $time=60): bool
    {
        return Cache::store('redis')->add($key, $array, $time);
    }
}