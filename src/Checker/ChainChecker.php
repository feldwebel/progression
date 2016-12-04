<?php

namespace Checker;

use Request;
use Response;

class ChainChecker implements IChecker
{
    const MESSAGE = 'No progression detected';

    private $chain = [];

    public function __construct(array $chain)
    {
        $this->chain = $chain;
    }


    public function check(Request $request, Response $response): Response
    {
        foreach ($this->chain as $checker) {
            if ($checker->check($request, $response)->isSuccess()) {
                return $response;
            }
        }

        return
            $response->setFail($this->getMessage());
    }


    public function getMessage(): string
    {
        return self::MESSAGE;
    }
}