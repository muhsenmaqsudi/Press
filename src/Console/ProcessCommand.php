<?php


namespace Muhsenmaqsudi\Press\Console;


use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Muhsenmaqsudi\Press\Facades\Press;
use Muhsenmaqsudi\Press\Post;
use Muhsenmaqsudi\Press\Repositories\PostRepository;

class ProcessCommand extends Command
{
    protected $signature = 'press:process';

    protected $description = 'Updates blog posts.';

    public function handle(PostRepository $postRepository)
    {
        if (Press::configNotPublished()) {
            return $this->warn('Please publush the config file by running ' .
                '\'php artisan vendor:publish --tag=press-config\'');
        }

        try {
            $posts = Press::driver()->fetchPosts();

            $this->info('Number of Posts:' . count($posts));

            foreach ($posts as $post) {
                $postRepository->save($post);

                $this->info('Post:' . $post['title']);
            }
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}