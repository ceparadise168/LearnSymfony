<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use AppBundle\Entity\Message;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
                'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
                ]);
    }

    /**
     * @Route("add", name="add")
     */


    public function createAction()
    {
        $message = new Message();
        $message->setUserName('eric');
        $message->setMsg('hello');

        $em = $this->getDoctrine()->getManager();

        $em->persist($message);

        $em->flush();

        return new Response('Saved new product with id: ' . $message->getId() . ',   name: ' . $message->getUserName());

    }


    /**
     * @Route("show", name="show")
     */

    public function showAction($id)
    {
        $message = $this->getDoctrine()
            ->getRepository('AppBundle:Message')
            ->find($id);
        if (!$message) {
            throw $this->createNotFoundException(
                    'No message found for id ' . $id
                    );

        }

    }

    public function updateAction($Id)
    {
        $em = $this->getDoctrine()->getManager();
        $message = $em->getRepository('AppBundle:Message')->find($messageId);

        if (!$message) {
            throw $this->createNotFoundException(
                    'No product found ofr id ' . $messageId
                    );

            $message->setUserName('New User name!');
            $en->flush();

            return $this->redirectToRouter('homepage');

        }
    }



}
