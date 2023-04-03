<?php
namespace App\Controller;

use App\Services\NotepadHandler;
use App\Services\UserHandler;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Handles create, update, delete and and list notes actions.
 */

 class NotepadController extends AbstractController 
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
     * Create a new Note and store it in the database
     * 
     *   @Route("/", name="app")
     *   
     *   @param Request $request
     *     Instance of Request 
     * 
     *   @return Response
     *     Returns JsonResponse for xml request.
     *     Returns page for none xml request.
     */
    public function index(Request $request) : Response {
        $cookie = $request->cookies;
        if ($cookie->get('current_user')) {
            try {
                $noteHandler = new NotepadHandler($request, $this->em);
                return $this->render('Notepad/index.html.twig', [
                    'notes' => $$noteHandler->getNotes()['data'],
                ]);
            }
            catch (Exception $e) {
                return new JsonResponse($e->getMessage());
            }
        }
        else {
            return $this->redirectToRoute('app_login');
        }
    }

    /**
     * Create a new Note and store it in the database
     * 
     *   @Route("/notepad/create", name="app_createNote")
     *   
     *   @param Request $request
     *     Instance of Request 
     * 
     *   @return Response
     *     Returns JsonResponse for xml request.
     *     Returns page for none xml request.
     */
    public function createNote(Request $request) : Response {
        if ($request->isXmlHttpRequest()) {
            $noteHandler = new NotepadHandler($request, $this->em);
            return new JsonResponse($noteHandler->deleteNote());
        }        
        return $this->render('Notepad/create.html.twig');
    }

    /**
     * Create a new Note and store it in the database
     * 
     *   @Route("/notepad/update", name="app_update_note")
     *   
     *   @param Request $request
     *     Instance of Request 
     * 
     *   @return Response
     *     Returns JsonResponse for xml request.
     *     Returns page for none xml request.
     */
    public function updateNote(Request $request) : Response {
        if ($request->isXmlHttpRequest()) {
            $noteHandler = new NotepadHandler($request, $this->em);
            return new JsonResponse($noteHandler->updateNote());
        }
    }
    
    /**
     * deletes note.
     * 
     *   @Route("/notepad/delete", name="app_delete_note")
     *   
     *   @param Request $request
     *     Instance of Request 
     * 
     *   @return Response
     *     Returns JsonResponse for xml request.
     *     Returns page for none xml request.
     */
    public function deleteNote(Request $request) : Response {
        if ($request->isXmlHttpRequest()) {
            $noteHandler = new NotepadHandler($request, $this->em);
            return new JsonResponse($noteHandler->deleteNote());
        }
    }

    /**
     * read more request.
     * 
     *   @Route("/notepad/readmore", name="app_readmore")
     *   
     *   @param Request $request
     *     Instance of Request 
     * 
     *   @return Response
     *     Returns JsonResponse for xml request.
     *     Returns page for none xml request.
     */
    public function readMore(Request $request) : Response {
        if ($request->isXmlHttpRequest()) {
            $noteHandler = new NotepadHandler($request, $this->em);
            return $this->render('Notepad/view.html.twig', [
                'notes' => $$noteHandler->getNote,
            ]);
        }
    }

 }