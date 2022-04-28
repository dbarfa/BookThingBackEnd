<?php

namespace App\Controller;

use App\DTO\ReadDTO;
use App\Entity\User;
use App\Mappers\ReadMappers;
use App\Repository\ReadRepository;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ReadController extends AbstractFOSRestController
{
    #[Post('/api/read/add', name: 'add_read')]
    #[View]
    #[ParamConverter('dto', converter: 'fos_rest.request_body')]
    #[IsGranted('ROLE_USER')]
    public function post(ReadDTO                $dto,
                         EntityManagerInterface $em,
                         ReadRepository         $readRepository
    )
    {
        /** @var  $user User */
        $user = $this->getUser();
        $read = ReadMappers::PostRead($dto, $user);
        $isInDB = $readRepository->findOneBy(['worksId' => $dto->getBook()]);
        if ($isInDB != null) {
            if (in_array($user, $isInDB->getUser()->toArray())) {
                throw new BadRequestHttpException();
            } else {
                $isInDB->addUser($user);
            }
        } else {
            $em->persist($read);
        }

        $em->flush();
        return;
    }

    #[Post('api/read/delete', name: 'delete_read')]
    #[View]
    #[ParamConverter('dto', converter: 'fos_rest.request_body')]
    #[IsGranted('ROLE_USER')]
    public function deletePost(ReadDTO                $dto,
                               ReadRepository         $readRepository,
                               EntityManagerInterface $em
    )
    {
        /** @var  $user User */
        $user = $this->getUser();
        $read = $readRepository->findOneBy(['worksId' => $dto->getBook()]);
        $read->removeUser($user);

        if (count($read->getUser()) == 0) {
            $em->remove($read);
        }
        $em->flush();

    }
}
