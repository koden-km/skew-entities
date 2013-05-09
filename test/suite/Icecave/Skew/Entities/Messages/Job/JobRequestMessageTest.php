<?php
namespace Icecave\Skew\Entities\Messages\Job;

use Icecave\Collections\Set;
use Phake;
use PHPUnit_Framework_TestCase;
use stdClass;

class JobRequestMessageTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->message = new JobRequestMessage('123', 'skew.test');
    }

    public function testInterfaces()
    {
        $this->assertInstanceOf('Icecave\Skew\Entities\Messages\MessageInterface', $this->message);
        $this->assertInstanceOf('Icecave\Skew\Entities\Messages\ClientMessageInterface', $this->message);

        $this->assertNotInstanceOf('Icecave\Skew\Entities\Messages\ProcessorMessageInterface', $this->message);
        $this->assertNotInstanceOf('Icecave\Skew\Entities\Messages\DaemonToClientMessageInterface', $this->message);
        $this->assertNotInstanceOf('Icecave\Skew\Entities\Messages\DaemonToProcessorMessageInterface', $this->message);
    }

    public function testType()
    {
        $this->assertSame('job.request', $this->message->type());
    }

    /**
     * @covers Icecave\Skew\Entities\Messages\Job\AbstractJobMessage
     */
    public function testSetJob()
    {
        $this->assertSame('123', $this->message->job());
        $this->message->setJob('abc');
        $this->assertSame('abc', $this->message->job());
    }

    /**
     * @covers Icecave\Skew\Entities\JobDetailsTrait
     */
    public function testSetTask()
    {
        $this->assertSame('skew.test', $this->message->task());
        $this->message->setTask('skew.other');
        $this->assertSame('skew.other', $this->message->task());
    }

    /**
     * @covers Icecave\Skew\Entities\JobDetailsTrait
     */
    public function testSetTags()
    {
        $this->assertEquals(new Set, $this->message->tags());
        $this->message->setTags(['tag1', 'tag2']);
        $this->assertEquals(new Set(['tag1', 'tag2']), $this->message->tags());
    }

    /**
     * @covers Icecave\Skew\Entities\JobDetailsTrait
     */
    public function testSetPaylaod()
    {
        $payload = new stdClass;
        $this->assertNull($this->message->payload());
        $this->message->setPayload($payload);
        $this->assertSame($payload, $this->message->payload());
    }

    public function testAccept()
    {
        $visitor = Phake::mock('Icecave\Skew\Entities\Messages\VisitorInterface');

        Phake::when($visitor)
            ->visitJobRequestMessage($this->message)
            ->thenReturn(123);

        $this->assertSame(123, $this->message->accept($visitor));
    }
}
