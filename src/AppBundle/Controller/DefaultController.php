<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
 * @Route("/", name="homepage")
 */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }


    /**
     * @Route("/CV", name="moncv")
     */
    public function cvAction(Request $request)
    {

       $user =new User();
       $user->setNom('saber');
       $user->setAge('30');
       $user->setPrenom('elghoul');
       $now=new\DateTime('now');
       $user->setDateajout($now);


        return $this->render('cv.html.twig', [
            'user' => $user ]);
    }
}
