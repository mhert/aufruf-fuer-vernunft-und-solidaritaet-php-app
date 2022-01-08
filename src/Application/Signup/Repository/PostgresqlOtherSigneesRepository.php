<?php

declare(strict_types=1);

namespace Mhert\AufrufFuerVernunftUndSolidaritaet\App\Application\Signup\Repository;

use Generator;
use Mhert\AufrufFuerVernunftUndSolidaritaet\App\Domain\Signup\OtherSignee;
use Mhert\AufrufFuerVernunftUndSolidaritaet\App\Domain\Signup\OtherSigneesRepository;
use Mhert\AufrufFuerVernunftUndSolidaritaet\App\Domain\Signup\OtherSignees;
use PDO;
use Ramsey\Uuid\UuidFactoryInterface;

final class PostgresqlOtherSigneesRepository implements OtherSigneesRepository
{
    public function __construct(
        private readonly UuidFactoryInterface $uuidFactory,
        private readonly PDO $postgresql,
    ) {
    }

    public function findAllConfirmedSignees(): OtherSignees
    {
        $stmt = $this->postgresql
            ->prepare(<<<SQL
                SELECT * FROM other_signees WHERE CAST(attributes ->> 'confirmed' AS BOOLEAN) = true ORDER BY created DESC;
            SQL);
        $stmt->execute();

        return new OtherSignees(
            (function () use ($stmt): Generator {
                while ($signee = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $attributes = json_decode($signee['attributes'], true);
                    yield new OtherSignee(
                        name: $signee['name'],
                        city: $signee['city'],
                        email: $signee['email'],
                        showName: $attributes['showName'],
                        acceptPrivacyStatement: $attributes['acceptPrivacyStatement'],
                    );
                }
            })(),
        );
    }

    public function store(
        string $name,
        string $city,
        string $email,
        bool $showName,
        bool $acceptFurtherContact,
        bool $acceptPrivacyStatement,
        string $ip,
    ): void {
        $res = $this->postgresql
            ->prepare(<<<SQL
                INSERT INTO other_signees
                    (other_signee_id, name, city, email, attributes, ip)
                VALUES
                    (:other_signee_id, :name, :city, :email, :attributes, :ip);
            SQL)->execute([
                'other_signee_id' => $this->uuidFactory->uuid4()->toString(),
                'name' => $name,
                'city' => $city,
                'email' => $email,
                'attributes' => json_encode([
                    'showName' => $showName,
                    'acceptFurtherContact' => $acceptFurtherContact,
                    'acceptPrivacyStatement' => $acceptPrivacyStatement,
                    'locked' => false,
                    'confirmed' => false,
                ]),
                'ip' => $ip,
            ]);
    }
}
