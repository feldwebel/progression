<?php

namespace Checker;

use Request;

class ArithmeticChecker extends AbstractChecker
{
    const MESSAGE = 'An arithmetic progression is detected';

    protected function isChecked(Request $request): bool
    {
        $data = $request->getData();
        $length = count($data);

        return
            abs(
                ($data[0] + end($data)) / 2 * $length
                -
                (2 * $data[0] + ($data[1] - $data[0]) * ($length - 1)) / 2 * $length
            ) < self::MARGIN;
    }
}