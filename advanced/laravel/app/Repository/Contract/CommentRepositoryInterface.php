<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 20/05/2020
 * Time: 16:13
 */

namespace App\Repository\Contract;

/**
 * Interface CommentRepositoryInterface
 * @package App\Repository\Contract
 */
interface CommentRepositoryInterface
{
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
    public function getCommentByPostId(int $id): array;
}