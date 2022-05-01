<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\ProyectosRepository;
use App\Repository\SedesRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @IsGranted("ROLE_ADMIN")
     */
    #[Route('/dashboard', name: 'admin_dashboard')]
    public function index(SedesRepository $sedes, UserRepository $users, ProyectosRepository $proyectos): Response
    {
        $allSedes = $sedes->findAll();
        $allUsers = $users->findAll();
        $allProyectos = $proyectos->findAll();

        return $this->render('dashboard/index.html.twig', ['sedes' => $allSedes, 'usuarios' => $allUsers, 'proyectos' => $allProyectos]);

    }

    /**
     * @IsGranted("ROLE_USER")
     */
    #[Route('/usuarioDashboard', name: 'user_dashboard')]
    public function dashboardUsuarios(ProyectosRepository $proyectos, UserRepository $usuario)
    {
        $user = $this->getUser();
        $rol = $user->getRol();
        if ($rol == "Usuario") {
            $proyecto = $user->getProyecto();
            return $this->render('dashboard/usuario.html.twig', ['proyecto' => $proyecto]);
        } else {
            $this->addFlash('Fallo', 'No pertenece a ningún proyecto');
            return $this->redirectToRoute('app_inicio');
        }


    }

    /**
     * @IsGranted("ROLE_ADMIN_SEDES")
     */
    #[Route('/adminSedesDashboard', name: 'adminSedes_dashboard')]
    public function dashboardAdminSedes(ProyectosRepository $proyectos, UserRepository $usuario, SedesRepository $sedes)
    {
        $user = $this->getUser();
        $id = $user->getId();
        $sede = $sedes->verSedeAdmin($id);
        $sede2 = $user->getSede();
        return $this->render('dashboard/adminSedes.html.twig', ['sede' => $sede, 'sede2' => $sede2]);

    }
}
