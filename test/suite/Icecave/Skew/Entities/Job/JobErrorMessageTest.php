<?php
namespace Icecave\Skew\Entities\Job;

use Phake;
use PHPUnit_Framework_TestCase;

class JobErrorMessageTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->message = new JobErrorMessage('This is the error reason.', true);
    }

    public function testInterfaces()
    {
        $this->assertInstanceOf('Icecave\Skew\Entities\MessageInterface', $this->message);
        $this->assertInstanceOf('Icecave\Skew\Entities\DaemonToClientMessageInterface', $this->message);
        $this->assertInstanceOf('Icecave\Skew\Entities\ProcessorMessageInterface', $this->message);

        $this->assertNotInstanceOf('Icecave\Skew\Entities\ClientMessageInterface', $this->message);
        $this->assertNotInstanceOf('Icecave\Skew\Entities\DaemonToProcessorMessageInterface', $this->message);
    }

    public function testType()
    {
        $this->assertSame('job.error', $this->message->type());
    }

    /**
     * @covers Icecave\Skew\Entities\Job\AbstractJobMessage
     */
    public function testSetJob()
    {
        $this->message->setJob('abc');
        $this->assertSame('abc', $this->message->job());
    }

    /**
     * @covers Icecave\Skew\Entities\Processor\ProcessorTrait
     */
    public function testSetProcessor()
    {
        $this->message->setProcessor('def');
        $this->assertSame('def', $this->message->processor());
    }

    /**
     * @covers Icecave\Skew\Entities\Job\ReasonTrait
     */
    public function testReason()
    {
        $this->assertSame('This is the error reason.', $this->message->reason());
    }

    public function testSetReschedule()
    {
        $this->assertTrue($this->message->reschedule());
        $this->message->setReschedule(false);
        $this->assertFalse($this->message->reschedule());
    }

    public function testAccept()
    {
        $visitor = Phake::mock('Icecave\Skew\Entities\VisitorInterface');

        Phake::when($visitor)
            ->visitJobErrorMessage($this->message)
            ->thenReturn(123);

        $this->assertSame(123, $this->message->accept($visitor));
    }
}
