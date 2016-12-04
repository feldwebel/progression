<?php


use Checker\ArithmeticChecker;
use Checker\ChainChecker;
use Checker\GeometricChecker;
use Checker\ShortSequenceChecker;

class Progression
{
    /** @var ChainChecker IChecker */
    private $checker;

    private $request;

    private $response;

    public static function create(array $argv)
    {
        return new self($argv);
    }

    public function __construct(array $argv)
    {
        $this->request = Request::create()->fill($argv);
        
        $this->response = new Response();

        $this->checker =
            new ChainChecker([
                new ShortSequenceChecker(),
                new ArithmeticChecker(),
                new GeometricChecker(),
            ]);
    }

    public function detect(): Response
    {
        return $this->request->isRequestValid()
            ? $this->checker->check($this->request, $this->response)
            : $this->response->setError('Input data is not valid')
        ;
    }
}