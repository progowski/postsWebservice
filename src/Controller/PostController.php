<?php

namespace App\Controller;

use App\Service\PostServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/posts")
 */
class PostController extends AbstractController
{

    /**
     * @var PostServiceInterface
     */
    private $postService;

    public function __construct(PostServiceInterface $postService)
    {
        $this->postService = $postService;
    }

    /**
     * @Route("/", name="posts_list", methods={"GET"})
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $posts = $this->postService->getPosts();

        return $this->json($posts, Response::HTTP_OK);
    }

    /**
     * @Route("/{id}", name="post_defails", methods={"GET"})
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $post = $this->postService->getPost($id);
        return $this->json($post, Response::HTTP_OK);
    }
}