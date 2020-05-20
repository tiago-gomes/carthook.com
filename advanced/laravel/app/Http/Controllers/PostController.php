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
                $keyData = $this->cacheService->getKey('posts_data');
                if (empty($keyData)) {
                    $users = $this->postRepository->all();
                    $this->cacheService->setKey('posts_data', $users);
                    $keyData = $this->cacheService->getKey('posts_data');
                }
                return response()->json(['data' => $keyData],200);
            } else {
                $keyData = $this->cacheService->getKey('posts_data_'.md5(implode("_",$params)));
                if (empty($keyData)) {
                    $users = $this->postRepository->all();
                    $this->cacheService->setKey('posts_data_'.md5(implode("_",$params)), $users);
                    $keyData = $this->cacheService->getKey('posts_data_'.md5(implode("_",$params)));
                }
                $filter = new Search();
                $response = $filter->search($params, $keyData);
                return response()->json(['data' => $response],200);
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
            $keyData = $this->cacheService->getKey('user_comments_'.$postId);
            if (empty($keyData)) {
                $response = $this->commentRepository->getCommentByPostId($postId);
                $this->cacheService->setKey('user_comments_'.$postId, $response);
                $keyData = $this->cacheService->getKey('user_comments_'.$postId);
                return response()->json($keyData,200);
            }
            return response()->json($keyData,200);
        } catch(\Exception $e) {
            throw new ApiException($e->getMessage(), $e->getCode(), $e);
        }
    }
}