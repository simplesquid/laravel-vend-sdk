<?php

namespace SimpleSquid\LaravelVend\Test;

use Illuminate\Support\Facades\Log;
use Mockery;
use PHPUnit\Framework\TestCase;
use SimpleSquid\LaravelVend\NullDriver;

class NullDriverTest extends TestCase
{
    /** @test */
    public function it_can_call_with_any_method_or_field()
    {
        $vend = new NullDriver();

        $this->assertNull($vend->whatever());
        $this->assertNull($vend->product->get());
        $this->assertNull($vend->product->create(['product_name' => 'A Product', 'sku' => '12345']));
    }

    /** @test */
    public function it_logs_the_method_or_field_call_when_log_is_set()
    {
        $vend = new NullDriver(true);

        $log = Mockery::mock();
        Log::swap($log);

        $log->shouldReceive('debug')->twice();

        $this->assertNull($vend->whatever());
        $this->assertNull($vend->product->create(['product_name' => 'A Product', 'sku' => '12345']));

        $log->shouldHaveReceived('debug', ['Called Vend facade method `whatever()` with:', []]);
        $log->shouldHaveReceived('debug', [
            'Called Vend facade method `product->create()` with:',
            [['product_name' => 'A Product', 'sku' => '12345']]
        ]);
    }

    public function tearDown(): void
    {
        Mockery::close();
    }
}
