<?php

namespace App\Controller;

use App\Entity\Ligue;
use App\Entity\LigueStat;
use App\Form\LigueType;
use App\Repository\LigueRepository;
use App\Repository\LigueStatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/ligues')]
class LigueController extends AbstractController
{
    #[Route('/', name: 'app_ligue_index', methods: ['GET'])]
    public function index(LigueRepository $ligueRepository): Response
    {
        return $this->render('ligue/index.html.twig', [
            'ligues' => $ligueRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_ligue_new', methods: ['GET', 'POST'])]
    public function new(Request $request, LigueRepository $ligueRepository): Response
    {
        $ligue = new Ligue();
        $form = $this->createForm(LigueType::class, $ligue);
        $ligue->setCreatedAt(new \DateTimeImmutable());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ligueRepository->add($ligue);
            return $this->redirectToRoute('app_ligue_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ligue/new.html.twig', [
            'ligue' => $ligue,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ligue_show', methods: ['GET'])]
    public function show(Ligue $ligue, LigueStatRepository $ligueStatRepository): Response
    {

        $ligueUser = $ligueStatRepository->findBy(array('Ligue' => $ligue));

        return $this->render('ligue/show.html.twig', [
            'ligue' => $ligue,
            'users' => $ligueUser,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_ligue_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Ligue $ligue, LigueRepository $ligueRepository): Response
    {
        $form = $this->createForm(LigueType::class, $ligue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ligueRepository->add($ligue);
            return $this->redirectToRoute('app_ligue_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ligue/edit.html.twig', [
            'ligue' => $ligue,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ligue_delete', methods: ['POST'])]
    public function delete(Request $request, Ligue $ligue, LigueRepository $ligueRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ligue->getId(), $request->request->get('_token'))) {
            $ligueRepository->remove($ligue);
        }

        return $this->redirectToRoute('app_ligue_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/addUser/{ligue}', name: 'app_ligue_add_user', methods: ['GET'])]
    public function addUser(Ligue $ligue, LigueStatRepository $ligueStatRepository): Response
    {

        $user = $this->getUser();


        $ligueStat = new LigueStat();
        $ligueStat->setUser($user);
        $ligueStat->setLigue($ligue);
        $ligueStat->setDefaite(0);
        $ligueStat->setVictoire(0);
        $ligueStat->setTauxVictoire(0);

        $ligueStatRepository-> add($ligueStat);

        return $this->render('ligue/show.html.twig', [
            'ligue' => $ligue,
        ]);
    }


}
