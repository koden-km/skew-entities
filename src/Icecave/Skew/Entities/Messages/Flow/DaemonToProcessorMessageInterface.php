<?php
namespace Icecave\Skew\Entities\Messages\Flow;

use Icecave\Skew\Entities\Messages\MessageInterface;

/**
 * Interface for messages that may be produced by a Skew daemon and sent to a processor.
 */
interface DaemonToProcessorMessageInterface extends MessageInterface
{
}
