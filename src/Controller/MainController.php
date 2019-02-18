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
    public function index()
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

        if($request->request->get('msg')){
            $UserMsg = $request->request->get('msg');
            //make something curious, get some unbelieveable data
            $arrData = ['msg' => $UserMsg];

            $msg = new ChatData();

            $msg->setLogin('goose');

            $msg->setChat($UserMsg);

            $this->getDoctrine()->getManager()->persist($msg);
            $this->getDoctrine()->getManager()->flush();

            return new JsonResponse($arrData);
        }

        //return $this->render('main/index.html.twig');

    }

    /**
     * @Route("/", name="login")
     */
    public function login(Request $request){

        if($request->isMethod('post'))
        {

            $request->cookies->set('p','1');

            $userLog = $request->request->get('login');
            $userPas = $request->request->get('password');

            $userPas = 1;//hash('sha256', $userPas, true);

            $em = $this->getDoctrine()->getManager()->getRepository(UserData::class);

            $userDataFromDB = $em->findOneBy([

                'login' => $userLog,
                'password' => $userPas,

            ]);

            //return $this->render('dump.html.twig', ['var' => $userDataFromDB]);

            if(isset($userDataFromDB))
            {

                $request->cookies->set('p', $userDataFromDB->getPassword());
            }

        }


        return $this->render('main/login.html.twig');

    }
}
