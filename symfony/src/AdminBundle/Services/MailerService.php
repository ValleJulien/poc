<?php

namespace AdminBundle\Services;

use Symfony\Component\Form\Tests\Fixtures\Author;
use Symfony\Component\Routing\Router;
use Symfony\Component\Templating\EngineInterface; //in order to use email templating
use Symfony\Component\DependencyInjection\Container;

use AdminBundle\Entity\User;
use AdminBundle\Entity\Book;


/**
 * Class MailerService
 * @package AdminBundle\Services
 */
class MailerService
{

    /**
     * @var
     */
    protected $mailer;

    /**
     * @var EngineInterface
     */
    protected $templating;

    /**
     * @var Router
     */
    protected $router;

    /**
     * @var Container
     */
    protected $container;

    /**
     * @var mixed
     */
    private $from;

    /**
     * @var string
     */
    private $name = 'L\'équipe de Novaway Test'; // name of email sender


    /**
     * MailerService constructor.
     * @param \Swift_Mailer $mailer
     * @param EngineInterface $templating
     * @param Router $router
     * @param Container $container
     * @param String $from
     */
    public function __construct( \Swift_Mailer $mailer, EngineInterface $templating, Router $router, Container $container, String $from)
    {
        $this->mailer = $mailer;
        $this->templating = $templating;
        $this->router = $router;
        $this->container= $container;
        $this->from = $this->container->getParameter('mailer_user');
    }


    /**
     * @param String $to
     * @param String $subject
     * @param String $body
     * @param User $user
     */
    protected function sendMessage(String $to, String $subject, String $body, User $user, Author $author, $alert)
    {
        $subject = "Un livre de l'auteur ".$author."est disponible !";
        // swif mailer method as new instance
        $mail = \Swift_Message::newInstance();
        // set template
        $template = 'AdminBundle:emails:notifyUser.html.twig';
        // set up email configuration
        $mail
            ->setFrom(array($this->from => $this->name))
            ->setTo($to)
            ->setSubject($subject)
            ->setBody($body)
            ->setReplyTo(array($this->reply => $this->name))
            ->setCharset('utf-8')
            ->setContentType('text/html');
        // send email
        $this->mailer->send($mail);
    }
}