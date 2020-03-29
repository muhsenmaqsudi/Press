<?php


namespace Muhsenmaqsudi\Press\Repositories;


use Illuminate\Support\Str;
use Muhsenmaqsudi\Press\Post;

class PostRepository
{
    public function save($post)
    {
        Post::updateOrCreate([
            'identifier' => $post['identifier'],
        ],
            [
                'slug' => Str::slug($post['title']),
                'title' => $post['title'],
                'body' => $post['body'],
                'extra' => $post['extra'] ?? json_encode([])
            ]);
    }

}