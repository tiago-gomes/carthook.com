<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 20/05/2020
 * Time: 16:13
 */

namespace App\Repository\Contract;


interface PostRepositoryInterface
{
    /**
     * @return array
     */
    public function all(): array;
    
    /**
     * @param array $params
     * @return array
     */
    public function create(array $params): array;
    
    /**
     * @param int $id
     * @return array
     */
    public function getById(int $id): array;
    
    /**
     * @param int $id
     * @return array
     */
    public function getPostByUserId(int $id): array;
}