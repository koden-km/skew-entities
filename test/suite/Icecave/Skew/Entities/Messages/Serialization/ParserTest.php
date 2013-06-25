<?php
namespace Icecave\Skew\Entities\Messages\Serialization;

use Eloquent\Schemer\Constraint\Reader\SchemaReader;
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

class ParserTest extends PHPUnit_Framework_TestCase
{
    public static $schema;

    public function setUp()
    {
        if (self::$schema === null) {
            $schemaFilename = __DIR__ . '/../../../../../../../vendor/icecave/skew-schema/schema/message/global-message.json';
            $reader = new SchemaReader;
            self::$schema = $reader->readPath($schemaFilename);
        }

        $this->parser = new Parser(self::$schema);
    }

    public function testParseJobAcceptMessage()
    {
        $message = '{ "type": "job.accept", "job": "123", "processor": "abc", "retry": true }';

        $expected = new JobAcceptMessage(true);
        $expected->setJobId('123');
        $expected->setProcessor('abc');

        $this->assertEquals($expected, $this->parser->parse($message));
    }

    public function testParseJobCompleteMessage()
    {
        $message = '{ "type": "job.complete", "job": "123", "processor": "abc" }';

        $expected = new JobCompleteMessage;
        $expected->setJobId('123');
        $expected->setProcessor('abc');

        $this->assertEquals($expected, $this->parser->parse($message));
    }

    public function testParseJobErrorMessage()
    {
        $message = '{ "type": "job.error", "job": "123", "processor": "abc", "reason": "The reason!", "retry": true }';

        $expected = new JobErrorMessage("The reason!", true);
        $expected->setJobId('123');
        $expected->setProcessor('abc');

        $this->assertEquals($expected, $this->parser->parse($message));
    }

    public function testParseJobLogMessage()
    {
        $message = '{ "type": "job.log", "job": "123", "processor": "abc", "level": "debug", "message": "The message!" }';

        $expected = new JobLogMessage(LogLevel::DEBUG(), 'The message!');
        $expected->setJobId('123');
        $expected->setProcessor('abc');

        $this->assertEquals($expected, $this->parser->parse($message));
    }

    public function testParseJobProgressMessage()
    {
        $message = '{ "type": "job.progress", "job": "123", "processor": "abc", "progress": 0.5 }';

        $expected = new JobProgressMessage(0.5);
        $expected->setJobId('123');
        $expected->setProcessor('abc');

        $this->assertEquals($expected, $this->parser->parse($message));
    }

    public function testParseJobProgressMessageWithStatus()
    {
        $message = '{ "type": "job.progress", "job": "123", "processor": "abc", "progress": 0.5, "status": "The status!" }';

        $expected = new JobProgressMessage(0.5, 'The status!');
        $expected->setJobId('123');
        $expected->setProcessor('abc');

        $this->assertEquals($expected, $this->parser->parse($message));
    }

    public function testParseJobRejectMessage()
    {
        $message = '{ "type": "job.reject", "job": "123", "processor": "abc", "reason": "The reason!" }';

        $expected = new JobRejectMessage("The reason!");
        $expected->setJobId('123');
        $expected->setProcessor('abc');

        $this->assertEquals($expected, $this->parser->parse($message));
    }

    public function testParseJobRequestMessage()
    {
        $message = '{ "type": "job.request", "job": "123", "priority": "high", "task": "xyz", "payload": { "foo": "bar" }, "tags": [ "a", "b", "c" ] }';

        $payload = new stdClass;
        $payload->foo = 'bar';

        $expected = new JobRequestMessage('123', 'xyz');
        $expected->setPriority(Priority::HIGH());
        $expected->setTags(['a', 'b', 'c']);
        $expected->setPayload($payload);

        $this->assertEquals($expected, $this->parser->parse($message));
    }

    public function testParseProcessorReadyMessage()
    {
        $message = '{ "type": "processor.ready", "processor": "abc" }';

        $expected = new ProcessorReadyMessage;
        $expected->setProcessor('abc');

        $this->assertEquals($expected, $this->parser->parse($message));
    }

    public function testParseProcessorShutdownMessage()
    {
        $message = '{ "type": "processor.shutdown", "processor": "abc" }';

        $expected = new ProcessorShutdownMessage;
        $expected->setProcessor('abc');

        $this->assertEquals($expected, $this->parser->parse($message));
    }

    public function testParseProcessorStartMessage()
    {
        $message = '{ "type": "processor.start", "processor": "abc", "capabilities": [ "a", "b", "c" ] }';

        $expected = new ProcessorStartMessage;
        $expected->setProcessor('abc');
        $expected->setCapabilities([ "a", "b", "c" ]);

        $this->assertEquals($expected, $this->parser->parse($message));
    }

    public function testParseProcessorStopMessage()
    {
        $message = '{ "type": "processor.stop", "processor": "abc" }';

        $expected = new ProcessorStopMessage;
        $expected->setProcessor('abc');

        $this->assertEquals($expected, $this->parser->parse($message));
    }
}
