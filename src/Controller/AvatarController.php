<?php


namespace App\Controller;



use App\Service\Avatar\SvgAvatarFactory;
use App\Service\Helpers\FileSystemHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class AvatarController extends AbstractController
{
    private $svgAvatarFactory;
    private $fileSystemHelper;

    public function __construct(SvgAvatarFactory $svgAvatarFactory,FileSystemHelper $fileSystemHelper)
    {
        $this->svgAvatarFactory = $svgAvatarFactory;
        $this->fileSystemHelper = $fileSystemHelper;
    }

    /**
    * @Route("/avatar",name="avatar.get")
    */
    public function getAvatar($uploadDir)
    {
        $svg= $this->svgAvatarFactory->getAvatar(2,5);
        $fileName = sha1(uniqid(rand())). '.svg';
        $filePath = $uploadDir.'/'.SvgAvatarFactory::AVATAR_DIR .$fileName;
        $this->fileSystemHelper->write($filePath , $svg);
        return $this->render('avatar.html.twig', ['filename'=>$fileName]);
    }


    public function generateAjaxAvatar($uploadDir){

        $svg= $this->svgAvatarFactory->getAvatar(2,5);
        $fileName = sha1(uniqid(rand())). '.svg';
        $filePath = $uploadDir.'/'.SvgAvatarFactory::AVATAR_DIR .$fileName;
        $this->fileSystemHelper->write($filePath , $svg);

        return $this->json($fileName);
    }


}