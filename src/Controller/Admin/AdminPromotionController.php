<?php


namespace App\Controller\Admin;

use App\Entity\Promotion;
use App\Form\PromotionFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminPromotionController extends AbstractController
{
    /**
     * @Route("/admin/promotion/new", name="admin.promotion.new")
     */
    public function new(Request $request)
    {
        $form = $this->createForm(PromotionFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $promotion =$form->getData();

            $manager =$this->getDoctrine()->getManager();
            $manager->persist($promotion);
            $manager->flush();

            $this->addFlash('info','promotion ajoutée avec succès!');

            return $this->redirectToRoute('admin.index', [
                '_fragment' =>'pills-promotion'
            ]);
        }
        return $this->render('admin/promotion/new.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/admin/promotion/{id}/edit", name="admin.promotion.edit")
     */
    public function edit(Promotion $promotion, Request $request){
        $form =$this->createForm(PromotionFormType::class, $promotion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $manager =$this->getDoctrine()->getManager();
            $manager->flush();

            $this->addFlash('info','promotion modifié avec succès!');

            return $this->redirectToRoute('admin.index', [
                '_fragment' =>'pills-promotion'
            ]);
        }
        return $this->render('admin/promotion/edit.html.twig', ['form'=>$form->createView()]);
    }

    /**
     * @Route("/admin/promotion/{id}/delete", name="admin.promotion.delete")
     */
    public function delete(Promotion $promotion)
    {
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($promotion);

        $manager->flush();

        $this->addFlash('info', 'Elément "Promotion" supprimé');

        return $this->redirectToRoute('admin.index', [
            '_fragment' =>'pills-promotion'
        ]);
    }

    /**
     * @Route("/admin/promotion/{id}/show", name="admin.promotion.show")
     */
    public function show(Promotion $promotion){

        return $this->render('admin/promotion/index.html.twig',['promotion'=>$promotion]);

    }

}