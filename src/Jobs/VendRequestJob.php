<?php

namespace SimpleSquid\LaravelVend\Jobs;

use Closure;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializableClosure;
use Illuminate\Queue\SerializesModels;
use ReflectionFunction;
use SimpleSquid\LaravelVend\Facades\Vend;
use SimpleSquid\LaravelVend\VendTokenManager;
use SimpleSquid\Vend\Exceptions\RateLimitException;
use SimpleSquid\Vend\Exceptions\TokenExpiredException;

class VendRequestJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The serializable Closure instance.
     *
     * @var \Illuminate\Queue\SerializableClosure
     */
    private $closure;

    /**
     * Delete the job if its models no longer exist.
     *
     * @var bool
     */
    public $deleteWhenMissingModels = true;

    private $response;

    /**
     * Create a new job instance.
     *
     * @param  \Closure  $closure
     */
    public function __construct(Closure $closure)
    {
        $this->closure = new SerializableClosure($closure);
    }

    /**
     * Dispatch a command to its appropriate handler in the current process.
     *
     * @return mixed
     */
    public static function dispatchNow()
    {
        $job = new static(...func_get_args());

        log(app(Dispatcher::class)->dispatchNow($job));

        return $job->getResponse();
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

    /**
     * Get the display name for the queued job.
     *
     * @return string
     * @throws \ReflectionException
     */
    public function displayName()
    {
        $reflection = new ReflectionFunction($this->closure->getClosure());

        return 'VendRequest (' . basename($reflection->getFileName()) . ':' . $reflection->getStartLine() . ')';
    }

    /**
     * Execute the job.
     *
     * @param  \Illuminate\Contracts\Container\Container  $container
     * @param  \SimpleSquid\LaravelVend\VendTokenManager  $tokenManager
     *
     * @return void
     * @throws Exception
     */
    public function handle(Container $container, VendTokenManager $tokenManager)
    {
        try {
            return $this->response = $container->call($this->closure->getClosure());
        } catch (TokenExpiredException $e) {
            if (config('vend.authorisation', 'oauth') !== 'oauth') {
                throw $e;
            }

            $tokenManager->setToken(Vend::refreshOAuthAuthorisationToken());

            if (is_null($this->job)) {
                return $this->response = $container->call($this->closure->getClosure());
            }

            $this->release();
        } catch (RateLimitException $e) {
            if (is_null($this->job)) {
                return $this->response = $container->call($this->closure->getClosure());
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
        return now()->addSeconds(config('vend.queue_timeout', 5));
    }
}