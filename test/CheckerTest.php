<?php

use Checker\ArithmeticChecker;
use Checker\ChainChecker;
use Checker\GeometricChecker;
use Checker\ShortSequenceChecker;
use PHPUnit\Framework\TestCase;

class CheckerTest extends TestCase
{
    private $checker;

    /**
     * @test
     */
    public function short()
    {
        $response =
            $this->checker->check(
                $this->getRequest($this->getShort()),
                new Response()
        );

        $this->assertTrue($response->isSuccess());
        $this->assertEquals(ShortSequenceChecker::MESSAGE, $response->getMessage());
    }

    /**
     * @test
     */
    public function arithmetic()
    {
        $response =
            $this->checker->check(
                $this->getRequest($this->getArithmetic()),
                new Response()
            );

        $this->assertTrue($response->isSuccess());
        $this->assertEquals(ArithmeticChecker::MESSAGE, $response->getMessage());
    }

    /**
     * @test
     */
    public function geometric()
    {
        $response =
            $this->checker->check(
                $this->getRequest($this->getGeometric()),
                new Response()
            );

        $this->assertTrue($response->isSuccess());
        $this->assertEquals(GeometricChecker::MESSAGE, $response->getMessage());
    }

    /**
     * @test
     */
    public function failed()
    {
        $response =
            $this->checker->check(
                $this->getRequest($this->getFail()),
                new Response()
            );

        $this->assertTrue($response->isFail());
        $this->assertEquals(ChainChecker::MESSAGE, $response->getMessage());
    }

    protected function setUp()
    {
        parent::setUp();

        $this->checker =
            new ChainChecker([
                new ShortSequenceChecker(),
                new ArithmeticChecker(),
                new GeometricChecker(),
            ]);
    }

    private function getRequest(array $data)
    {
        return
            Request::create()->fill($data);
    }

    private function getShort()
    {
        return [
            'progression.php', '1,2'
        ];
    }

    private function getArithmetic()
    {
        return [
            'progression.php', '1,3,5,7,9'
        ];
    }

    private function getGeometric()
    {
        return [
            'progression.php', '1,5,25,125,625'
        ];
    }

    private function getFail()
    {
        return [
            'progression.php', '1,13,27,49'
        ];
    }
}