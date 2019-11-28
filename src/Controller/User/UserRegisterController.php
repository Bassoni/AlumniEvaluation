<?php


namespace App\Controller\User;


use App\Form\UserFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserRegisterController extends AbstractController
{

    /**
     * @Route("/user/register", name="user.register")
     */
    public function register(Request $request)
    {
        $form = $this->createForm(UserFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $user = $form->getData();
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($user);
            $manager->flush();

            $this->addFlash('info', 'Elément "Formation" ajouté!');

            return $this->redirectToRoute('admin.index');
        }
        return $this->render('user/register.html.twig', ['form'=>$form->createView()]);
    }

}