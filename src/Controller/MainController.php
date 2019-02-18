<?php

namespace App\Controller;

use App\Entity\ChatData;
use App\Entity\UserData;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/main", name="main")
     */
    public function index(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $userDataFromDB = $em->getRepository(UserData::class)->findAll();

        $chatDataFromDB = $em->getRepository(ChatData::class)->findAll();

        for($i=0; $i<count($chatDataFromDB); $i++)

        $chatPhoto[] = $em->getRepository(UserData::class)->findOneBy([

           'login' => $chatDataFromDB[$i]->getLogin(),

        ]);

        // return $this->render('dump.html.twig', ['var' => $chatPhoto]);


        return $this->render('main/index.html.twig',[

            'chat' => $chatDataFromDB,

            'user' => $userDataFromDB,

            'chatPhoto' => $chatPhoto,

        ]);
    }

    /**
     * @Route("/ajax", name="ajax")
     */
    public function ajaxCall(Request $request){

        if($request->request->get('some_var_name')){
            //make something curious, get some unbelieveable data
            $arrData = ['output' => 'here the result which will appear in div', 'second' => 'seconddate'];
            return new JsonResponse($arrData);
        }

        //return $this->render('main/index.html.twig');

    }

    /**
     * @Route("/", name="login")
     */
    public function login(){


        return $this->render('main/login.html.twig');

    }
}
