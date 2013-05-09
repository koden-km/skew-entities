<?php
namespace Icecave\Skew\Entities;

use Icecave\Collections\Set;
use Icecave\Skew\Entities\Messages\Job\JobRequestMessage;
use PHPUnit_Framework_TestCase;
use stdClass;

class TaskDetailsTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->job = new TaskDetails('skew.test');
    }

    public function testFromRequest()
    {
        $payload = new stdClass;

        $request = new JobRequestMessage('123', 'skew.test');
        $request->setTags(['tag1', 'tag2']);
        $request->setPayload($payload);

        $taskDetails = TaskDetails::fromRequest($request);

        $this->assertInstanceOf(__NAMESPACE__ . '\TaskDetails', $taskDetails);
        $this->assertSame('skew.test', $taskDetails->task());
        $this->assertEquals(new Set(['tag1', 'tag2']), $taskDetails->tags());
        $this->assertSame($payload, $taskDetails->payload());
    }

    /**
     * @covers Icecave\Skew\Entities\TaskDetailsTrait
     */
    public function testSetTask()
    {
        $this->assertSame('skew.test', $this->job->task());
        $this->job->setTask('skew.other');
        $this->assertSame('skew.other', $this->job->task());
    }

    /**
     * @covers Icecave\Skew\Entities\TaskDetailsTrait
     */
    public function testSetTags()
    {
        $this->assertEquals(new Set, $this->job->tags());
        $this->job->setTags(['tag1', 'tag2']);
        $this->assertEquals(new Set(['tag1', 'tag2']), $this->job->tags());
    }

    /**
     * @covers Icecave\Skew\Entities\TaskDetailsTrait
     */
    public function testSetPayload()
    {
        $payload = new stdClass;
        $this->assertNull($this->job->payload());
        $this->job->setPayload($payload);
        $this->assertSame($payload, $this->job->payload());
    }
}
