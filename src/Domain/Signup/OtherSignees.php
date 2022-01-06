<?php

declare(strict_types=1);

namespace Mhert\AufrufFuerVernunftUndSolidaritaet\App\Domain\Signup;

use IteratorAggregate;
use Traversable;

/**
 * @template-implements IteratorAggregate<int, OtherSignee>
 */
final class OtherSignees implements IteratorAggregate
{
    /**
     * @param Traversable<int, OtherSignee> $signees
     */
    public function __construct(
        private readonly Traversable $signees,
    ) {
    }

    /**
     * @return Traversable<int, OtherSignee>
     */
    public function getIterator(): Traversable
    {
        return $this->signees;
    }
}
