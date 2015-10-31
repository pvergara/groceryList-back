<?php
namespace GroceryList\APIBundle\Common\ApplicationServices;


use GroceryList\APIBundle\Common\DTOs\FirstItemDto;


class ListAppService
{

    /**
     * @param \Symfony\Component\HttpFoundation\ParameterBag $request
     * @return FirstItemDto
     */
    public function createNewAutomaticListWith($request)
    {
        /** @var array $parameters */
        $parameters = $request->all();
//        $item = $parameters["item"];

//        $token = $this->serviceHandler->generateNewToken();

        return new FirstItemDto("token","listName");
    }
}