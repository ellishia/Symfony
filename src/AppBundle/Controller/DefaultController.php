<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Artista;
use AppBundle\Entity\Model;
use AppBundle\Entity\Obra;
use AppBundle\Entity\Curriculum;
use AppBundle\Entity\Estudio;
use AppBundle\Form\ArtistType;
user AppBundle\Form\ModelType;
use AppBundle\Form\CurriculumType;
use AppBundle\Form\ObraType;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {    
        $repository = $this->getDoctrine()->getRepository('AppBundle:Artista');
         
        $queryb = $repository->createQueryBuilder('a')
        ->select('art.name', 'a.nombreArtistico', 'a.id', 'a.foto', 'u.nombre', 'u.apellidos' )
            ->join( 'a.usuario', 'u', 'AppBundle:Usuario')
            ->leftjoin('a.art', 'art') 
           ->where('a.destacado = 1')
            ->orderBy('u.id', 'ASC');   
      
        $query=$queryb->getQuery();
        $artistas = $query->getResult();
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array( 'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),  'artistas' => $artistas
        ));
    }
    
    
    /**
     *  @Route("/arte/{arte}", name="arte")
     */
    public function artAction(Request $request)
    {
        $modelos;
        $entityArt = null;
        $art = $request->get('arte');
        if (strpos($art, '&') !== false){
           $art2 = substr($art , strpos($art, '&' )+1);        
        }       
        
        $repository = $this->getDoctrine()->getRepository('AppBundle:Artista');             
        $queryb = $repository->createQueryBuilder('a')
            ->select('art.name', 'a.nombreArtistico', 'a.id', 'a.foto', 'u.nombre', 'u.apellidos' )
            ->join( 'a.usuario', 'u', 'AppBundle:Usuario')
            ->leftjoin('a.art', 'art') 
            ->where('art.id = :art')
            ->andWhere('u.isActive = 1')
            ->setParameter('art', $art)
            ->orderBy('u.id', 'ASC');   

        if (isset($art2)){
            $repository = $this->getDoctrine()->getRepository('AppBundle:Art');
            $entityArt = $repository->findOneBy(array('id' => $art2));
        }
        $query=$queryb->getQuery();
        $artistas = $query->getResult();
        if ($art == 7) {
            $repository = $this->getDoctrine()->getRepository('AppBundle:Model');
            $queryb = $repository->createQueryBuilder('models')
                    ->select( 'models.id', 'models.foto','models.nombreArtistico', 'u.nombre', 'u.apellidos' )
                    ->join('models.usuarioId', 'u', 'AppBundle:Usuario')
                     ->where('u.isActive = 1');
            $query=$queryb->getQuery();
            $modelos = $query->getResult();
        }
        else { $modelos = null;}
        $repository = $this->getDoctrine()->getRepository('AppBundle:Obra');
       
                
        $obras = $repository->findBy(array('tipo' => $art));
        return $this->render('default/art.html.twig', array('artistas'=> $artistas, 'obras' => $obras, 'art'=> $art, 'modelos' => $modelos, 'art2' => $entityArt ));
        
    }
    
    /**
     *  @Route("/artista/{artista}-{id}", name="artista")
     */
    public function artistaAction(Request $request){
        
        $id = $request->get('id');
        $repository = $this->getDoctrine()->getRepository('AppBundle:Artista');
         
        $queryb = $repository->createQueryBuilder('a')
        ->select( 'a.nombreArtistico', 'a.id', 'a.foto', 'u.nombre', 'u.apellidos' )
            ->join( 'a.usuario', 'u', 'AppBundle:Usuario')            
           ->where('a.id = :id')
           ->setParameter('id', $id);
            
        $query=$queryb->getQuery();
       $artista = $query->getResult();
       
       $repository = $this->getDoctrine()->getRepository('AppBundle:Obra');
       
       $obras = $repository->findBy(array('artista' => $id));
       
       $repository = $this->getDoctrine()->getRepository('AppBundle:Curriculum');
       $curriculum = $repository->findOneBy(array('artista' => $id));
//       $queryb = $repository->createQueryBuilder('a')
//             ->select('obra', 'art.name')
//             
//             ->where('a.id = :id' )
//             ->setParameter('id', $id);
//       $query =$queryb->getQuery();
//       $obras = $query->getResult();
        // replace this example code with whateverneou need
        
        return $this->render('default/artista.html.twig', array('artist' => $artista, 'obras' => $obras, 
            'curriculum' => $curriculum));
        
    }
    
    /*
     *  @Route("/obra/{id}", name="obra")
     */
    public function obraAction(Request $request)
    {
        $obra_id = $request->get('obra');
        $repository = $this->getDoctrine()->getRepository('AppBundle:Obra');
       
        $obra = $repository->findOneBy(array('id' => $obra_id));
        return $this->render('default/obra.html.twig', array('obra' => $obra));
    }
    
       /**
     *  @Route("/modelo/{modelo}-{id}", name="modelo")
     */
    public function modeloAction(Request $request){
        
        $id = $request->get('id');
        $repository = $this->getDoctrine()->getRepository('AppBundle:Modelo');
         
        $queryb = $repository->createQueryBuilder('a')
        ->select( 'a.nombreArtistico', 'a.id', 'a.foto', 'u.nombre', 'u.apellidos' )
            ->join( 'a.usuario', 'u', 'AppBundle:Usuario')            
           ->where('a.id = :id')
           ->setParameter('id', $id);
            
        $query=$queryb->getQuery();
        $modelo = $query->getResult();
       
        $repository = $this->getDoctrine()->getRepository('AppBundle:Obra');       
        $obras = $repository->findBy(array('modelo' => $id));
       
        $repository = $this->getDoctrine()->getRepository('AppBundle:Curriculum');
        $curriculum = $repository->findOneBy(array('artista' => $id));
       
        return $this->render('default/artista.html.twig', array('artist' => $modelo, 'obras' => $obras, 
            'curriculum' => $curriculum));        
    }
    
    
    /*
     * @Route("/addArtista", name="addArtista")
     */
    public function newArtistAction(Request $request)
    {
        // randomly pick an obra photo
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT COUNT(o.id) FROM AppBundle\Entity\Obra o');
        $count = $query->getSingleScalarResult();
       
        $repository = $this->getDoctrine()->getRepository('AppBundle:Obra');
      
           do {
            $obra = $repository->findOneBy(array('id' => rand(1, $count)));
           }while (!$obra or $obra->getFoto() == null);
        
        $artista = new Artista();
        $form = $this->createForm(ArtistType::class, $artista);
        
        $form->handleRequest($request);
        
        $artista->upload();
        if($form->isSubmitted() and $form->isValid()){
            $usuario = $form["usuario"]->getData();
            $usuario->setDefaults();
            //Aun por ver como añado el rol 
           // $usuario->addRole('ROLE_ARTIST');
            $pwd=$usuario->getPassword();
            $encoder=$this->container->get('security.password_encoder');
            $pwd=$encoder->encodePassword($usuario, $pwd);
            $usuario->setPassword($pwd);
            $artista->setDestacado( false);
            $artista->setIsActive(false);
            $em->persist($usuario);
            $em->persist($artista);
            $em->flush();
            $this->get('session')->getFlashBag()->add('backgroundObra', $obra->getId());
            $this->get('session')->getFlashBag()->add('artista', $artista->getId());
            return $this->redirect($this->generateUrl('addCurriculum', array('request' => $request)));
        }
        
        return $this->render('default/createArtista.html.twig', array('form' => $form->createView(), 'obra' => $obra ));
    }   
      
      /*
     * @Route("/addModelo", name="addModelo")
     */
    public function newModeloAction(Request $request)
    {
        // randomly pick an obra photo
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT COUNT(o.id) FROM AppBundle\Entity\Obra o');
        $count = $query->getSingleScalarResult();
       
        $repository = $this->getDoctrine()->getRepository('AppBundle:Obra');
      
        do {
            $obra = $repository->findOneBy(array('id' => rand(1, $count)));
        }while (!$obra or $obra->getFoto() == null);
        
        $modelo = new Modelo();
        $form = $this->createForm(ModeloType::class, $modelo);
        
        $form->handleRequest($request);
        
        $modelo->upload();
        if($form->isSubmitted() and $form->isValid()){
            // El usuario puede ya estar creado.           
            $usuario = $form["usuario"]->getData();
            $usuario->setDefaults();
            //Aun por ver como añado el rol 
           // $usuario->addRole('ROLE_ARTIST');
            $pwd=$usuario->getPassword();
            $encoder=$this->container->get('security.password_encoder');
            $pwd=$encoder->encodePassword($usuario, $pwd);
            $usuario->setPassword($pwd);
            $modelo->setDestacado(false);
            $em->persist($usuario);
            $em->persist($modelo);
            $em->flush();
            $this->get('session')->getFlashBag()->add('backgroundObra', $obra->getId());
            $this->get('session')->getFlashBag()->add('artista', $modelo->getId());
            return $this->redirect($this->generateUrl('addObra', array('request' => $request)));
        }
        
        return $this->render('default/createArtista.html.twig', array('form' => $form->createView(), 'obra' => $obra ));
    }
    
    
    /*
     * @Route("/addCurriculum", name="addCurriculum")
     */
    public function newCurriculumAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository('AppBundle:Obra');
        $count = 1000;
        $id =  $this->get('session')->getFlashBag()->get('backgroundObra') ;
        if ($id){
            $obra = $repository->findOneBy(array('id'=> $id));
        }
        while (!$obra  or $obra->getFoto() ==null)  {
            $obra = $repository->findOneBy(array('id' => rand(1, $count)));
        }
        $repository = $this->getDoctrine()->getRepository('AppBundle:Artista');       
       
        $artista = $repository->findOneBy(array('id' =>  $this->get('session')->getFlashBag()->get('artista')));
       // $artista = $this->get('session')->getFlashBag()->get('artista');
        
        $curriculum = new Curriculum();
        if ($artista){
        $curriculum->setArtista($artista);  
        }

        $form = $this->createForm(CurriculumType::class, $curriculum);        
        $form->handleRequest($request);
        
        if($form->isSubmitted() and $form->isValid()){
          
            $estudios = $form->get('estudio')->getData();
            foreach($estudios as $estudio) {
                $em->persist($estudio);
            }
            
            $experiencias = $form->get('exposicion')->getData();
            foreach ($experiencias as $experiencia){
                $em->persist($experiencia);
            }
            $em->persist($curriculum);
           // $em->persist($artista);
            $em->flush();
            
            $this->get('session')->getFlashBag()->add('backgroundObra', $obra);
            $this->get('session')->getFlashBag()->add('artista', $artista->getId());
            return $this->redirect($this->generateUrl('addObra', array('request' => $request)));
        }
        
        return $this->render('default/createCurriculum.html.twig', array('form' => $form->createView(), 
            'obra' => $obra , 'artista' =>$artista ));
    }
    
     /*
     * @Route("/curriculum/{id}", name="editCurriculum")
     */
    public function editCurriculumAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository('AppBundle:Obra');
        $count = 1000;
        $id =  $this->get('session')->getFlashBag()->get('backgroundObra') ;
        if ($id){
            $obra = $repository->findOneBy(array('id'=> $id));
        }
        while (!$obra  or $obra->getFoto() ==null)  {
            $obra = $repository->findOneBy(array('id' => rand(1, $count)));
        }
        $repository = $this->getDoctrine()->getRepository('AppBundle:Curriculum');
       
        $curriculum = $repository->findOneBy(array('id' =>  $request->get('id') ));
        $artista = $curriculum->getArtista();

        /* $originalTags = new ArrayCollection();

            // Create an ArrayCollection of the current Tag objects in the database
            foreach ($task->getTags() as $tag) {
                $originalTags->add($tag);
            }*/

        $originalEstudios =  $curriculum->getEstudios();
        $originalExperiecias = $curriculum->getExperiencias();

        $form = $this->createForm(CurriculumType::class, $curriculum);
        $form->handleRequest($request);
        
        if($form->isSubmitted() and $form->isValid()){

            // remove the relationship between the tag and the Task
            foreach ($originalEstudios as $estudio) {
                if (false === $curriculum->getEstudios()->contains($estudio)) {
                    // remove the Task from the Tag
                    $curriculum->getEstudios()->removeElement($estudio);
                    $em->remove($estudio);
                }
            }
            $estudios = $form->get('estudio')->getData();
            foreach($estudios as $estudio) {
                if (false === $originalEstudios->contains($estudio)){
                    $em->persist($estudio);
                }
            }

             foreach ($originalExperiencias as $experiencia) {
                if (false === $curriculum->getExperiencias()->contains($experiencia)) {
                    $curriculum->getExperiencias()->removeElement($experiencia);
                    $em->remove($experiencia);
                }
             }            
             $experiencias = $form->get('exposicion')->getData();
             foreach ($experiencias as $experiencia){
                if (false === $originalExperiencias->contains($experiencia) {
                    $em->persist($experiencia);
                }
            }

            $em->flush();
            
            $this->get('session')->getFlashBag()->add('backgroundObra', $obra);
            $this->get('session')->getFlashBag()->add('artista', $artista->getId());
            return $this->redirectToRoute('artista', ['id' => $curriculurm->getArtista()->getId()]);
        }
        
        return $this->render('default/createCurriculum.html.twig', array('form' => $form->createView(), 
            'obra' => $obra , 'artista' =>$artista ));
    }
    /*
     *  @Route("/addObra", name="addObra")
     */
    public function newObraAction(Request $request){
         $em = $this->getDoctrine()->getManager();
          $count = 1000;
        $repository = $this->getDoctrine()->getRepository('AppBundle:Obra');
          $obraBackground =  $this->get('session')->getFlashBag()->get('backgroundObra') ;
        while (!$obraBackground  or $obraBackground->getFoto() ==null)  {
            $obraBackground = $repository->findOneBy(array('id' => rand(1, $count)));
        }
        $repository = $this->getDoctrine()->getRepository('AppBundle:Artista');       
        $artista = $repository->findOneBy(array('id' =>  $this->get('session')->getFlashBag()->get('artista')));             
             
        $obra = new Obra();
        
        $form = $this->createForm(ObraType::class, $obra);
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() and $form->isValid()){
            $em->persist($obra);
            $em->flush();
            return $this->redirect($this->generateUrl('success'));
        }
        return $this->render('default/createObras.html.twig', array('form' =>$form->createView(), 'obra' =>  $obraBackground));
    }
}
