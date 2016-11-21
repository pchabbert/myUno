<?php

namespace spec\AppBundle\Entity;

use AppBundle\Entity\DrawPile;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DrawPileSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(DrawPile::class);
    }
}
