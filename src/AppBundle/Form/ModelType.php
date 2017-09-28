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
 * Description of ModelType
 *
 * @author Aski
 */
class ModelType extends AbstractType {

     public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder           
            ->add('nombreArtistico')
            ->add('foto',  FileType::class, array('label' => 'Foto de Perfil'))
            ->add('usuario',  EntityType::class, array(
				'attr' => array('class' => 'art_sel'),
                'choice_label' => 'nombre' +' ' +  'apellidos',
                'class' => 'AppBundle:Usuario',
                'expanded' => false,
                'multiple' => false ))
            ->add('nuevo_usuario', new EmbededItemForm(), array(
                'required' => FALSE,
                'mapped' => FALSE,
                'property_path' => 'usuario',
             ))
            ->add('continue', SubmitType::class)
        ;


       $builder->addEventListener(FormEvents::PRE_SUBMIT, function(FormEvent $event) {
            $data = $event->getData();
            $form = $event->getForm();

            if (!empty($data['nuevo_usuario']['name'])) {
                $form->remove('usuario');

                $form->add('nuevo_usuario', new EmbedItemForm(), array(
                    'required' => TRUE,
                    'mapped' => TRUE,
                    'property_path' => 'usuario',
                ));
            }
        });
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Model'
        ));
    }
    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_model';
    }
    
}