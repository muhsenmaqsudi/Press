<?php


namespace Muhsenmaqsudi\Press\Console;


use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Muhsenmaqsudi\Press\Post;
use Muhsenmaqsudi\Press\Press;
use Muhsenmaqsudi\Press\PressFileParser;

class ProcessCommand extends Command
{
    protected $signature = 'press:process';

    protected $description = 'Updates blog posts.';

    public function handle()
    {
        if (Press::configNotPublished()) {
            return $this->warn('Please publush the config file by running ' .
                '\'php artisan vendor:publish --tag=press-config\'');
        }

        try {
            $posts = Press::driver()->fetchPosts();

            foreach ($posts as $post) {
                Post::create([
                    'identifier' => $post['identifier'],
                    'slug' => Str::slug($post['title']),
                    'title' => $post['title'],
                    'body' => $post['body'],
                    'extra' => $post['extra'] ?? []
                ]);
            }
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}