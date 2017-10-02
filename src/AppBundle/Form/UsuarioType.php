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
class UsuarioType extends AbstractType {
    //put your code here
    
     public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', array(
                'attr' => array('class' => 'row spacing'),
                 'label_attr' => array('class' => 'lab') )) 
            ->add('apellidos')
            ->add('username')
            ->add('email',  'repeated', array(
           'first_name'  => 'email',
           'second_name' => 'confirm',
           'type'        => 'email', 
            'attr' => array('class' => 'row'),
        'label_attr' => array('class' => 'lab')))
            ->add('password', 'repeated', array(
           'first_name'  => 'password',
           'second_name' => 'confirm',
           'type'        => 'password',
        ))            
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Usuario'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_usuario';
    }

}
