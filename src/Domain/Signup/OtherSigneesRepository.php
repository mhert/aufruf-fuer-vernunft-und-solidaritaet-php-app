<?php

declare(strict_types=1);

namespace Mhert\AufrufFuerVernunftUndSolidaritaet\App\Domain\Signup;

interface OtherSigneesRepository
{
    public function findAllConfirmedSignees(): OtherSignees;

    public function store(
        string $name,
        string $city,
        string $email,
        bool $showName,
        bool $acceptPrivacyStatement,
    ): void;
}
