<?php

namespace Mhert\AufrufFuerVernunftUndSolidaritaet\App\Domain\Signup;

final class OtherSignee
{
    public function __construct(
        public string $name,
        public string $city,
        public string $email,
        public bool $showName,
        public bool $acceptPrivacyStatement,
    ) {
    }
}
