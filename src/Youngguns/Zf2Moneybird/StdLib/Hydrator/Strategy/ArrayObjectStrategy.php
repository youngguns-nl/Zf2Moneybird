<?php

namespace Youngguns\Zf2Moneybird\StdLib\Hydrator\Strategy;

/**
 * Description of ArrayObjectStrategy
 *
 * @author otterdijk
 */
class ArrayObjectStrategy implements \Zend\Stdlib\Hydrator\Strategy\StrategyInterface
{

    public function extract($value)
    {
        $data = array();

        foreach ($value as $element) {
            $data[] = $element->toArray();
        }

        return $data;
    }

    public function hydrate($value)
    {

    }
}
