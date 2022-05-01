<?php

namespace App\Controller;

use App\Entity\Proyectos;
use App\Entity\Sedes;
use App\Form\ProyectosType;
use App\Form\SedeType;
use App\Repository\ProyectosRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine;

class ProyectosController extends AbstractController
{
    #[Route('/proyectos', name: 'app_proyectos')]
    public function index(Request $request, Doctrine\Persistence\ManagerRegistry $doctrine)
    {
        $proyecto= new Proyectos();
        $form= $this->createForm(ProyectosType::class, $proyecto);
        $form -> handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em= $doctrine->getManager();
            $em->persist($proyecto);
            $em->flush();
            $this->addFlash('exito','se ha creado el proyecto correctamente');
            return $this->redirectToRoute('app_dashboard');
        }
        return $this->render('sedes/index.html.twig', [
            'controller_name' => 'ProyectosController',
            'form' => $form->createView()

        ]);
    }
    #[Route('/proyecto/{id}', name: 'verProyecto')]
    public function verProyecto($id, ProyectosRepository $proyectos){

        $proyecto = $proyectos ->find($id);
        $usuarios = $proyectos ->verUsuarios($id);
        return $this->render('proyectos/verProyecto.html.twig', [
            'proyecto' => $proyecto, 'usuarios' => $usuarios

        ]);
    }
}
