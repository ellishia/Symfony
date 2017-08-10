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
use Symfony\Component\Form\Extension\Core\Type\FileType;
/**
 * Description of ArtistType
 *
 * @author Aski
 */
class ArtistType extends AbstractType {
    //put your code here
     public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('usuario', UsuarioType::class)
            ->add('nombreArtistico')
            ->add('foto',  FileType::class, array('label' => 'Foto de Perfil'))
            ->add('art', EntityType::class, array(
                'attr' => array('class' => 'art_sel'),
                'choice_label' => 'name',
                'class' => 'AppBundle:Art',
                'expanded' => false,
                'multiple' => true ))           
            ->add('continue', SubmitType::class)            
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Artista'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_artista';
    }

    
}
