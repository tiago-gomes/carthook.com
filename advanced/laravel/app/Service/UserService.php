<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 20/05/2020
 * Time: 11:56
 */

namespace App\Service;

use App\Service\Contract\UserInterface;
use Illuminate\Support\Facades\Http;

/**
 * Class UserService
 * @package App\Service
 */
class UserService implements UserInterface
{
    
    private $endpoint = 'http://jsonplaceholder.typicode.com/users';
    
    /**
     * @return array
     */
    public function all(): array
    {
        $response = Http::get($this->endpoint);
        return $response->json();
    }
}