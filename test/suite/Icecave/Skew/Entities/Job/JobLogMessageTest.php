<?php
namespace Icecave\Skew\Entities\Job;

use Phake;
use PHPUnit_Framework_TestCase;

class JobLogMessageTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->message = new JobLogMessage(LogLevel::DEBUG(), 'This is the log message.');
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
        $this->assertSame('job.log', $this->message->type());
    }

    public function testSetJob()
    {
        $this->message->setJob('abc');
        $this->assertSame('abc', $this->message->job());
    }

    public function testSetProcessor()
    {
        $this->message->setProcessor('def');
        $this->assertSame('def', $this->message->processor());
    }

    public function testLevel()
    {
        $this->assertSame(LogLevel::DEBUG(), $this->message->level());
    }

    public function testMessage()
    {
        $this->assertSame('This is the log message.', $this->message->message());
    }

    public function testAccept()
    {
        $visitor = Phake::mock('Icecave\Skew\Entities\VisitorInterface');

        Phake::when($visitor)
            ->visitJobLogMessage($this->message)
            ->thenReturn(123);

        $this->assertSame(123, $this->message->accept($visitor));
    }
}
