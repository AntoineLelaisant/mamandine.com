<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Cake;
use App\Form\Type\CreateCake;

class CakeController extends Controller
{
    private $pdo;

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

        $categories = $this
            ->getPdo()
            ->query(sprintf('
                SELECT * FROM category
                INNER JOIN cake_category ON category.id = cake_category.category_id
                WHERE cake_category.cake_id = %d
            ', $cakeId))
            ->fetchAll()
        ;

        return $this->render('cake/show.html.twig', [
            'cake' => $cake,
            'categories' => $categories
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

    private function getPdo()
    {
        if (null === $this->pdo) {
            $this->pdo = new \PDO($this->container->getParameter('pdo_dsn'));
        }

        return $this->pdo;
    }
}
