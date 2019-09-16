<?php

namespace SimpleSquid\LaravelVend\Jobs;

use Closure;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use SimpleSquid\LaravelVend\Facades\Vend;
use SimpleSquid\LaravelVend\VendTokenManager;
use SimpleSquid\Vend\Exceptions\RateLimitException;
use SimpleSquid\Vend\Exceptions\TokenExpiredException;

class VendRequestJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $response;

    /** @var Closure */
    private $closure;

    /**
     * Delete the job if its models no longer exist.
     *
     * @var bool
     */
    public $deleteWhenMissingModels = true;

    /**
     * @param  \Closure  $closure
     */
    public function __construct(Closure $closure)
    {
        $this->closure = $closure;
    }

    /**
     * Execute the job.
     *
     * @param  \SimpleSquid\LaravelVend\VendTokenManager  $tokenManager
     *
     * @return void
     */
    public function handle(VendTokenManager $tokenManager)
    {
        try {
            $this->response = ($this->closure)();
        } catch (TokenExpiredException $e) {
            $tokenManager->setToken(Vend::refreshOAuthAuthorisationToken());

            if (is_null($this->job)) {
                $this->response = ($this->closure)();
            }

            $this->release();
        } catch (RateLimitException $e) {
            if (is_null($this->job)) {
                $this->response = ($this->closure)();
            }

            $this->release(now()->diffInSeconds($e->response()->retry_after));
        }
    }

    /**
     * Determine the time at which the job should timeout.
     *
     * @return \DateTime
     */
    public function retryUntil()
    {
        return now()->addSeconds(5);
    }

    /**
     * Get the response from the synchronous job.
     *
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }
}