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
     * @return array
     */
    public function getKey(string $key): ?array;
    
    /**
     * @param string $key
     * @param $array
     * @param int $time
     * @return array
     */
    public function setKey(string $key, $array, int $time): bool;
    
    /**
     * @param string $key
     * @return array
     */
    public function deleteKey(string $key): bool;
}