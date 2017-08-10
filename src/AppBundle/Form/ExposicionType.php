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
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use AppBundle\Repository\EnumRepository; 

/**
 * Description of ExposicionType
 *
 * @author Aski
 */
class ExposicionType extends AbstractType {
    //put your code here
     public function buildForm(FormBuilderInterface $builder, array $options)
    {
       //  $enum = new EnumRepository();
         $tipos =  array('exp' => 'Exposicion', 'dise' => 'Diseño', 'trab' => 'Trabajo',  'dec' => 'Decoracion', 'esc' => 'Escenografia');
  
        $builder
            ->add('tipo', ChoiceType::class, array(
              'choices' => $tipos )) 
            ->add('titulo')
            ->add('fecha', DateType::class)
            ->add('lugar')
            ->add('individual', CheckboxType::class, array(
                'attr' => array('class' => 'row spacing')
            ))
            ->add('arte', EntityType::class, array(
                'attr' => array('class' => 'art_sel'),
                'choice_label' => 'name',
                'class' => 'AppBundle:Art',
                'expanded' => false,
                'multiple' => true ))                      
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Exposicion'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_exposicion';
    }

     public function enumDropdown($table_name, $column_name)
{
        
    $em = $this->getEntityManager();
    $query = $em->createQuery("SELECT COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS
       WHERE TABLE_NAME = '$table_name' AND COLUMN_NAME = '$column_name'")
   or die (mysql_error());

    $row = $query->getResult();
    $enumList = explode(",", str_replace("'", "", substr($row['COLUMN_TYPE'], 5, (strlen($row['COLUMN_TYPE'])-6))));
    return $enumList;

}
       
}
