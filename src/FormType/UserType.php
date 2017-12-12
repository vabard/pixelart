<?php

namespace FormType;

use Constraints\UniqueEntity;
//use Entity\User;
use Propel\Propel\UsersQuery;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Description of UserType
 *
 * @author Etudiant
 */
class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) 
    {
        global $app;
        $builder->add('username', TextType::class, [
            'constraints' => [
                new Assert\NotBlank(),
                new Assert\Length(['min' => 2, 'max' => 50]),
                new UniqueEntity([
                    'field' => 'username',
                    'dao' => UsersQuery::create(),
                    'groups' => ['registration']
                ])
            ],
            'label' => 'Nom d\'utilisateur'
        ])
        ->add('email', EmailType::class, [
            'constraints' => [
                new Assert\NotBlank(),
                new Assert\Email(),
                new UniqueEntity([
                    'field' => 'email',
                    'dao' => UsersQuery::create(),
                    'groups' => ['registration']
                ])
            ],
            'label' => 'Email'
        ])
        ->add('lastname', TextType::class, [
            'constraints' => [
                new Assert\NotBlank(),
                new Assert\Length(['max' => 100]),
            ],
            'label' => 'Nom'
        ])
        ->add('firstname', TextType::class, [
            'constraints' => [
                new Assert\NotBlank(),
                new Assert\Length(['max' => 100]),
            ],
            'label' => 'Prénom'
        ])
        ->add('password', RepeatedType::class, [
            
                'type' => PasswordType::class,
                'invalid_message' => 'The password field must match',
                'options' => ['attr' => ['class' => 'password-field']],
                'first_options' => [
                    'constraints' => [
                        new Assert\NotBlank(),
                        new Assert\Length(['min' => 5, 'max' => 30]),
                        ],
                    'label' => 'Mot de passe'
                ],
                'second_options' => [
                    'label' => 'Mot de passe de confirmation'
                ]        
        ])
        ;
    }
    
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => null,
            'validation_groups' => ['edition']
        ]);
    }
}
