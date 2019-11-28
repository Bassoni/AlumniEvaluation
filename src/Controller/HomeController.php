<?php


namespace App\Controller;



use App\Repository\DegreeRepository;
use App\Repository\UserRepository;
use App\Repository\YearRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController
{
    /**
     * @Route("/",name="home.index")
     */

//UserRepository $userRepo a mettre en parametre pour afficher l'avatar

    public function index(DegreeRepository $degreeRepo,
                          YearRepository $yearRepo,
                          UserRepository $userRepo,
                          Request $request)
    {
        //$degrees = $this->getDoctrine()->getRepository(Degree::class)->findAll();
        //De façon plus courte:
        $degrees = $degreeRepo->findAll();
        $years = $yearRepo->findAll();
        $theDegree= null;
        $theYear= null;


        $resultat = [];

        if ($request->request->count())
        {

            $degree = $request->request->get("searchFormation");
            $year = $request->request->get("searchAnnee");
            $resultat = $userRepo->search($degree, $year);

            $theDegree =$degreeRepo->find($degree);
            $theYear =$yearRepo->find($year);


            //  dd($formations, $annees);   //ligne pour afficher l'id des elements formation et année selecioné dans les selects
        }



        return $this->render('home.html.twig', ['degrees'=>$degrees, 'years'=>$years, 'theYear'=>$theYear,'theDegree'=>$theDegree, 'resultat'=>$resultat]);
    }








}