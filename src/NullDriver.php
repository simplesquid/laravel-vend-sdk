<?php

namespace SimpleSquid\LaravelVend;

use Illuminate\Support\Facades\Log;

class NullDriver
{
    /** @var bool */
    private $logCalls;

    /** @var string */
    private $parent;

    public function __construct(bool $logCalls = false, string $parent = '')
    {
        $this->logCalls = $logCalls;
        $this->parent = $parent;
    }

    public function __call($name, $arguments)
    {
        if ($this->logCalls) {
            Log::debug('Called Vend facade method `' . ($this->parent ?? '') . $name . '()` with:', $arguments);
        }
    }

    public function __get($name)
    {
        return new self($this->logCalls, $this->parent . $name . '->');
    }
}
