<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 20/05/2020
 * Time: 16:10
 */

namespace App\Repository\Contract;


interface UserRepositoryInterface
{
    /**
     * @return array
     */
    public function all(): array;
    
    /**
     * @param int $id
     * @return array
     */
    public function getById(int $id): array;
    
    /**
     * @param string $email
     * @return array
     */
    public function getByEmail(string $email): array;
    
    /**
     * @param array $params
     * @return array
     */
    public function create(array $params): array;
}