<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Description of UsuarioType
 *
 * @author Aski
 */
class PasswordType extends AbstractType {
    //put your code here
    
     public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('usuario', EntityType::class, array(
                'attr' => array('class' => 'art_sel'),
                'choice_label' => 'name',
                'class' => 'AppBundle:Art',
                'expanded' => false,
                'multiple' => true ))     
            ->add('password', 'repeated', array(
           'first_name'  => 'nueva password',
           'second_name' => 'confirm',
           'type'        => 'password',
        ));
    }
    
    
}
