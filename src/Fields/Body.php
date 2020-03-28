<?php


namespace Muhsenmaqsudi\Press\Fields;


use Muhsenmaqsudi\Press\MarkdownParser;

class Body extends FieldContract
{
    public static function process($type, $value, $data)
    {
        return [
            $type => MarkdownParser::parse($value)
        ];
    }
}