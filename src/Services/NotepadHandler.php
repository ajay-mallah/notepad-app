<?php

namespace App\Services;

use App\Entity\Notepad;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\HttpFoundation\Request;

/**
 * Handles user authentication and validation.
 * Fetches user data from the database.
 * Updates user data to the database.
 */
class NotepadHandler 
{
    /**
     * @var Request $request
     *   Instance of Request.
     */
    private $request = null;

    /**
     * @var EntityManagerInterface $em
     *   Instance of EntityManagerInterface.
     */
    private $em = null;

    /**
     * Initializes the class variables.
     * 
     *   @param Request $request
     *     Instance of Request.
     *   
     *   @param EntityManagerInterface $em
     *     Instance of EntityManagerInterface.
     */
    public function __construct(Request $request, EntityManagerInterface $em) {
        $this->request = $request;
        $this->em = $em;
    }

    /**
     * Adds notes into the database.
     * 
     *   @return array
     *     Return an array of status and error messages.
     */
    public function addNote() {
        $result['status'] = "success";
        try {
            $note = new Notepad();
            $user = $this->em->getRepository(User::class)->findOneBy(['email' => base64_decode($this->request->cookies->get('current_user'))]);
            $note->setAuthor($user);
            $note->setTitle($this->request->request->get('title'));
            $note->setText($this->request->request->get('text'));

            $user->addNotepad($note);

            $this->em->persist($note);
            $this->em->persist($user);
            $this->em->flush();
        }
        catch (Exception $e){
            $result['message'] = $e->getMessage();
            $result['status'] = "exception";
        }

        return $result;
    }

    /**
     * Updates notes.
     * 
     *   @return array
     *     Return an array of status and error messages.
     */
    public function updateNote() {
        $result['status'] = "success";
        try {
            $note = $this->em->getRepository(Notepad::class)->findOneBy(['id' => $this->request->request->get('note_id')]);
            $note->setTitle($this->request->request->get('title'));
            $note->setText($this->request->request->get('text'));

            $this->em->merge($note);
            $this->em->flush();
        }
        catch (Exception $e){
            $result['message'] = $e->getMessage();
            $result['status'] = "exception";
        }

        return $result;
    }

    /**
     * Updates notes.
     * 
     *   @return array
     *     Return an array of status and error messages.
     */
    public function deleteNote() {
        $result['status'] = "success";
        try {
            $note = $this->em->getRepository(Notepad::class)->findOneBy(['id' => $this->request->request->get('note_id')]);
            $user = $this->em->getRepository(User::class)->findOneBy(['email' => base64_decode($this->request->cookies->get('current_user'))]);

            $user->removeNotepad($note);
            $this->em->remove($note);
            $this->em->merge($user);
            $this->em->flush();
        }
        catch (Exception $e){
            $result['message'] = $e->getMessage();
            $result['status'] = "exception";
        }

        return $result;
    }

    /**
     * returns notes.
     * 
     *   @return array
     *     Return an array of status and error messages.
     */
    public function getNotes() {
        $result['status'] = "success";
        try {
            $user = $this->em->getRepository(User::class)->findOneBy(['email' => base64_decode($this->request->cookies->get('current_user'))]);

            $notes = $user->getNotepads();
            $data = [];
            foreach ( $notes as $note ) {
                array_push($data, [
                    'id' => $note->getId(),
                    'title' => $note->getTitle(),
                    'text' => $note->getText(),
                ]);
            } 
            $result['data'] = $data;
        }
        catch (Exception $e){
            $result['message'] = $e->getMessage();
            $result['status'] = "exception";
        }

        return $result;
    }

    /**
     * returns a note.
     * 
     *   @return array
     *     Return an array of status and error messages.
     */
    public function getNote() {
        $result['status'] = "success";
        try {
            $note = $this->em->getRepository(User::class)->findOneBy(['id' => $this->request->request->get('note_id')]);
            $data = [
                    'id' => $note->getId(),
                    'title' => $note->getTitle(),
                    'text' => $note->getText()
            ];
            $result['data'] = $data;
        }
        catch (Exception $e){
            $result['message'] = $e->getMessage();
            $result['status'] = "exception";
        }

        return $result;
    }

}