<?php

namespace Checker;

use Request;

class GeometricChecker extends AbstractChecker
{
    const MESSAGE = 'A geometric progression is detected';

    protected function isChecked(Request $request): bool
    {
        $data = $request->getData();

        for ($i = 1, $max = count($data) - 1 ; $i < $max; $i++) {
            if (abs($data[$i] * $data[$i] - $data[$i-1] * $data[$i+1]) > self::MARGIN) {
                return false;
            }
        }

        return true;
    }
}