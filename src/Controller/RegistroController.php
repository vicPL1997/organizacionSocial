<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\SedesRepository;
use Doctrine;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Component\HttpFoundation;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegistroController extends AbstractController
{
    #[Route('/registro', name: 'app_registro')]
    public function index(Request $request, Doctrine\Persistence\ManagerRegistry $doctrine, UserPasswordHasherInterface $passwordHasher, SedesRepository $sedes)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form -> handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em= $doctrine->getManager();
            $em->persist($user);
            $rol = $user->getRol();
            if($rol == "Administrador"){
                $user->setRoles(['ROLE_ADMIN']);
            }elseif($rol == "Usuario"){
                $user->setRoles(['ROLE_USER']);
            }elseif($rol == "Voluntario"){
                $user->setRoles(['ROLE_VOLUNTARIO']);
            }elseif($rol == "Administrador de sede"){
                $user->setRoles(['ROLE_ADMIN_SEDES']);
            }
            $user->setPassword($passwordHasher->hashPassword($user, $form->get('password')->getData()));
            $em->flush();

            $this->addFlash('exito','se ha regisrado exitosamente');
            return $this->redirectToRoute('app_registro');
        }
        return $this->render('registro/index.html.twig', [
            'controller_name' => 'RegistroController',
            'formulario' => $form->createView()
        ]);
    }
}
