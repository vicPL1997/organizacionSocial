<?php

namespace App\Controller;

use App\Entity\Sedes;
use App\Form\SedeType;
use App\Repository\ProyectosRepository;
use App\Repository\SedesRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SedesController extends AbstractController
{
    #[Route('/sedes', name: 'app_sedes')]
    public function index(Request $request, Doctrine\Persistence\ManagerRegistry $doctrine)
    {
        $sede= new Sedes();
        $form= $this->createForm(SedeType::class, $sede);
        $form -> handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em= $doctrine->getManager();
            $em->persist($sede);
            $em->flush();
            $this->addFlash('exito','se ha creado la sede correctamente');
            return $this->redirectToRoute('admin_dashboard');
        }
        return $this->render('sedes/index.html.twig', [
            'controller_name' => 'SedesController',
            'form' => $form->createView()

        ]);

    }
    #[Route('/sede/{id}', name: 'verSede')]
    public function verProyecto($id, SedesRepository $sedes){

        $sede = $sedes ->find($id);
        $proyectos = $sedes ->verProyectosSede($id);
        return $this->render('sedes/verSede.html.twig', [
            'sede' => $sede, 'proyectos' => $proyectos

        ]);
    }
}
