Feature: create the first new item
  As anonymous user
  I want to add MY FIRST new item on a grocery list
  In order to create a new (and automatic) list and add the item to that list

Scenario: Anonymous user adding the first grocery list item
  Given "rice" as MY FIRST item to add to my list
  When I ask to add that item
  Then The endpoint returns me "CREATED" as status code
  And It returns me a token to add the next item to that list
  And It returns me the name of the list
