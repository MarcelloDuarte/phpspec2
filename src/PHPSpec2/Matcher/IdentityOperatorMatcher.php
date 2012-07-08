<?php

namespace PHPSpec2\Matcher;

use PHPSpec2\Stub;
use PHPSpec2\Exception\Expectation\FailureException;

class IdentityOperatorMatcher implements MatcherInterface
{
    public function getAliases()
    {
        return array('should_return', 'shouldReturn', 'should_be_same');
    }

    public function match(Stub $stub, array $arguments)
    {
        if ($stub->getStubSubject() !== $arguments[0]) {
            throw new FailureException(
                "Expected value to be equal to {$stub->getStubSubject()}, " .
                "found {$arguments[0]}"
            );
        }
        return $stub;
    }
}
