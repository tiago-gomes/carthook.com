<?php

namespace App\Console\Commands;

use App\Service\CommentService;
use App\Service\PostService;
use App\Service\UserService;
use Illuminate\Console\Command;
use App\Repository\UserRepository;
use App\Repository\PostRepository;
use App\Repository\CommentRepository;

class PopulateDatabaseCommand extends Command
{
    /**
     * @var
     */
    private $userRepository;
    
    /**
     * @var PostRepository
     */
    private $postRepository;
    
    /**
     * @var CommentRepository
     */
    private $commentRepository;
    
    /**
     * @var UserService
     */
    private $userService;
    
    /**
     * @var PostService
     */
    private $postService;
    
    /**
     * @var CommentService
     */
    private $commentService;
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:populateDatabase';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populates Database from API';
    
    /**
     *
     * PopulateDatabaseCommand constructor.
     *
     * @param UserRepository $userRepository
     * @param PostRepository $postRepository
     * @param CommentRepository $commentRepository
     * @param PostService $postService
     * @param CommentService $commentService
     * @param UserService $userService
     */
    public function __construct(
        UserRepository $userRepository,
        PostRepository $postRepository,
        CommentRepository $commentRepository,
        PostService $postService,
        CommentService $commentService,
        UserService $userService
    )
    {
        parent::__construct();
        $this->userRepository = $userRepository;
        $this->postRepository = $postRepository;
        $this->commentRepository = $commentRepository;
        $this->postService = $postService;
        $this->commentService = $commentService;
        $this->userService = $userService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = $this->userService->all();
        $posts = $this->postService->all();
        $comments = $this->commentService->all();

        $this->info('Creating Users');
        for($i=0;$i<10;$i++) {
            $this->userRepository->create($users[$i]);
        }
    
        $this->info('Creating Posts');
        for($i=0;$i<=50;$i++) {
            $this->postRepository->create($posts[$i]);
        }

        $this->info('Creating Comments');
        for($i=0;$i<=50;$i++) {
            $this->commentRepository->create($comments[$i]);
        }
    }
}
