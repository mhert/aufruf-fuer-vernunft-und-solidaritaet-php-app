<?php

declare(strict_types=1);

namespace Mhert\AufrufFuerVernunftUndSolidaritaet\App\Domain\Signup;

interface FirstSigneesRepository
{
    public function findAllConfirmedSignees(): FirstSignees;
}
