<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Message;
use AppBundle\Entity\Utilisateur;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

    /**
     * @Route("/envoie", name="envoie")
     */
    public function addPost(Request $request) {
        $message = new Message();
        $message->setMessage($request->get('message'));
        $message->setDate(time());
        $message->setUser($this->getUser());
        $em = $this->getDoctrine()->getManager();
        $em->persist($message);
        $em->flush();
        return $this->redirectToRoute("post");
    }

    /**
     * @Route("/inscription", name="insc")
     */
    public function inscription(Request $request) {
        $usr = new Utilisateur();
        $usr->setEmail($request->get('email'));
        $usr->setEtat(0);
        $usr->setMotDePasse($request->get('password'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($usr);
        $em->flush();
        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/Pseudo", name="upPseudo")
     */
    public function updatePseudo(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $usr = $em->find(Utilisateur::class, $this->getUser());
//        $this->createForm(UtilisateurType::class, $usr); 
        $usr->setPseudo($request->get('pseudo'));
        $em->merge($usr);
        $em->flush();
        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/updateUser", name="upUser")
     */
    public function updateUser(Request $request) {
        echo $request;
        $em = $this->getDoctrine()->getManager();
        if ($this->getUser()) {
            $users = $em->getRepository(Utilisateur::class)->findAll();
            foreach ($users as $user) {
                $user->setEtat(0);
                $em->merge($user);
                $em->flush();
            }
            $usr = $em->find(Utilisateur::class, $this->getUser());
//        $this->createForm(UtilisateurType::class, $usr);
//            $utilisateur = $this->getUser();
            $usr->setEtat(1);
            $em->merge($usr);
            $em->flush();
        }
//        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/message", name="post")
     * @param type $post
     * @return type
     */
    public function getPost() {
        $message = $this->getDoctrine()->getRepository(Message::class)->findAll();
        return new JsonResponse($message);
    }

}
