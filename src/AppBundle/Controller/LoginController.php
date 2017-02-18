<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of LoginController
 *
 * @author sebastien-javary
 */
class LoginController extends Controller {

    /**
     * @Route("/login", name="login")
     */
    public function login(Request $request) {
        return $this->render("default/connection.html.twig");
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout(Request $request) {
        return $this->render("default/connection.html.twig");
    }

}
