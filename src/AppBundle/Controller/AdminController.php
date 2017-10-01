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
use AppBundle\Form\CurriculumType;
use AppBundle\Form\ObraType;

class AdminController extends Controller
{

    /**
    * @Route("/admin", name="admin")
    */
    public function adminAction(Request $request){

        $repository = $this->getDoctrine()->getRepository('AppBundle:Artista');
        $queryb = $repository->createQueryBuilder('a')
            ->select('art.name', 'a.nombreArtistico', 'a.id', 'a.foto', 'u.nombre', 'u.apellidos' )
            ->join( 'a.usuario', 'u', 'AppBundle:Usuario')
            ->leftjoin('a.art', 'art') 
            ->where('u.isActive = 0')
            ->orderBy('u.id', 'ASC');  
        
        
    }

}

