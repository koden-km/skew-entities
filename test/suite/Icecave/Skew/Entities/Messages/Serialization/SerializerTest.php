<?php
namespace Icecave\Skew\Entities\Messages\Serialization;

use Icecave\Skew\Entities\Messages\Job\JobAcceptMessage;
use Icecave\Skew\Entities\Messages\Job\JobCompleteMessage;
use Icecave\Skew\Entities\Messages\Job\JobErrorMessage;
use Icecave\Skew\Entities\Messages\Job\JobLogMessage;
use Icecave\Skew\Entities\Messages\Job\JobProgressMessage;
use Icecave\Skew\Entities\Messages\Job\JobRejectMessage;
use Icecave\Skew\Entities\Messages\Job\JobRequestMessage;
use Icecave\Skew\Entities\Messages\Job\LogLevel;
use Icecave\Skew\Entities\Messages\Processor\ProcessorReadyMessage;
use Icecave\Skew\Entities\Messages\Processor\ProcessorShutdownMessage;
use Icecave\Skew\Entities\Messages\Processor\ProcessorStartMessage;
use Icecave\Skew\Entities\Messages\Processor\ProcessorStopMessage;
use Icecave\Skew\Entities\Priority;
use PHPUnit_Framework_TestCase;
use stdClass;

/**
 * @covers Icecave\Skew\Entities\Messages\Serialization\Serializer
 * @covers Icecave\Skew\Entities\Messages\Serialization\SerializerVisitor
 */
class SerializerTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->serializer = new Serializer;
    }

    public function testSerializeJobAcceptMessage()
    {
        $expected = '{"type":"job.accept","job":"123","processor":"abc","retry":true}';

        $message = new JobAcceptMessage(true);
        $message->setJobId('123');
        $message->setProcessor('abc');

        $this->assertEquals($expected, $this->serializer->serialize($message));
    }

    public function testSerializeJobCompleteMessage()
    {
        $expected = '{"type":"job.complete","job":"123","processor":"abc"}';

        $message = new JobCompleteMessage;
        $message->setJobId('123');
        $message->setProcessor('abc');

        $this->assertEquals($expected, $this->serializer->serialize($message));
    }

    public function testSerializeJobErrorMessage()
    {
        $expected = '{"type":"job.error","job":"123","processor":"abc","reason":"The reason!","retry":true}';

        $message = new JobErrorMessage('The reason!', true);
        $message->setJobId('123');
        $message->setProcessor('abc');

        $this->assertEquals($expected, $this->serializer->serialize($message));
    }

    public function testSerializeJobLogMessage()
    {
        $expected = '{"type":"job.log","job":"123","processor":"abc","level":"debug","message":"The message!"}';

        $message = new JobLogMessage(LogLevel::DEBUG(), 'The message!');
        $message->setJobId('123');
        $message->setProcessor('abc');

        $this->assertEquals($expected, $this->serializer->serialize($message));
    }

    public function testSerializeJobProgressMessage()
    {
        $expected = '{"type":"job.progress","job":"123","processor":"abc","progress":0.5}';

        $message = new JobProgressMessage(0.5);
        $message->setJobId('123');
        $message->setProcessor('abc');

        $this->assertEquals($expected, $this->serializer->serialize($message));
    }

    public function testSerializeJobProgressMessageWithStatus()
    {
        $expected = '{"type":"job.progress","job":"123","processor":"abc","progress":0.5,"status":"The status!"}';

        $message = new JobProgressMessage(0.5, 'The status!');
        $message->setJobId('123');
        $message->setProcessor('abc');

        $this->assertEquals($expected, $this->serializer->serialize($message));
    }

    public function testSerializeJobRejectMessage()
    {
        $expected = '{"type":"job.reject","job":"123","processor":"abc","reason":"The reason!"}';

        $message = new JobRejectMessage('The reason!');
        $message->setJobId('123');
        $message->setProcessor('abc');

        $this->assertEquals($expected, $this->serializer->serialize($message));
    }

    public function testSerializeJobRequestMessage()
    {
        $expected = '{"type":"job.request","job":"123","priority":"high","task":"xyz","payload":{"foo":"bar"},"tags":["a","b","c"]}';

        $payload = new stdClass;
        $payload->foo = 'bar';

        $message = new JobRequestMessage('123', 'xyz');
        $message->setPriority(Priority::HIGH());
        $message->setTags(['a', 'b', 'c']);
        $message->setPayload($payload);

        $this->assertEquals($expected, $this->serializer->serialize($message));
    }

    public function testSerializeProcessorReadyMessage()
    {
        $expected = '{"type":"processor.ready","processor":"abc"}';

        $message = new ProcessorReadyMessage;
        $message->setProcessor('abc');

        $this->assertEquals($expected, $this->serializer->serialize($message));
    }

    public function testSerializeProcessorShutdownMessage()
    {
        $expected = '{"type":"processor.shutdown","processor":"abc"}';

        $message = new ProcessorShutdownMessage;
        $message->setProcessor('abc');

        $this->assertEquals($expected, $this->serializer->serialize($message));
    }

    public function testSerializeProcessorStartMessage()
    {
        $expected = '{"type":"processor.start","processor":"abc","capabilities":["a","b","c"]}';

        $message = new ProcessorStartMessage;
        $message->setProcessor('abc');
        $message->setCapabilities(['a', 'b', 'c']);

        $this->assertEquals($expected, $this->serializer->serialize($message));
    }

    public function testSerializeProcessorStopMessage()
    {
        $expected = '{"type":"processor.stop","processor":"abc"}';

        $message = new ProcessorStopMessage;
        $message->setProcessor('abc');

        $this->assertEquals($expected, $this->serializer->serialize($message));
    }
}
