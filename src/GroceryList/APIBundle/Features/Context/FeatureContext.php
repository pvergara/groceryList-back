<?php
namespace GroceryList\APIBundle\Features\Context;


use Behat\Symfony2Extension\Context\KernelAwareContext;
use Doctrine\ORM\EntityManager;
use FOS\RestBundle\Util\Codes;
use GroceryList\APIBundle\Tests\Base\ServerIntegrationService;
use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;

class FeatureContext extends \PHPUnit_Framework_TestCase implements KernelAwareContext
{
    /**
     * @var array
     */
    private $jsonHeaders = array(
        'CONTENT_TYPE' => 'application/json',
    );

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

    private $itemToAdd;

    /**
     * @var array
     */
    private $contentAsAssocArray;


    /** @noinspection PhpMissingParentConstructorInspection
     * @param Client $client
     * @param EntityManager $entityManager
     */
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

    /**
     * @Given /^"([^"]*)" as MY FIRST item to add to my list$/
     * @param $item
     */
    public function asMYFIRSTItemToAddToMyList($item)
    {
        $this->itemToAdd=$item;
    }

    /**
     * @When /^I ask to add that item$/
     */
    public function iAskToAddThatItem()
    {
        $dataToSend = json_encode([
            "item" => $this->itemToAdd
        ]);

        //Action
        $this->client->request('POST', '/api/lists/automatic/firstItem.json', array(), array(),
            $this->jsonHeaders,
            $dataToSend);

        /** @var Response $response */
        $this->response = $this->client->getResponse();
        $this->contentAsAssocArray = json_decode($this->response->getContent(), true);
    }

    /**
     * @Given /^It returns me a token to add the next item to that list$/
     */
    public function itReturnsMeATokenToAddTheNextItemToThatList()
    {
        $this->assertNotNull($this->contentAsAssocArray["token"]);
    }

    /**
     * @Given /^It returns me the name of the list$/
     */
    public function itReturnsMeTheNameOfTheList()
    {
        $this->assertNotNull($this->contentAsAssocArray["list_name"]);
    }

}