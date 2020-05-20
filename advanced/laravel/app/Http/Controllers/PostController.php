<?php
/**
 * Created by PhpStorm.
 * Post: Post
 * Date: 20/05/2020
 * Time: 12:47
 */

namespace App\Http\Controllers;

use App\Library\Search;
use App\Repository\CommentRepository;
use App\Repository\PostRepository;
use App\Service\CacheService;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Exceptions\ApiException;

/**
 * Class PostController
 * @package App\Http\Controllers
 */
class PostController extends BaseController
{
    
    /**
     * @var CacheService
     */
    private $cacheService;
    
    /**
     * @var CommentRepository
     */
    private $commentRepository;
    
    /**
     * @var PostRepository
     */
    private $postRepository;
    
    
    /**
     * PostController constructor.
     * @param CommentRepository $commentRepository
     * @param CacheService $cacheService
     * @param PostRepository $postRepository
     */
    public function __construct(
      CommentRepository $commentRepository,
      CacheService $cacheService,
      PostRepository $postRepository
    )
    {
        $this->commentRepository = $commentRepository;
        $this->cacheService = $cacheService;
        $this->postRepository = $postRepository;
    }
    
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws ApiException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function search(Request $request) {
        try {
            $params = $request->all();
            if (empty($params)) {
                $key = $this->cacheService->getKey('posts_data');
                if (empty($key)) {
                    $users = $this->postRepository->all();
                    $this->cacheService->setKey('posts_data', $users);
                    $key = $this->cacheService->getKey('posts_data');
                }
                return response()->json($key,200);
            } else {
                $key = $this->cacheService->getKey('posts_data_'.md5(implode("_",$params)));
                if (empty($key)) {
                    $users = $this->postRepository->all();
                    $this->cacheService->setKey('posts_data_'.md5(implode("_",$params)), $users);
                    $key = $this->cacheService->getKey('posts_data_'.md5(implode("_",$params)));
                }
                $filter = new Search();
                $response = $filter->search($params, $key);
                return response()->json($response,200);
            }
        } catch(\Exception $e) {
            throw new ApiException($e->getMessage(), $e->getCode(), $e);
        }
    }
    
    /**
     * @param Request $request
     * @param int $postId
     * @return \Illuminate\Http\JsonResponse
     * @throws ApiException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function getCommentByPostId(Request $request, int $postId) {
        try {
            $key = $this->cacheService->getKey('user_comments_'.$postId);
            if (empty($key)) {
                $response = $this->commentRepository->getCommentByPostId($postId);
                $this->cacheService->setKey('user_comments_'.$postId, $response);
                $key = $this->cacheService->getKey('user_comments_'.$postId);
                return response()->json($key,200);
            }
            return response()->json($key,200);
        } catch(\Exception $e) {
            throw new ApiException($e->getMessage(), $e->getCode(), $e);
        }
    }
}