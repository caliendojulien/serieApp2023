<?php

namespace App\Controller;

use App\Entity\Serie;
use App\Form\SerieType;
use App\Repository\SerieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function create(
        EntityManagerInterface $em,
        Request                $request
    ): Response
    {
        $serie = new Serie();
        $serieForm = $this->createForm(SerieType::class, $serie);
        $serieForm->handleRequest($request);
        if ($serieForm->isSubmitted() && $serieForm->isValid()) {
            $em->persist($serie);
            $em->flush();
            return $this->redirectToRoute('serie_list');
        }
        return $this->render(
            'serie/create.html.twig',
            compact('serieForm')
        );
    }
}
