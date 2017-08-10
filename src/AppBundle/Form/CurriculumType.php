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
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use AppBundle\Entity\Estudio;

/**
 * Description of ArtistType
 *
 * @author Aski
 */
class CurriculumType extends AbstractType {
    //put your code here
    
     public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('texto', TextType::class, array(
                'required' => false))
            ->add('estudio',  CollectionType::class, array(
                'entry_type' => EstudioType::class,
                'allow_add'    => true,
                'allow_delete' => true,
                'prototype_data' => new Estudio(),
                'by_reference' => false,
                'attr'           => array(
                    'class' => 'row'
                )))
          
            ->add('exposicion',  CollectionType::class, array(
                 'entry_type' => ExposicionType::class ,
                 'allow_add'    => true,
                'by_reference' => false,)) 
                
            ->add('continue', SubmitType::class)            
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Curriculum'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_curriculum';
    }

    
}
