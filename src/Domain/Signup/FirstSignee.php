<?php

namespace Mhert\AufrufFuerVernunftUndSolidaritaet\App\Domain\Signup;

final class FirstSignee
{
    public function __construct(
        public string $name,
        public string $city,
        public string $email,
        public string $function,
    ) {
    }
}
