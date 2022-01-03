<?php

declare(strict_types=1);

namespace Mhert\AufrufFuerVernunftUndSolidaritaet\App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    public function getProjectDir(): string
    {
        return dirname(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR. '..' . DIRECTORY_SEPARATOR);
    }
}
