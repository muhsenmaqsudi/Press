<?php


namespace Muhsenmaqsudi\Press\Fields;


use Muhsenmaqsudi\Press\MarkdownParser;

class Body
{
    public static function process($type, $value)
    {
        return [
            $type => MarkdownParser::parse($value)
        ];
    }
}