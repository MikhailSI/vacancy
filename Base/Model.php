<?php
namespace Base;

class Model
{
    public function __construct($params = [])
    {
        foreach ($params as $key => $value) {
            $this->{$key} = $value;
        }
    }

    public function toArray()
    {

    }
}