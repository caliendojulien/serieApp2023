<?php

namespace App\Controller;

use App\Repository\SerieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/serie', name: 'serie')]
class SerieController extends AbstractController
{
    #[Route('/', name: '_list')]
    public function list(
        SerieRepository $serieRepository
    ): Response
    {
        $series = $serieRepository->findBy([], ["popularity" => "DESC", "vote" => "DESC"], 30);
        return $this->render(
            'serie/list.html.twig',
            compact('series')
        );
    }

    #[Route('/details/{id}', name: '_details')]
    public function details(
        int             $id,
        SerieRepository $serieRepository
    ): Response
    {
        $serie = $serieRepository->findOneBy(["id" => $id]);
        return $this->render(
            'serie/details.html.twig',
            compact('serie')
        );
    }

    #[Route('/create', name: '_create')]
    public function create(): Response
    {
        return $this->render('serie/create.html.twig');
    }
}
