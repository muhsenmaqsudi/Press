<?php


namespace Muhsenmaqsudi\Press\Tests\Feature;


use Muhsenmaqsudi\Press\MarkdownParser;
use Orchestra\Testbench\TestCase;
use Parsedown;

class MarkdownTest extends TestCase
{
    /** @test */
    public function simple_markdown_is_parsed()
    {
        $this->assertEquals('<h1>Heading</h1>', MarkdownParser::parse('# Heading'));
    }
}