<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Service\Avatar\SvgAvatarFactory;
use App\Service\Helpers\FileSystemHelper;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Provider\DateTime;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends BaseFixture implements DependentFixtureInterface
{
    private $fileSystemHelper;
    private $svgAvatarFactory;
    private $uploadPath;
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    public function getDependencies()
    {
        // TODO: Implement getDependencies() method.
        return [
            PromotionFixtures::class
        ];

    }

    public function load(ObjectManager $manager)
    {

        // $product = new Product();
        // $manager->persist($product);
        $faker = Factory::create();

        $admin = new User();
        $admin->setFirstname("Romain");
        $admin->setLastname('Bassoni');
        $admin->setEmail('r.bassoni@laposte.net');
        $passwordHashed= $this->passwordEncoder->encodePassword($admin, 'admin');
        $admin->setPassword($passwordHashed);

        $admin->setCity('Trets');
        $admin->setBirthdate(new \DateTime('1988-05-01'));

        // partie generation avatar
        $svg = $this->svgAvatarFactory->getAvatar(2,5);
        $fileName = sha1(uniqid(rand())).'.svg';
        $filePath = $this->uploadPath.'/'.SvgAvatarFactory::AVATAR_DIR.'/'.$fileName;
        $this->fileSystemHelper->write($filePath, $svg);
        $admin->setAvatar($fileName);
        $admin->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);



        for ($i=0; $i <200; $i++){
            // partie generation d'utilisateur fake
            $user = new User();
            $user->setFirstname($faker->firstName);
            $user->setLastname($faker->lastName);
            $user->setEmail($faker->email);
            $user->setPassword(password_hash($faker->password,PASSWORD_DEFAULT));
            $user->setCity($faker->city);
            $user->setBirthdate(new \DateTime(rand(1930,2000) .'-' .$faker->month .'-' .$faker->dayOfMonth));


            $promotions=$this->getReferences('Promotion');
            $promos = $faker->randomElements($promotions, rand(1,2));

            foreach ($promos as $promo){
                $user->addPromotion($promo);
            }

            // partie generation avatar
            $svg = $this->svgAvatarFactory->getAvatar(2,5);
            $fileName = sha1(uniqid(rand())).'.svg';
            $filePath = $this->uploadPath.'/'.SvgAvatarFactory::AVATAR_DIR.'/'.$fileName;
            $this->fileSystemHelper->write($filePath, $svg);
            $user->setAvatar($fileName);
            $manager->persist($user);
        }

        $manager->flush();
    }

    public function __construct(SvgAvatarFactory $svgAvatarFactory, FileSystemHelper $fileSystemHelper ,UserPasswordEncoderInterface $passwordEncoder, $uploadPath)
    {
        parent::__construct();
        $this->uploadPath = $uploadPath;
        $this->svgAvatarFactory = $svgAvatarFactory;
        $this->fileSystemHelper = $fileSystemHelper;
        $this->passwordEncoder = $passwordEncoder;
    }

}
