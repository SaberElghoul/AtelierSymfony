<?php

namespace AppBundle\Controller;

use AppBundle\Entity\personne;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Todo;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class PersonController extends Controller
{
    /**
     * @Route("/liste", name="CVList")
     */
    public function listeAction()
    {
        $personnes = $this -> getDoctrine()->getRepository('AppBundle:personne')->findAll();
        return $this->render('@App/personne/liste.html.twig',array(
            'personnes'=>$personnes

        ));
    }

    /**
     * @Route("/Add",name="CVAdd")
     */
    public function AddAction(Request $request)
    {
        $personne=new personne();
        $form =$this->createFormBuilder($personne)
            ->add('name',TextType::class,array('attr'=>array('class'=>'form-control','style'=>'margin-bottom:15px')))
            ->add('lastName',TextType::class,array('attr'=>array('class'=>'form-control','style'=>'margin-bottom:15px')))
            ->add('age',TextType::class,array('attr'=>array('class'=>'form-control','style'=>'margin-bottom:15px')))
            ->add('path',TextType::class,array('attr'=>array('class'=>'form-control','style'=>'margin-bottom:15px')))
            ->add('save',SubmitType::class,array('label'=> 'ADD CV','attr'=>array('class'=>'btn btn-primary','style'=>'margin-bottom:15px')))

            ->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted()&&$form->isValid()) {

            $name = $form['name']->getData();
            $lastName = $form['lastName']->getData();
            $age = $form['age']->getData();
            $path = $form['path']->getData();
            $personne->setName($name);
            $personne->setLastname($lastName);
            $personne->setAge($age);
            $personne->setPath($path);


            $em = $this->getDoctrine()->getManager();
            $em->persist($personne);
            $em->flush();

            $this->addFlash(
                'create',
                'CV created'
            );
            return $this->redirectToRoute('CVList');


        }



            return $this->render('@App/personne/add.html.twig', array('form'=>$form->createView()
        ));
    }



    /**
     * @Route("/show/{id}")
     */
    public function showAction($id)


    {

        $personne=$this->getDoctrine()->getRepository('AppBundle:personne')->find($id);
        return $this->render('AppBundle:personne:show.html.twig', array(
            'personne'=>$personne
            // ...
        ));
    }




    /**
     * @Route("/remove/{id}")
     */
    public function removeAction($id)

    {


        $em=$this->getDoctrine()->getManager();
        $personne=$em->getRepository('AppBundle:personne')->find($id);
        $em->remove($personne);
        $em->flush();
        $this->addFlash(
            'delete',
            'CV removed'
        );

        return $this->redirectToRoute('CVList');

    }




    /**
     * @Route("/edit/{id}",name="edit")
     */
    public function EditAction($id,Request $request)
    {
        $personne=$this->getDoctrine()->getRepository('AppBundle:personne')->find($id);

        $personne->setName($personne->getName());
        $personne->setLastname($personne->getLastname());
        $personne->setAge($personne->getAge());
        $personne->setPath($personne->getPath());


        $form =$this->createFormBuilder($personne)
            ->add('name',TextType::class,array('attr'=>array('class'=>'form-control','style'=>'margin-bottom:15px')))
            ->add('lastName',TextType::class,array('attr'=>array('class'=>'form-control','style'=>'margin-bottom:15px')))
            ->add('age',TextType::class,array('attr'=>array('class'=>'form-control','style'=>'margin-bottom:15px')))
            ->add('path',TextType::class,array('attr'=>array('class'=>'form-control','style'=>'margin-bottom:15px')))
            ->add('save',SubmitType::class,array('label'=> 'Edit your CV','attr'=>array('class'=>'btn btn-primary','style'=>'margin-bottom:15px')))

            ->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted()&&$form->isValid()) {

            $name = $form['name']->getData();
            $lastName = $form['lastName']->getData();
            $age = $form['age']->getData();
            $path = $form['path']->getData();



            $em = $this->getDoctrine()->getManager();
            $personne=$em->getRepository('AppBundle:personne')->find($id);

            $personne->setName($name);
            $personne->setLastname($lastName);
            $personne->setAge($age);
            $personne->setPath($path);



            $em->persist($personne);
            $em->flush();

            $this->addFlash(
                'edit',
                'CV edited'
            );

            return $this->redirectToRoute('CVList');


        }







        return $this->render('@App/personne/edit.html.twig', array(
            'persone'=>$personne,
            'form'=>$form->createView()
        ));
    }
}
