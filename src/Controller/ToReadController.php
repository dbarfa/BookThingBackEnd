<?php

namespace App\Controller;

use App\DTO\ToReadDTO;
use App\Entity\User;
use App\Mappers\ToReadMappers;
use App\Repository\ToReadRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ToReadController extends AbstractFOSRestController
{
    #[Post('api/toread/add', name: 'add_to_read')]
    #[View]
    #[ParamConverter('dto', converter: 'fos_rest.request_body')]
    #[IsGranted('ROLE_USER')]
    public function post(ToReadDTO              $dto,
                         EntityManagerInterface $em,
                         ToReadRepository       $toReadRepository)
    {

        /** @var  $user User */
        $user = $this->getUser();
        $toRead = ToReadMappers::PostToRead($dto, $user);
        $isInDb = $toReadRepository->findOneBy(['worksId' => $dto->getBook()]);
        if ($isInDb != null) {
            if (in_array($user, $isInDb->getUser()->toArray())) {
                throw new BadRequestHttpException();
            } else {
                $isInDb->addUser($user);
            }
        } else {
            $em->persist($toRead);
        }
        $em->flush();
        return;
    }


    #[Post('api/toread/delete', name: 'delete_toread')]
    #[View]
    #[ParamConverter('dto', converter: 'fos_rest.request_body')]
    #[IsGranted('ROLE_USER')]
    public function deleteToReadPost(ToReadDTO              $dto,
                                     ToReadRepository       $toReadRepository,
                                     EntityManagerInterface $em)
    {
        /** @var  $user User */
        $user = $this->getUser();
        $toRead = $toReadRepository->findOneBy(['worksId' => $dto->getBook()]);
        $toRead->removeUser($user);
        if (count($toRead->getUser()) == 0) {
            $em->remove($toRead);
        }
        $em->flush();
    }

    #[Get('api/toread/getall', name: 'get_all_to_read')]
    #[View]
    #[IsGranted('ROLE_USER')]
    public function getAllToRead(ToReadRepository $toReadRepository)
    {
        /** @var  $user User */
        $user = $this->getUser();
        $toRead = $toReadRepository->findAll();
        $filteredtoRead = [];
        $i = 1;
        foreach ($toRead as $item) {
            if (in_array($user, $item->getUser()->toArray())) {
                $filteredtoRead[$i] = $item->getWorksId();
            }
        }
        $filteredtoRead = json_encode($filteredtoRead, JSON_UNESCAPED_SLASHES);
        return JsonResponse::fromJsonString(
            $filteredtoRead
        );
    }
}
