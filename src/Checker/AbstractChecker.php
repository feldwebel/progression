<?php

namespace Checker;

use Request;
use Response;

abstract class AbstractChecker implements IChecker
{
    const
        MARGIN = .00001,
        MESSAGE = 'abstract checker message'
    ;


    public function check(Request $request, Response $response): Response
    {
        if ($this->isChecked($request)) {
            return $response->setSuccess($this->getMessage());
        }

        return $response;
    }

    public function getMessage(): string
    {
        return static::MESSAGE;
    }

    abstract protected function isChecked(Request $request): bool;
}