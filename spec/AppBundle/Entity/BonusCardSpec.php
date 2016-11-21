<?php

namespace spec\AppBundle\Entity;

use AppBundle\Entity\BonusCard;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BonusCardSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(BonusCard::class);
    }
}
