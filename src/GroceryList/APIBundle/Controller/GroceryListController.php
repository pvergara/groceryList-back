<?php

namespace GroceryList\APIBundle\Controller;

use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Util\Codes;
use GroceryList\APIBundle\Common\DTOs\VerySimpleDto;
use Symfony\Component\HttpFoundation\Response;

class GroceryListController extends FOSRestController
{
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
     * @param $entity
     * @return Response
     */
    public function respondsOk($entity)
    {
        $view = $this->view($entity, Codes::HTTP_OK);
        return $this->handleView($view);
    }

}
