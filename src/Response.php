<?php

class Response
{
    const
        SUCCESS = 1,
        FAIL = 2,
        ERROR = 3
    ;

    private $status;

    private $message;

    public function setSuccess(string $message): self
    {
        $this->status = self::SUCCESS;
        $this->message = $message;
        return $this;
    }

    public function isSuccess(): bool
    {
        return $this->status === self::SUCCESS;
    }

    public function setFail(string $message): self
    {
        $this->status = self::FAIL;
        $this->message = $message;
        return $this;
    }

    public function isFail(): bool
    {
        return $this->status === self::FAIL;
    }

    public function setError(string $message): self
    {
        $this->status = self::ERROR;
        $this->message = $message;
        return $this;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function __toString()
    {
        switch ($this->status) {
            case self::SUCCESS :
                return "A progression is detected: {$this->message}\n";

            case self::FAIL :
                return "There is no progression detected: {$this->message}\n";

            case self::ERROR :
                return "It seems input data to be wrong: {$this->message}\n";

            default:
                return "Some unexpected error happens\n";
        }
    }
}