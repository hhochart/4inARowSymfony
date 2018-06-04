<?php

namespace App\Controller;

use App\Entity\Player;
use App\Form\LoginType;
use App\Form\PlayerType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login")
     * @Template("security/login.html.twig")
     */
    public function login(Request $request)
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('player');
        }

        $player = new Player();
        $form   = $this->createForm(LoginType::class, $player);

        $form->handleRequest($request);

        return [
            'form' => $form->createView(),
        ];
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {
    }

    /**
     * @Route("/register", name="register")
     * @Template("security/register.html.twig")
     *
     * @param $request
     *
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function new(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('player');
        }

        $player = new Player();
        $form   = $this->createForm(PlayerType::class, $player);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $playerSubmit  = $form->getData();

            $password = $passwordEncoder->encodePassword($playerSubmit, $playerSubmit->getPlainPassword());
            $playerSubmit->setPassword($password);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($playerSubmit);
            $entityManager->flush();
            $this->addFlash('notice', 'You are now registered ! Please login');

            return $this->redirectToRoute('login');
        }

        return [
            'form' => $form->createView(),
        ];
    }
}
