<?php

namespace App\Http;

use App\Entity\Post;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\Serializer\SerializerInterface;

class PostHandler implements HandlerInterface {

    /**
     * @var Client
     */
    private $httpClient;

    /**
     * @var string
     */
    private $url;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    public function __construct(string $postApiUrl, SerializerInterface $serializer)
    {
        $this->httpClient = new Client();
        $this->url = $postApiUrl;
        $this->serializer = $serializer;
    }

    /**
     * @param int $postId
     *
     * @return Post
     */
    public function getPost(int $postId): Post
    {
        $response = $this->httpClient->get($this->url . $postId);
        $body = $response->getBody()->getContents();
        return $this->serializer->deserialize($body, 'App\Entity\Post', 'json');
    }

    /**
     * @return Post[]
     */
    public function getAllPosts(): array
    {
        $response = $this->httpClient->get($this->url);
        $body = $response->getBody()->getContents();
        return $this->serializer->deserialize($body, 'App\Entity\Post[]', 'json');
    }
}