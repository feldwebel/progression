<?php


use Checker\ArithmeticChecker;
use Checker\ChainChecker;
use Checker\GeometricChecker;
use Checker\ShortSequenceChecker;

class Progression
{
    /** @var ChainChecker $checker */
    private $checker;

    /** @var Request $request */
    private $request;

    /** @var Response $response */
    private $response;

    public static function create(array $data)
    {
        return new self($data);
    }

    public function __construct(array $data)
    {
        $this->request = Request::create()->fill($data);
        
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
        return
            $this->request->isRequestValid()
                ? $this->checker->check($this->request, $this->response)
                : $this->response->setError('Input data is not valid')
        ;
    }
}
