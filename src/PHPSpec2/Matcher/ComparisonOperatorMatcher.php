<?php

namespace PHPSpec2\Matcher;

use PHPSpec2\Stub;
use PHPSpec2\Exception\Expectation\FailureException;

class ComparisonOperatorMatcher implements MatcherInterface
{
    public function getAliases()
    {
        return array('should_be_like', 'shouldBeLike');
    }

    public function match(Stub $stub, array $arguments)
    {
        if ($stub->getStubSubject() != $arguments[0]) {
            throw FailureException(
                "Expected value to be like {$stub->getStubSubject()}, " .
                "found {$arguments[0]}"
            );
        }
        return $stub;
    }
}
