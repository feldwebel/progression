<?php

class Request
{
    private $sequence = [];

    public static function create()
    {
        return new self();
    }

    public function fill(array $input): Request
    {
        $this->sequence = $this->parse($input);
        return $this;
    }

    public function isRequestValid(): bool
    {
        return
            is_array($this->sequence)
                &&
            count($this->sequence)
                &&
            (count(array_filter($this->sequence, function($e){return is_numeric($e);}))
                ===
            count($this->sequence));
    }

    public function getData()
    {
        return $this->sequence;
    }

    private function parse(array $input)
    {
        return isset($input[1]) ? explode(',', $input[1]) : [];
    }
}