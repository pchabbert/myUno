<?php
/**
 * Created by PhpStorm.
 * User: philippe
 * Date: 20/11/16
 * Time: 12:50
 */

namespace AppBundle\Entity;


abstract class Pile
{
    protected $cards;

    public function shuffle()
    {
        shuffle($this->cards);
    }

    public function draw()
    {
        return array_shift($this->cards);
    }

    public function addCard(Card $card)
    {
        $this->cards[] = $card;
    }
}