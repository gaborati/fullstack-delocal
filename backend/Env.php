<?php

class Env
{
    protected $data;

    public function __construct($filePath)
    {
        $this->data = parse_ini_file($filePath);
    }

    public function get($key)
    {
        return $this->data[$key] ?? null;
    }





}

?>
