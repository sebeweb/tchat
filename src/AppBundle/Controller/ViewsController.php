<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Message;
use AppBundle\Entity\Utilisateur;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of ViewsController
 *
 * @author sebastien-javary
 */
class ViewsController extends Controller {

    /**
     * @Route("/tchat", name="tchat")
     */
    public function getTchat(Request $request) {
        $message = $this->getDoctrine()->getRepository(Message::class)->findAll();
        $nbr = count($message) - 50;
//        echo $nbr;
        $usr = $this->getDoctrine()->getRepository(Utilisateur::class)->findByEtat(1);
        if ($nbr < 0) {
            $post = $message;
        } else {
            $post = $this->getDoctrine()->getRepository(Message::class)->findBy(array(), array('date' => 'ASC'), 50, $nbr);
        }

        return $this->render("default/index.html.twig", array("messages" => $post, "users"=>$usr));
    }

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request) {
        return $this->render("default/connection.html.twig");
    }

}
