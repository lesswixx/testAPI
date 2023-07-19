<?php

require 'composer/vendor/autoload.php';

use GuzzleHttp\Client;

class JsonPlaceholderAPI
{
    private $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://jsonplaceholder.typicode.com',
            'timeout'  => 2.0,
        ]);
    }

    public function getUsers()
    {
        $response = $this->client->get('/users');
        return json_decode($response->getBody(), true);
    }

    public function getUserPosts($userId)
    {
        $response = $this->client->get("/users/{$userId}/posts");
        return json_decode($response->getBody(), true);
    }

    public function getUserTodos($userId)
    {
        $response = $this->client->get("/users/{$userId}/todos");
        return json_decode($response->getBody(), true);
    }

    public function getPost($postId)
    {
        $response = $this->client->get("/posts/{$postId}");
        return json_decode($response->getBody(), true);
    }

    public function addPost($data)
    {
        $response = $this->client->post('/posts', [
            'json' => $data,
        ]);
        return json_decode($response->getBody(), true);
    }

    public function editPost($postId, $data)
    {
        $response = $this->client->put("/posts/{$postId}", [
            'json' => $data,
        ]);
        return json_decode($response->getBody(), true);
    }

    public function deletePost($postId)
    {
        $response = $this->client->delete("/posts/{$postId}");
        return $response->getStatusCode() == 200;
    }
}
