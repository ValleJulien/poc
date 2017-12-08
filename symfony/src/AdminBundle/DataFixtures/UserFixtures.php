<?php

namespace AdminBundle\DataFixtures;

use AdminBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture implements ContainerAwareInterface, OrderedFixtureInterface

{
    private $container;

    private $encoder;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $data = array();

        // admin user
        $userAdmin = new User();
        $userAdmin->setUsernameCanonical('admin');
        $userAdmin->setUsername('admin');
        $userAdmin->setEmailCanonical('admin@novaway.dev');
        $userAdmin->setEmail('admin@novaway.dev');
        $adminPwd = $this->encoder->encodePassword($userAdmin, 'admin');
        $userAdmin->setPassword($adminPwd);
        $userAdmin->addRole('ROLE_SUPER_ADMIN');
        $userAdmin->setEnabled(true);

        // editor user
        $editorUser = new User();
        $editorUser->setUsernameCanonical('editor');
        $editorUser->setUsername('editor');
        $editorUser->setEmailCanonical('editor@novaway.dev');
        $editorUser->setEmail('editor@novaway.dev');
        $editorPwd = $this->encoder->encodePassword($editorUser, 'editor');
        $editorUser->setPassword($editorPwd);
        $editorUser->addRole('ROLE_EDITOR');
        $editorUser->setEnabled(true);

        $userManager = $this->container->get('fos_user.user_manager');

        array_push($data, $userAdmin, $editorUser);

        foreach ($data as $user ) {
            if (!$userManager->findUserByUsername($user->getUsername() ) ) {
                $manager->persist($user);
                $manager->flush();
                echo 'INFO-LOG: user for  '.$user->getUsername().' is persisted !'."\r\n";
            } else {
                echo 'INFO-LOG: user already EXIST for '.$user->getUsername()."\r\n";
            }
        }
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 1;
    }
}