<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 20/05/2020
 * Time: 16:16
 */

namespace App\Repository;

use App\Repository\Contract\CommentRepositoryInterface;
use Illuminate\Support\Facades\DB;

/**
 * Class CommentRepository
 * @package App\Repository
 */
class CommentRepository implements CommentRepositoryInterface
{
    
    private $table = "comment";
    
    /**
     * @param array $params
     * @return array
     */
    public function create(array $params): array
    {
        $array['postId'] = $params['postId'];
        $array['name'] = $params['name'];
        $array['email'] = $params['email'];
        $array['body'] = $params['body'];
        $id = DB::table($this->table)->insertGetId($params);
        return $this->getById($id);
    }
    
    /**
     * @param int $id
     * @return array
     */
    public function getById(int $id): array
    {
        return DB::table($this->table)
          ->select(['*'])
          ->where('id', '=', $id)
          ->get()
          ->all();
    }
    
    /**
     * @param int $id
     * @return array
     */
    public function getCommentByPostId(int $id): array
    {
        return DB::table($this->table)
          ->select(['*'])
          ->where('postId', '=', $id)
          ->get()
          ->all();
    }
}