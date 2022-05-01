<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InicioController extends AbstractController
{
    #[Route('/', name: 'app_inicio')]
    public function index(): Response
    {
        $textoIzquierdaInicio= "Bienvenidos a la web de la organización, puede iniciar sesión y
         ver los proyectos que usted tiene en curso, así como información relativa a la organización.";
        return $this->render('inicio/index.html.twig', [
            'texto_izquierda' => $textoIzquierdaInicio,
        ]);
    }
}
