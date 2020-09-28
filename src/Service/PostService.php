<?php

namespace App\Service;

use App\Entity\Post;
use App\Http\HandlerInterface;

class PostService implements PostServiceInterface {

    /**
     * @var HandlerInterface
     */
    private $handler;

    public function __construct(HandlerInterface $handler)
    {
        $this->handler = $handler;
    }

    /**
     * @return Post[]
     */
    public function getPosts(): array
    {
        return $this->handler->getAllPosts();
    }

    /**
     * @param int $id
     * @return Post
     */
    public function getPost(int $id): Post
    {
        return $this->handler->getPost($id);
    }
}