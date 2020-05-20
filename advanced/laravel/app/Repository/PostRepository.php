<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 20/05/2020
 * Time: 16:16
 */

namespace App\Repository;

use App\Repository\Contract\PostRepositoryInterface;
use Illuminate\Support\Facades\DB;


/**
 * Class PostRepository
 * @package App\Repository
 */
class PostRepository implements PostRepositoryInterface
{
    private $table = "post";
    
    /**
     * @return array
     */
    public function all(): array
    {
        return DB::table($this->table)
          ->select(['*'])
          ->get()
          ->all();
    }
    
    /**
     * @param array $params
     * @return array
     */
    public function create(array $params): array
    {
        $array['userId'] = $params['userId'];
        $array['title'] = $params['title'];
        $array['body'] = $params['body'];
        $id = DB::table($this->table)->insertGetId($array);
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
    public function getPostByUserId(int $id): array
    {
        return DB::table($this->table)
          ->select(['*'])
          ->where('userId', '=', $id)
          ->get()
          ->all();
    }
}