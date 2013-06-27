<?php
namespace Icecave\Skew\Entities\Messages\Job;

use Phake;
use PHPUnit_Framework_TestCase;

class JobRejectMessageTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->message = new JobRejectMessage('This is the rejection reason.');
    }

    public function testInterfaces()
    {
        $this->assertInstanceOf('Icecave\Skew\Entities\Messages\MessageInterface', $this->message);
        $this->assertInstanceOf('Icecave\Skew\Entities\Messages\Flow\DaemonToClientMessageInterface', $this->message);
        $this->assertInstanceOf('Icecave\Skew\Entities\Messages\Flow\ProcessorMessageInterface', $this->message);

        $this->assertNotInstanceOf('Icecave\Skew\Entities\Messages\Flow\ClientMessageInterface', $this->message);
        $this->assertNotInstanceOf('Icecave\Skew\Entities\Messages\Flow\DaemonToProcessorMessageInterface', $this->message);

        $this->assertInstanceOf('Icecave\Skew\Entities\Messages\Job\JobAwareMessageInterface', $this->message);
        $this->assertInstanceOf('Icecave\Skew\Entities\Messages\Processor\ProcessorAwareMessageInterface', $this->message);
    }

    public function testType()
    {
        $this->assertSame('job.reject', $this->message->type());
    }

    /**
     * @covers Icecave\Skew\Entities\Messages\Job\AbstractJobMessage
     */
    public function testSetJobId()
    {
        $this->message->setJobId('abc');
        $this->assertSame('abc', $this->message->jobId());
    }

    /**
     * @covers Icecave\Skew\Entities\Messages\Processor\ProcessorTrait
     */
    public function testSetProcessor()
    {
        $this->message->setProcessor('def');
        $this->assertSame('def', $this->message->processor());
    }

    /**
     * @covers Icecave\Skew\Entities\Messages\Job\ReasonTrait
     */
    public function testReason()
    {
        $this->assertSame('This is the rejection reason.', $this->message->reason());
    }

    public function testAccept()
    {
        $visitor = Phake::mock('Icecave\Skew\Entities\Messages\VisitorInterface');

        Phake::when($visitor)
            ->visitJobRejectMessage($this->message)
            ->thenReturn(123);

        $this->assertSame(123, $this->message->accept($visitor));
    }
}
