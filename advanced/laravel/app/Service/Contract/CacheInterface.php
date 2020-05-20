<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 20/05/2020
 * Time: 12:03
 */

namespace App\Service\Contract;


interface CacheInterface
{
    /**
     * @param string $key
     * @return array|null
     */
    public function getKey(string $key): ?array;
    
    /**
     * @param string $key
     * @param $array
     * @param int $minutes
     * @return bool
     */
    public function setKey(string $key, $array, int $minutes): bool;
    
    /**
     * @param string $key
     * @return array
     */
    public function deleteKey(string $key): bool;
}