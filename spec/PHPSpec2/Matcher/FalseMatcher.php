<?php

namespace spec\PHPSpec2\Matcher;

use PHPSpec2\Specification;

class FalseMatcher implements Specification
{
    function supports_useful_aliases()
    {
        $this->object->supports('be_false', null, array())
                     ->should_be_true();
                     
        $this->object->supports('return_false', null, array())
                     ->should_be_true();
    }

    function complains_when_matching_anything_different_from_false()
    {
        foreach ($this->list_of_values_with_no_false() as $value) {
            $this->object->should_throw('PHPSpec2\Exception\Example\BooleanNotEqualException')
                 ->during('positiveMatch', array('be_false', $value, array()));
        }
    }

    function does_not_complains_when_matching_false()
    {
        $this->object->should_not_throw('PHPSpec2\Exception\Example\BooleanNotEqualException')
             ->during('positiveMatch', array('be_false', false, array()));
        
    }

    function complains_when_reverse_matching_false()
    {
        $this->object->should_throw('PHPSpec2\Exception\Example\BooleanNotEqualException')
             ->during('negativeMatch', array('be_false', false, array()));
    }

    function does_not_complains_when_reverse_matching_not_false()
    {
        foreach ($this->list_of_values_with_no_false() as $value) {
            $this->object->should_not_throw('PHPSpec2\Exception\Example\BooleanNotEqualException')
                 ->during('negativeMatch', array('be_false', $value, array()));
        }
        
    }

    private function list_of_values_with_no_false()
    {
        return array(
            0,
            "",
            array(),
            new \stdClass,
            STDOUT,
            true,
            null
        );
    }
}