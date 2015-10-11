<?php
namespace GroceryList\APIBundle\Tests\Base;


use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Component\HttpKernel\KernelInterface;

class ServerIntegrationService
{
    /**
     * @var KernelInterface
     */
    private $kernel;

    /**
     * @var Client
     */
    private $client;

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * ServerIntegrationService constructor.
     * @param $kernel
     * @param $client
     * @param $entityManager
     */
    public function __construct($kernel, $client, $entityManager)
    {
        $this->kernel = $kernel;
        $this->client = $client;
        $this->entityManager = $entityManager;
    }
}