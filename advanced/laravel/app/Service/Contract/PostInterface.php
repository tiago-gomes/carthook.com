<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 20/05/2020
 * Time: 11:47
 */

namespace App\Service\Contract;


interface PostInterface
{
    /**
     * @param array $params
     * @return array
     */
    public function all(): array;
}