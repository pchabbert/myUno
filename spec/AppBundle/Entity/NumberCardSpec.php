<?php

namespace spec\AppBundle\Entity;

use AppBundle\Entity\Card;
use AppBundle\Entity\NumberCard;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class NumberCardSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith(Card::COLOR_BLUE, 1);
        $this->shouldHaveType(NumberCard::class);
    }
}
