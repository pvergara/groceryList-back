<?php
namespace GroceryList\APIBundle\Features\Context;


use Behat\Symfony2Extension\Context\KernelAwareContext;
use Doctrine\ORM\EntityManager;
use FOS\RestBundle\Util\Codes;
use GroceryList\APIBundle\Tests\Base\ServerIntegrationService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Bundle\FrameworkBundle\Client;

class FeatureContext extends \PHPUnit_Framework_TestCase implements KernelAwareContext
{
    /**
     * @var ServerIntegrationService
     */
    private $service;

    /**
     * @var KernelInterface
     */
    private $kernel;

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var Client
     */
    private $client;

    private $statusCodes;

    /**
     * @var Response|null A Response instance
     */
    private $response;


    public function __construct(Client $client, EntityManager $entityManager)
    {
        $this->client = $client;
        $this->entityManager = $entityManager;
        $this->initStatusCodes();
    }

    private function initStatusCodes()
    {
        $this->statusCodes = [
            "OK" => Codes::HTTP_OK,
            "CREATED" => Codes::HTTP_CREATED,
            "INTERNAL SERVER ERROR" => Codes::HTTP_INTERNAL_SERVER_ERROR,
            "NOT FOUND" => Codes::HTTP_NOT_FOUND,
            "BAD REQUEST" => Codes::HTTP_BAD_REQUEST,
            "FORBIDDEN" => Codes::HTTP_FORBIDDEN
        ];
    }

    /**
     * Sets Kernel instance.
     *
     * @param KernelInterface $kernel
     */
    public function setKernel(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
        if ($this->service === null)
            $this->service = new ServerIntegrationService($this->kernel, $this->client, $this->entityManager);
    }

    /**
     * @Given /^Nothing special$/
     */
    public function nothingSpecial()
    {
    }

    /**
     * @When /^I navigate to the get grocery lists endpoint$/
     */
    public function iNavigateToTheGetGroceryListsEndpoint()
    {
        $this->client->request("GET", "/api/groceryLists.json");
        $this->response = $this->client->getResponse();
    }

    /**
     * @Then /^The endpoint returns me "([^"]*)" as status code$/
     * @param $statusCode
     */
    public function theEndpointReturnsMeAsStatusCode($statusCode)
    {
        $this->assertEquals($this->statusCodes[strtoupper($statusCode)], $this->response->getStatusCode());
    }
}