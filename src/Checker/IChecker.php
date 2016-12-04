<?php

namespace Checker;

use Request;
use Response;

interface IChecker
{
    public function check(Request $request, Response $response): Response;
}