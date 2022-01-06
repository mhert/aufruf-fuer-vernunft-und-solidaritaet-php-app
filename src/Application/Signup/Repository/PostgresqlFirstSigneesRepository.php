<?php

declare(strict_types=1);

namespace Mhert\AufrufFuerVernunftUndSolidaritaet\App\Application\Signup\Repository;

use Generator;
use Mhert\AufrufFuerVernunftUndSolidaritaet\App\Domain\Signup\FirstSigneesRepository;
use Mhert\AufrufFuerVernunftUndSolidaritaet\App\Domain\Signup\FirstSignee;
use Mhert\AufrufFuerVernunftUndSolidaritaet\App\Domain\Signup\FirstSignees;
use PDO;

final class PostgresqlFirstSigneesRepository implements FirstSigneesRepository
{
    public function __construct(
        private readonly PDO $postgresql,
    ) {
    }

    public function findAllConfirmedSignees(): FirstSignees
    {
        $stmt = $this->postgresql
            ->prepare(<<<SQL
                SELECT * FROM first_signees WHERE CAST(attributes ->> 'confirmed' AS BOOLEAN) = true ORDER BY position;
            SQL);
        $stmt->execute();

        return new FirstSignees(
            (function () use ($stmt): Generator {
                while ($signee = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    yield new FirstSignee(
                        name: $signee['name'],
                        city: $signee['city'],
                        function: $signee['function'],
                    );
                }
            })(),
        );
    }
}
