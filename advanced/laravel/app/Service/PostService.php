<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 20/05/2020
 * Time: 11:56
 */

namespace App\Service;

use App\Service\Contract\PostInterface;
use Illuminate\Support\Facades\Http;

/**
 * Class PostService
 * @package App\Service
 */
class PostService implements PostInterface
{
    
    private $endpoint = 'http://jsonplaceholder.typicode.com/posts';
    
    /**
     * @return array
     */
    public function all(): array
    {
        $response = Http::get($this->endpoint);
        return $response->json();
    }
}