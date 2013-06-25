<?php
namespace Icecave\Skew\Entities;

use Eloquent\Enumeration\Enumeration;

class Priority extends Enumeration
{
    const HIGH = 'high';
    const NORMAL = 'normal';
    const LOW = 'low';
}
