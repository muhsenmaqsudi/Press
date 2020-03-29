<?php


namespace Muhsenmaqsudi\Press;


use Illuminate\Support\Str;

class Press
{
    protected $fields = [];

    /**
     * Check if Press config file has been published and set
     *
     * @return bool
     */
    public function configNotPublished()
    {
        return is_null(config('press'));
    }

    /**
     * Get an instance of the set driver.
     *
     * @return mixed
     */
    public function driver()
    {
        $driver = Str::title(config('press.driver'));
        $class = 'Muhsenmaqsudi\Press\Drivers\\' . $driver . 'Driver';

        return new $class;
    }

    public function path()
    {
        return config('press.path', 'blogs');
    }

    public function fields(array $fields)
    {
        $this->fields = array_merge($this->fields, $fields);
    }

    public function availableFields()
    {
        return $this->fields;
    }
}