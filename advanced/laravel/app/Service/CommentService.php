<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 20/05/2020
 * Time: 11:56
 */

namespace App\Service;

use App\Service\Contract\CommentInterface;
use Illuminate\Support\Facades\Http;

/**
 * Class CommentService
 * @package App\Service
 */
class CommentService implements CommentInterface
{
    
    private $endpoint = 'http://jsonplaceholder.typicode.com/comments';
    
    /**
     * @return array
     */
    public function all(): array
    {
        $response = Http::get($this->endpoint);
        return $response->json();
    }
}