<?php
namespace GroceryList\APIBundle\Common\DTOs;


class FirstItemDto
{
    /**
     * @var string
     */
    private $token;
    /**
     * @var string
     */
    private $listName;

    /**
     * FirstItemDto constructor.
     * @param string $token
     * @param string $listName
     */
    public function __construct($token, $listName)
    {
        $this->token = $token;
        $this->listName = $listName;
    }
}