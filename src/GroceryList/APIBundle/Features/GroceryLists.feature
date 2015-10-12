Feature: GetGroceryLists
  As anon user
  I can get all public groceryLists
  In order to know it

  Scenario: Anonymous user accessing the all public grocery lists
    Given Nothing special
    When I navigate to the get grocery lists endpoint
    Then The endpoint returns me "Ok" as status code