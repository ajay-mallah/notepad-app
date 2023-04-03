<?php
namespace App\Controller;

use App\Services\UserHandler;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controls authentication for the application
 * Has use Registration method
 * Has user verification method
 */

 class AuthenticateController extends AbstractController 
 {
    /**
     * @var EntityManagerInterface $em
     *   Instance of EntityManagerInterface
     */
    private $em = null;

    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }

    /**
     * Handles registration
     * 
     *   @Route("/register", name="app_register")
     *   
     *   @param Request $request
     *     Instance of Request 
     */
    public function registerAction(Request $request) : Response {
        if ($request->isXmlHttpRequest()) {
            $userHandler = new UserHandler($request, $this->em);
            return new JsonResponse($userHandler->register());
        }
        return $this->render('authentication/register.html.twig');
    }

    /**
     * Handles registration
     * 
     *   @Route("/login", name="app_login")
     *   
     *   @param Request $request
     *     Instance of Request 
     */
    public function loginAction(Request $request) : Response {
        if ($request->isXmlHttpRequest()) {
            $userHandler = new UserHandler($request, $this->em);
            $result = $userHandler->login();
            if ($result['status'] == 'success') {
                $encrypteData = base64_encode($request->request->get('email'));
                $this->sendResponse("success", $encrypteData);
            }
            return new JsonResponse($userHandler->login());
        }
        return $this->render('authentication/login.html.twig');
    }

        /**
     * Sends response 
     *   
     *   @param string $content
     *      Content of the response.
     * 
     *   @param mixed $userId
     *     User's id.
     * 
     *   @return void
     */
    private function sendResponse(string $content, mixed $userId) {
        $response = new Response();
        $response->headers->setCookie(new Cookie('current_user', $userId, strtotime('tomorrow'), '/'));
        $response->setContent($content);
        $response->headers->set('Content-Type', 'text/html');
        $response->send();
    }


 }