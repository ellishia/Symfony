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
class ObraType extends AbstractType {
    //put your code here
    
     public function buildForm(FormBuilderInterface $builder, array $options)
    {
          $tipos =  array('mixta' => 'Mixta', 'oleo' => 'Oleo', 'graf' => 'Grafito',  'aero' => 'Aerografo', 
              'rot' => 'Rotulador', 'rotring' => 'Rotring', 'agua' =>'Aguafuerte', 'aguatinta' => 'Agua Tinta', 'manera' => 'Manera Negra');
         
        $builder
            ->add('titulo')
            ->add('anyo', DateType::class)
            ->add('artista', EntityType::class, array(
                'attr' => array('class' => 'art_sel'),
                'choice_label' => 'name',
                'class' => 'AppBundle:Artista',
                'expanded' => false,
                'multiple' => false))
            ->add('art', EntityType::class, array(
                'attr' => array('class' => 'art_sel'),
                'choice_label' => 'name',
                'class' => 'AppBundle:Art',
                'expanded' => false,
                'multiple' => true ))     
            ->add('medidas')            
            ->add('foto',  FileType::class, array('label' => 'Foto de la Obra'))
            ->add('tecnica', ChoiceType::class, array(
              'choices' => $tipos ))  
            ->add('material')
            ->add('coleccionPrivada', CheckboxType::class, array(
                'attr' => array('class' => 'row spacing')
            )) 
            ->add('precio')
            ->add('modelo', EntityType::class, array(
                  'attr' => array('class' => 'art_sel'),
                'choice_label' => 'name',
                'class' => 'AppBundle:Modelo',
                'expanded' => false,
                'multiple' => false))
                
            ->add('continue', SubmitType::class)               
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Obra'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_obra';
    }

}
