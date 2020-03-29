<?php


namespace Muhsenmaqsudi\Press\Console;


use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Muhsenmaqsudi\Press\Post;
use Muhsenmaqsudi\Press\PressFileParser;

class ProcessCommand extends Command
{
    protected $signature = 'press:process';

    protected $description = 'Updates blog posts.';

    public function handle()
    {
        $files = File::files('blogs');

        foreach ($files as $file) {
            $post = (new PressFileParser($file->getPathname()))->getData();
        }

        Post::create([
            'identifier' => Str::random(),
            'slug' => Str::slug($post['title']),
            'title' => $post['title'],
            'body' => $post['body'],
            'extra' => $post['extra'] ?? [],
        ]);
    }
}