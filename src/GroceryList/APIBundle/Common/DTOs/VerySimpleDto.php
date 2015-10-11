<?php
namespace GroceryList\APIBundle\Common\DTOs;


class VerySimpleDto
{
    private $response;
    /**
     * Hola constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param mixed $response
     * @return VerySimpleDto
     */
    public function setResponse($response)
    {
        $this->response = $response;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }
}