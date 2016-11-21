<?php
/**
 * Created by PhpStorm.
 * User: philippe
 * Date: 20/11/16
 * Time: 13:17
 */

namespace AppBundle\Entity;


class DiscardPile extends Pile
{
    public function clear()
    {
        $this->cards = array();
    }
}