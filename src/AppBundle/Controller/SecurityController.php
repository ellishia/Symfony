<?php

// src/AppBundle/Controller/SecurityController.php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Usuario;
use AppBundle\Entity\Artista;
use AppBundle\Entity\Model;
use AppBundle\Entity\Obra;
use AppBundle\Form\UsuarioType;
use AppBundle\Form\PasswordType;
use AppBundle\Form\ArtistType;
use AppBundle\Form\ModelType;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;


class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig',
            array(
                // last username entered by the user
                'last_username' => $lastUsername,
                'error'         => $error,
            )
        );
    }
    
    /*
     *  @Route("/modPass", name="password")
     */
    //TODO
    public function modifyPass(Request $request){
        
        $form = $this->createForm(PasswordType::class);         
        
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
            $roles=['ROLE_USER', 'ROLE_ARTIST'];
            $usuario->setRoles($roles);
            $pwd=$usuario->getPassword();
            $encoder=$this->container->get('security.password_encoder');
            $pwd=$encoder->encodePassword($usuario, $pwd);
            $usuario->setPassword($pwd);
            $artista->setDestacado( false);
            $artista->setIsActive(false);
            $em->persist($usuario);
            $em->persist($artista);
            $em->flush();
            // login the new created user
            $this->authenticateUser($usuario);
            
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
            $roles=['ROLE_USER'];
            $usuario->setRoles($roles);
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
        
        return $this->render('default/createModelo.html.twig', array('form' => $form->createView(), 'obra' => $obra ));
    }
    
     /**
     * @Route("/addUser", name="addUser")
     */
    public function newUserAction(Request $request)
    {
        // 1) build the form
        $user = new Usuario();
        $form = $this->createForm(UsuarioType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $this->get('security.password_encoder')
                ->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            // 4) save the User!
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            return $this->redirectToRoute('');
        }

        return $this->render('default/register.html.twig', array('form' => $form->createView())
        );
    }    
    
    public function authenticateUser(Usuario $user)
    {
        $providerKey = 'secured_area'; // your firewall name
        $token = new UsernamePasswordToken($user, null, $providerKey, $user->getRoles());

        $this->container->get('security.context')->setToken($token);
    }    
}

    
