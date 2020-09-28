<?php

namespace App\Service;

use App\Entity\Post;

interface PostServiceInterface {

    /**
     * @return Post[]
     */
    public function getPosts(): array;

    /**
     * @param int $id
     * @return Post
     */
    public function getPost(int $id): Post;
}