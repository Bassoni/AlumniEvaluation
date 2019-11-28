<?php


namespace App\Controller\Admin;


use App\Entity\Degree;
use App\Form\DegreeFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminDegreeController extends AbstractController
{
    /**
     * @Route("/admin/degree/new", name="admin.degree.new")
     */
    public function new(Request $request)
    {
        $form = $this->createForm(DegreeFormType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $degree = $form->getData();
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($degree);
            $manager->flush();

            $this->addFlash('info', 'Elément "Formation" ajouté!');

            return $this->redirectToRoute('admin.index', [
                '_fragment' =>'pills-formation'
            ]);
        }
        return $this->render('admin/degree/new.html.twig', ['form'=>$form->createView()]);
    }

    /**
     * @Route("/admin/degree/{id}/edit", name="admin.degree.edit")
     */
    public function edit(Degree $degree, Request $request)
    {

        $form= $this->createForm(DegreeFormType::class , $degree );
        $form->handleRequest($request); //equivalent d'un post , permet de recuperer les données du formulaire et de remplire la variable forme avec celles-ci

        if ($form->isSubmitted() && $form->isValid()){
            $manager = $this->getDoctrine()->getManager();
            $manager->flush();

            $this->addFlash('info', 'Elément "Formation" modifié!');

            return $this->redirectToRoute('admin.index', [
                '_fragment' =>'pills-formation'
            ]);
        }
        return $this->render('admin/degree/edit.html.twig', ['form'=>$form->createView()]);
    }



    /**
     * @Route("/admin/degree/{id}/delete", name="admin.degree.delete")
     */
    public function delete(Degree $degree)
    {
        $id = 'degree-'. $degree->getId();

        $manager = $this->getDoctrine()->getManager();
        $manager->remove($degree);

        $manager->flush();

        $this->addFlash('info', 'Elément "Formation" supprimé');

        //ce retour permet de recuperer la réponse de la fonction de call back au moment d'une suppression d'une formation ( grace a de l'ajax )
        return $this->json($id);

        //ce retour permet de faire une redirection suite a la suppression pour actualiser la page
//        return $this->redirectToRoute('admin.index', [
//            '_fragment' =>'pills-formation'
//        ]);
    }



}