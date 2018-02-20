<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Cake;
use App\Form\Type\CreateCake;

class CakeController extends Controller
{
    public function list()
    {
        $cakes = $this
            ->getDoctrine()
            ->getRepository(Cake::class)
            ->findAll()
        ;

        return $this->render('cake/list.html.twig', [
            'cakes' => $cakes,
        ]);
    }

    public function show($cakeId)
    {
        $cake = $this
            ->getDoctrine()
            ->getRepository(Cake::class)
            ->find($cakeId)
        ;

        if (null === $cake) {
            throw $this->createNotFoundException(sprintf('The cake with id "%s" was not found.', $cakeId));
        }

        return $this->render('cake/show.html.twig', [
            'cake' => $cake,
        ]);
    }

    public function create(Request $request)
    {
        $form = $this->createForm(CreateCake::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cake = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($cake);
            $em->flush();

            $this->addFlash('success', 'The cake has been created.');

            return $this->redirectToRoute('app_cake_list');
        }

        return $this->render('cake/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
