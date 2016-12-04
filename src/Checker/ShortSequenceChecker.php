<?php
namespace Checker;

use Request;

class ShortSequenceChecker extends AbstractChecker
{
    const MESSAGE = 'The progression is too short to detect its type';

    protected function isChecked(Request $request): bool
    {
        return count($request->getData()) === 2;
    }
}