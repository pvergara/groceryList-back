<?php

namespace GroceryList\APIBundle\Controller;

use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Util\Codes;
use GroceryList\APIBundle\Common\ApplicationServices\ListAppService;
use GroceryList\APIBundle\Common\DTOs\FirstItemDto;
use GroceryList\APIBundle\Common\DTOs\VerySimpleDto;
use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GroceryListController extends FOSRestController
{
    /**
     * @DI\Inject("grocerylist.app_services.list")
     * @var ListAppService $listService
     */
    private $listService;



    /**
     * @Get("/groceryLists")
     *
     * @return Response
     */
    public function getGroceryListsAction()
    {
        $data = new VerySimpleDto();
        $data->setResponse("What's up dude!!!!");

        return $this->respondsOk($data);

    }

    /**
     * @Post("/lists/automatic/firstItem")
     *
     * @param Request $request
     * @return Response
     */
    public function postAutomaticFirstItemAction(Request $request)
    {
        /** @var ParameterBag $request */
        /** @noinspection PhpUndefinedFieldInspection */
        $request = $request->request;

        /** @var FirstItemDto $response */
        $response = $this->listService->createNewAutomaticListWith($request);
        return $this->respondsCreated($response);
    }

    /**
     * @param $entity
     * @return Response
     */
    public function respondsOk($entity)
    {
        $view = $this->view($entity, Codes::HTTP_OK);
        return $this->handleView($view);
    }

    private function respondsCreated($entity)
    {
        $view = $this->view($entity, Codes::HTTP_CREATED);
        return $this->handleView($view);
    }

}
