<?php
namespace GroceryList\APIBundle\Common\ApplicationServices;


use GroceryList\APIBundle\Common\DTOs\FirstItemDto;
use JMS\DiExtraBundle\Annotation\Service;


/**
 * Class ListAppService
 * @package GroceryList\APIBundle\Common\ApplicationServices
 * @Service("grocerylist.app_services.list")
 */
class ListAppService
{
    /**
     * @param \Symfony\Component\HttpFoundation\ParameterBag $request
     * @return FirstItemDto
     */
    public function createNewAutomaticListWith(/** @noinspection PhpUnusedParameterInspection */
        $request)
    {
//        /** @var array $parameters */
//        $parameters = $request->all();
//        $item = $parameters["item"];

//        $token = $this->applicationService->generateNewToken();

        return new FirstItemDto("token","listName");
    }
}