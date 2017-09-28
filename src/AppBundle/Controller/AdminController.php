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
    * @route("/admin", name"admin)
    */
    public adminAction(Request $request){

        $repository = $this->getDoctrine()->getRepository('AppBundle:Artista');

        $query->
    }

    }


}