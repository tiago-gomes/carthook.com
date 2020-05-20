<?php
    /**
     * Created by PhpStorm.
     * User: User
     * Date: 20/05/2020
     * Time: 16:14
     */
    
namespace App\Repository;

use App\Repository\Contract\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;

/**
 * Class UserRepository
 * @package App\Repository
 */
class UserRepository implements UserRepositoryInterface
{
    private $table = "user";
    
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
        $array['name'] = $params['name'];
        $array['email'] = $params['email'];
        $array['phone'] = $params['phone'];
        $array['website'] = $params['website'];
        $id = DB::table($this->table)->insertGetId($array);
        return $this->getById($id);
    }
    
    /**
     * @param string $email
     * @return array
     */
    public function getByEmail(string $email): array
    {
        return DB::table($this->table)
          ->select(['*'])
          ->where('email', 'like', '%'.$email.'%')
          ->get()
          ->all();
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
}