<?php


namespace Muhsenmaqsudi\Press\Tests\Feature;


use Carbon\Carbon;
use Muhsenmaqsudi\Press\PressFileParser;
use Orchestra\Testbench\TestCase;

class PressFileParserTest extends TestCase
{
    protected $data;

    public function setUp(): void
    {
        parent::setUp();
        $pressFileParser = (new PressFileParser(__DIR__ . '/../blogs/MarkFile1.md'));
        $this->data = $pressFileParser->getData();
    }

    /** @test */
    public function the_head_and_body_gets_split()
    {
        $this->assertStringContainsString('title: My Title', $this->data[1]);
        $this->assertStringContainsString('description: Description here', $this->data[1]);
        $this->assertStringContainsString('Blog post body here', $this->data[2]);
    }
    
    /** @test */
    public function a_string_can_also_be_used_instead()
    {
        $pressFileParser = (new PressFileParser("---\ntitle: My Title\n---\nBlog post body here"));
        $data = $pressFileParser->getData();

        $this->assertStringContainsString('title: My Title', $data[1]);
        $this->assertStringContainsString('Blog post body here', $data[2]);
    }

    /** @test */
    public function each_head_field_gets_separated()
    {
        $this->assertEquals('My Title', $this->data['title']);
        $this->assertEquals('Description here', $this->data['description']);
    }
    
    /** @test */
    public function the_body_gets_saved_and_trimmed()
    {
        $this->assertEquals("<h1>Heading</h1>\n<p>Blog post body here</p>", $this->data['body']);
    }
    
    /** @test */
    public function a_date_field_gets_parsed()
    {
        $pressFileParser = (new PressFileParser("---\ndate: May 14, 1988\n---\n"));
        $data = $pressFileParser->getData();

        $this->assertInstanceOf(Carbon::class, $data['date']);
        $this->assertEquals('05/14/1988', $data['date']->format('m/d/Y'));
    }
}