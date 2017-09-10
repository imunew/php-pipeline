<?php
namespace Imunew\Pipeline\Test\Context;

use Imunew\Pipeline\Context\Status;
use PHPUnit\Framework\TestCase;

class StatusTest extends TestCase
{
    /**
     * @test
     */
    public function isInitialized()
    {
        $status = Status::initialize();

        $this->assertTrue($status->isInitialized());
        $this->assertFalse($status->isStopped());
        $this->assertFalse($status->isStopped());
    }

    /**
     * @test
     */
    public function isStarted()
    {
        $status = Status::start();

        $this->assertFalse($status->isInitialized());
        $this->assertTrue($status->isStarted());
        $this->assertFalse($status->isStopped());
    }

    /**
     * @test
     */
    public function isStopped()
    {
        $status = Status::stop();

        $this->assertFalse($status->isInitialized());
        $this->assertFalse($status->isStarted());
        $this->assertTrue($status->isStopped());
    }
}
