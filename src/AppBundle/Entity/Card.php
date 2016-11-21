<?php
/**
 * Created by PhpStorm.
 * User: philippe
 * Date: 19/11/16
 * Time: 17:50
 */

namespace AppBundle\Entity;


abstract class Card
{
    const COLOR_RED = 'red';
    const COLOR_YELLOW = 'yellow';
    const COLOR_BLUE = 'blue';
    const COLOR_GREEN = 'green';

    public $image;

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }
}