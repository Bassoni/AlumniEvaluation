<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    /**
    * @Route("/account/create",name="account.createAccount")
    */
    public function createAccount(){
        return $this->render('createaccount.html.twig');
    }


}