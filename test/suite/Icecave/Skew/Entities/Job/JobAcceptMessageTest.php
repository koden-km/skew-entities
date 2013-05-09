<?php
namespace Icecave\Skew\Entities\Job;

use Phake;
use PHPUnit_Framework_TestCase;

class JobAcceptMessageTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->message = new JobAcceptMessage;
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
        $this->assertSame('job.accept', $this->message->type());
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

    public function testAccept()
    {
        $visitor = Phake::mock('Icecave\Skew\Entities\VisitorInterface');

        Phake::when($visitor)
            ->visitJobAcceptMessage($this->message)
            ->thenReturn(123);

        $this->assertSame(123, $this->message->accept($visitor));
    }
}
