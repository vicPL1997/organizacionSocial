<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Proyectos;
use App\Repository\ProyectosRepository;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username')
            ->add('password', PasswordType::class)
            ->add('sexo', ChoiceType::class, [
                'label' => "Sexo",
                'choices' => [
                    "Masculino" => "Masculino",
                    "Femenino" => "Femenino",
                ]])
            ->add('edad', IntegerType::class)
            ->add('rol', ChoiceType::class, [
                'label' => "Tamaño de la compañía",
                'choices' => [
                    "Usuario" => "Usuario",
                    "Administrador" => "Administrador",
                    "Administrador de sede" => "Administrador de sede",
                    "Voluntario" => "Voluntario",
                ]])
            ->add('NuevoUsuario', type: SubmitType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
