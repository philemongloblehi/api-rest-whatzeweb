<?php

namespace App\Controller;

use App\Entity\Phone;
use App\Repository\PhoneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Knp\Component\Pager\PaginatorInterface;

class PhoneController extends AbstractController
{
    /**
     * @Route("/api/phones", name="phone_create", methods={"POST"})
     * @param SerializerInterface $serializer
     * @return JsonResponse
     */
    public function postPhoneActri(SerializerInterface $serializer): Response
    {
        $phone = new Phone();
        $phone->setName('Iphone X');
        $phone->setPrice(1000);
        $phone->setColor('Noir');
        $phone->setDescription('Un superbe iphone');

        $data = $serializer->serialize($phone, 'json');

        return new Response($data, 200, [
            'Content-Type' => 'application/json'
        ]);
    }

    /**
     * @param PhoneRepository $repository
     * @param SerializerInterface $serializer
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     * @Route("/api/phones", name="phone_list", methods={"GET"})
     */
    public function getPhonesAction(PhoneRepository $repository, SerializerInterface $serializer, PaginatorInterface $paginator, Request $request): Response
    {
        $phones = $repository->findAll();
        $data = $serializer->serialize($phones, 'json');

        $data = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            10
        );

        return new Response($data, 200, [
           'Content-Type' => 'application/json'
        ]);
    }
}
