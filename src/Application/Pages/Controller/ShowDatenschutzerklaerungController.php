<?php

declare(strict_types=1);

namespace Mhert\AufrufFuerVernunftUndSolidaritaet\App\Application\Pages\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment as TwigEnvironment;

#[Route(path: '/datenschutz', name: 'show-datenschutz')]
final class ShowDatenschutzerklaerungController
{
    public function __construct(
        private readonly TwigEnvironment $twig,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        return new Response(
            $this->twig->render(
                'base.html.twig',
                [
                    'body' => $this->twig->render('views/pages/datenschutz.html.twig'),
                    'title' => ' - Impressum',
                ]
            )
        );
    }
}
