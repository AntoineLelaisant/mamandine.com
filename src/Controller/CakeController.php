<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class CakeController extends Controller
{
    private $pdo;

    public function list()
    {
        $cakes = $this
            ->getPdo()
            ->query('SELECT * FROM cake ORDER BY created_at DESC')
            ->fetchAll()
        ;

        return $this->render('cake/list.html.twig', [
            'cakes' => $cakes,
        ]);
    }

    public function show($cakeId)
    {
        $cake = $this
            ->getPdo()
            ->query(sprintf('SELECT * FROM cake WHERE id = %d', $cakeId))
            ->fetch()
        ;

        if (!$cake) {
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

    public function create() {


        return $this->render('cake/create.html.twig');
    }

    private function getPdo()
    {
        if (null === $this->pdo) {
            $this->pdo = new \PDO($this->container->getParameter('pdo_dsn'));
        }

        return $this->pdo;
    }
}
