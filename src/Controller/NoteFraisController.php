<?php

namespace App\Controller;

use App\Entity\NoteFrais;
use App\Repository\NoteFraisRepository;
use App\Repository\SocieteRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Exceptions\BadCredentialsException;
use Symfony\Component\HttpFoundation\JsonResponse;
use DateTime;

class NoteFraisController extends AbstractController
{

    public function __construct(
        private NoteFraisRepository $noteFraisRepository,
        private UserRepository      $userRepository,
        private SocieteRepository   $societeRepository
    )
    {
    }

    #[Route(
        'api/notefrais/getall',
        name: 'app_note_frais_all',
        methods: ['GET'],
        defaults: [
            '_api_resource_class' => NoteFrais::class,
        ]
    )]
    public function getAllNoteFrais(): JsonResponse
    {
        $this->checkUser();
        $notesFrais = $this->noteFraisRepository->findAll();
        return new JsonResponse($notesFrais, Response::HTTP_OK);
    }


    #[Route(
        'api/notefrais/get/{id}',
        name: 'app_note_frais_get',
        methods: ['GET']
    )]
    public function getNoteFrais(Request $request): Response
    {
        $this->checkUser();
        $id = $request->attributes->get('id');
        $noteFrais = $this->noteFraisRepository->find($id);
        $this->checkNote($noteFrais);
        return new JsonResponse($noteFrais, Response::HTTP_OK);
    }


    #[Route(
        'api/notefrais/update/{id}',
        name: 'app_note_frais_update',
        methods: ['PUT']
    )]
    public function updateNoteFrais(Request $request): Response
    {
        $this->checkUser();
        $id = $request->attributes->get('id');
        $data = json_decode($request->getContent());
        $data->id = $id;
        $noteFrais = $this->noteFraisRepository->find($id);
        $this->checkNote($noteFrais);
        $noteFrais = $this->checkFluxNote($data);
        $this->noteFraisRepository->saveNoteFrais($noteFrais);
        return new JsonResponse(['status' => 'Note Frais updated!'], Response::HTTP_CREATED);
    }

    #[Route(
        'api/notefrais/create',
        name: 'app_note_frais_create',
        methods: ['POST']
    )]
    public function createNoteFrais(Request $request): Response
    {
        $this->checkUser();
        $data = json_decode($request->getContent());
        $noteFrais = $this->checkFluxNote($data);
        $this->noteFraisRepository->saveNoteFrais($noteFrais);
        return new JsonResponse(['status' => 'Note Frais created!'], Response::HTTP_CREATED);

    }

    #[Route(
        'api/notefrais/delete/{id}',
        name: 'app_note_frais_delete',
        methods: ['DELETE']
    )]
    public function deleteNoteFrais(int $id): Response
    {
        try {
            $this->checkUser();

            $noteFrais = $this->noteFraisRepository->find($id);

            $this->checkNote($noteFrais);

            $this->noteFraisRepository->removeNote($noteFrais);

            return new JsonResponse(['status' => 'Customer deleted'], Response::HTTP_NO_CONTENT);
        } catch (Throwable $t) {
            return $this->error($t->getMessage());
        }
    }

    /**
     *
     */
    public function checkUser(): void
    {
        if ($this->getUser()->getId() != 1) {
            throw new BadCredentialsException();
        }
    }

    public function checkNote(?NoteFrais $noteFrais): void
    {
        // 404 - Not found
        // Validate that this note exists
        if (is_null($noteFrais)) {
            throw new NotFoundException('Note Frais Not Found!');
        }
    }

    public function checkFluxNote($data): ?NoteFrais
    {
        $dateNote = $data->date_note;
        $montantNote = $data->montant_note;
        $typeNote = $data->type_note;
        $dateEnregistrement = $data->date_enregistrement;
        $useId = $data->user_id;
        $societeId = $data->societe_id;

        if (empty($dateNote) || empty($montantNote) || empty($typeNote) || empty($dateEnregistrement) || empty($useId) || empty($societeId)) {
            throw new NotFoundHttpException('Expecting parameters!');
        }
        $societe = $this->societeRepository->find($societeId);
        if (is_null($societe)) {
            throw new NotFoundHttpException('Societe Not Found!');
        }

        $user = $this->userRepository->find($useId);
        if (is_null($user)) {
            throw new NotFoundHttpException('User Not Found!');
        }
        if (isset($data->id) && !empty($data->id)) {
            $noteFrais = $this->noteFraisRepository->find($data->id);
        } else {
            $noteFrais = new NoteFrais();
        }
        $noteFrais->setDateNote(new DateTime($dateNote));
        $noteFrais->setMontantNote($montantNote);
        $noteFrais->setTypeNote($typeNote);
        $noteFrais->setDateEnregistrement(new DateTime($dateEnregistrement));
        $noteFrais->setSociete($societe);
        $noteFrais->setUser($user);
        return $noteFrais;
    }
}
