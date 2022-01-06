<?php

declare(strict_types=1);

namespace Mhert\AufrufFuerVernunftUndSolidaritaet\App\Domain\Signup;

use IteratorAggregate;
use Traversable;

/**
 * @template-implements IteratorAggregate<int, FirstSignee>
 */
final class FirstSignees implements IteratorAggregate
{
    /**
     * @param Traversable<int, FirstSignee> $signees
     */
    public function __construct(
        private readonly Traversable $signees,
    ) {
    }

    /**
     * @return Traversable<int, FirstSignee>
     */
    public function getIterator(): Traversable
    {
        return $this->signees;
    }
}
