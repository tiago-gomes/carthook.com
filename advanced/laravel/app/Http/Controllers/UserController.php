<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 20/05/2020
 * Time: 12:47
 */

namespace App\Http\Controllers;

use App\Library\Search;
use App\Repository\CommentRepository;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use App\Service\CacheService;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Exceptions\ApiException;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends BaseController
{
    /**
     * @var 
     */
    private $userRepository;
    
    /**
     * @var CacheService
     */
    private $cacheService;
    
    /**
     * @var PostRepository
     */
    private $postRepository;
    
    /**
     * @var CommentRepository
     */
    private $commentRepository;
    
    /**
     * UserController constructor.
     * @param UserRepository $userRepository
     * @param PostRepository $postRepository
     * @param CommentRepository $commentRepository
     * @param CacheService $cacheService
     */
    public function __construct(
      UserRepository $userRepository,
      PostRepository $postRepository,
      CommentRepository $commentRepository,
      CacheService $cacheService
    )
    {
        $this->userRepository = $userRepository;
        $this->postRepository = $postRepository;
        $this->commentRepository = $commentRepository;
        $this->cacheService = $cacheService;
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
                $key = $this->cacheService->getKey('users_data');
                if (empty($key)) {
                    $users = $this->userRepository->all();
                    $this->cacheService->setKey('users_data', $users);
                    $key = $this->cacheService->getKey('users_data');
                }
                return response()->json($key,200);
            } else {
                $key = $this->cacheService->getKey('users_data_'.md5(implode("_",$params)));
                if (empty($key)) {
                    $users = $this->userRepository->all();
                    $this->cacheService->setKey('users_data_'.md5(implode("_",$params)), $users);
                    $key = $this->cacheService->getKey('users_data_'.md5(implode("_",$params)));
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
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @throws ApiException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function getById(Request $request, int $id) {
        try {
            $key = $this->cacheService->getKey('user_'.$id);
            if (empty($key)) {
                $response = $this->userRepository->getById($id);
                $this->cacheService->setKey('user_'.$id, $response);
                $key = $this->cacheService->getKey('user_'.$id);
                return response()->json($key,200);
            }
            return response()->json($key,200);
        } catch(\Exception $e) {
            throw new ApiException($e->getMessage(), $e->getCode(), $e);
        }
    }
    
    /**
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @throws ApiException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function getCommentByPostId(Request $request, int $id) {
        try {
            $key = $this->cacheService->getKey('user_comments_'.$id);
            if (empty($key)) {
                $response = $this->commentRepository->getCommentByPostId($id);
                $this->cacheService->setKey('user_comments_'.$id, $response);
                $key = $this->cacheService->getKey('user_comments_'.$id);
                return response()->json($key,200);
            }
            return response()->json($key,200);
        } catch(\Exception $e) {
            throw new ApiException($e->getMessage(), $e->getCode(), $e);
        }
    }
    
    /**
     * @param Request $request
     * @param int $userId
     * @return \Illuminate\Http\JsonResponse
     * @throws ApiException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function getPostByUserId(Request $request, int $userId) {
        try {
            $key = $this->cacheService->getKey('user_posts_'.$userId);
            if (empty($key)) {
                $response = $this->postRepository->getPostByUserId($userId);
                $this->cacheService->setKey('user_posts_'.$userId, $response);
                $key = $this->cacheService->getKey('user_posts_'.$userId);
                return response()->json($key,200);
            }
            return response()->json($key,200);
        } catch(\Exception $e) {
            throw new ApiException($e->getMessage(), $e->getCode(), $e);
        }
    }
}