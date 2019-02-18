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
            $em = $this->getDoctrine()->getRepository(UserData::class);
            $photoByCookie = $em->findOneBy([

               'login' =>  $request->cookies->get('l')

            ]);

            //make something curious, get some unbelieveable data
            $arrData = ['msg' => $UserMsg, 'usrData' => $photoByCookie->getPhoto()];

            $msg = new ChatData();
            $msg->setLogin($request->cookies->get('l'));
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
        if(!empty($request->cookies->get('p')))
        {
            $em = $this->getDoctrine()->getManager()->getRepository(UserData::class);
           $check = $em->findOneBy([
               "login" =>  $request->cookies->get('l'),
                "password" => $request->cookies->get('p'),
            ]);
            if(isset($check)){
                return $this->redirectToRoute('main', [], 302);
            }

           // echo $check;
        }
        if($request->isMethod('post'))
        {
            $request->cookies->set('p','1');
            $userLog = $request->request->get('login');
            $userPas = $request->request->get('password');
            $userPasHash = hash('sha256', $userPas, false);
            $em = $this->getDoctrine()->getManager()->getRepository(UserData::class);
            $userDataFromDB = $em->findOneBy([
                'login' => $userLog,
                'password' => $userPasHash,
            ]);
            //return $this->render('dump.html.twig', ['var' => $userPasHash]);
            if(isset($userDataFromDB))
            {
               setcookie('l', $userLog);
               setcookie('p', $userPasHash);
            }

            $em = $this->getDoctrine()->getManager()->getRepository(UserData::class);

           $chekAfterLogin = $em->findOneBy([
               "login" =>  $userLog,
                "password" => $userPasHash,
            ]);

            if(isset($chekAfterLogin)){
                return $this->redirectToRoute('main', [], 302);
            }
        }
        return $this->render('main/login.html.twig');
    }

    /**
     * @Route("/ajax_toDB", name="update")
     */
    public function update(Request $request){

//        if(empty($request->request->get('LastMsg')))
//            return $this->render('dump.html.twig', ['var' =>'StartError']);


        $lastMsgChat = 'sdfgh';//$request->request->get('LastMsg');

        $data = $this->getDoctrine()->getRepository(ChatData::class);

       $dataFindAll = $data->findAll();

       $lstMsgDB = $dataFindAll[count($dataFindAll)-1]->getChat();

       $msgFromChatInDB = $data->findOneBy([

           'chat' => $lastMsgChat

       ]);

       if($lastMsgChat != $lstMsgDB)
       {

            $dif =  count($dataFindAll) - $msgFromChatInDB->getId();

           return new JsonResponse($data->getLastMsg($dif));
       }

        return $this->render('dump.html.twig', ['var' =>  '1']);
    }
}