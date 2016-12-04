<?php

use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{

    /**
     * @test
     * @dataProvider successfulProvider
     * @param array $argv
     */
    public function successCase(array $argv)
    {
        $request = Request::create()->fill($argv);

        $this->assertTrue($request->isRequestValid());
    }

    /**
     * @test
     * @dataProvider failedProvider
     * @param array $argv
     */
    public function failCase(array $argv)
    {
        $request = Request::create()->fill($argv);

        $this->assertFalse($request->isRequestValid());
    }

    public function successfulProvider(): array
    {
        return [
            [['test', '1,2,3']],
            [['test', '1,5,25']],
            [['test', '1.3, 2.71, 3.14']],
        ];
    }

    public function failedProvider(): array
    {
        return [
            [['test']],
            [['test', '1,2,bgdfd']],
            [['test', '1;2;3;4']]
        ];
    }
}