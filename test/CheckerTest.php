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
        $response = $this->getResponse($this->getShort());

        $this->assertTrue($response->isSuccess());
        $this->assertEquals(ShortSequenceChecker::MESSAGE, $response->getMessage());
    }

    /**
     * @test
     */
    public function arithmetic()
    {
        $response = $this->getResponse($this->getArithmetic());

        $this->assertTrue($response->isSuccess());
        $this->assertEquals(ArithmeticChecker::MESSAGE, $response->getMessage());
    }

    /**
     * @test
     */
    public function geometric()
    {
        $response = $this->getResponse($this->getGeometric());

        $this->assertTrue($response->isSuccess());
        $this->assertEquals(GeometricChecker::MESSAGE, $response->getMessage());
    }

    /**
     * @test
     */
    public function failed()
    {
        $response = $this->getResponse($this->getFail());

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

    private function getResponse(array $data): Response
    {
        return
            $this->checker->check(
                $this->getRequest($data),
                new Response()
            );
    }

    private function getRequest(array $data): Request
    {
        return
            Request::create()->fill($data);
    }

    private function getShort(): array
    {
        return [
            'progression.php', '1,2'
        ];
    }

    private function getArithmetic(): array
    {
        return [
            'progression.php', '1,3,5,7,9'
        ];
    }

    private function getGeometric(): array
    {
        return [
            'progression.php', '1,5,25,125,625'
        ];
    }

    private function getFail(): array
    {
        return [
            'progression.php', '1,13,27,49'
        ];
    }
}