<?php

namespace PHPSpec2\Matcher;

use PHPSpec2\Exception\Example\BooleanNotEqualException;

class FalseMatcher extends BasicMatcher
{
    private $actual;

    public function supports($name, $subject, array $arguments)
    {
        return in_array($name, array('be_false', 'return_false'));
    }

    protected function matches($name, $subject, array $arguments)
    {
        $this->actual = $subject === true ? 'true' : gettype($subject);
        return $subject === false;
    }

    protected function getFailureException($name, $subject, array $arguments)
    {
        $type = $this->actual === true ? 'true' : gettype($this->actual);
        return new BooleanNotEqualException(
            'Expected false got ' . $type . 'using (' . $name . ')', true, $this->actual
        );
    }

    protected function getNegativeFailureException($name, $subject, array $arguments)
    {
        return new BooleanNotEqualException(
            'Expected not to be false, got false using (' . $name . ')', true, $this->actual
        );
    }
}
