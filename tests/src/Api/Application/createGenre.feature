Feature:
  In order to prove that the Behat Symfony extension is correctly installed
  As a user
  I want to have a demo scenario

  Scenario: It receives a response from Symfony's kernel
    Given the Request body is:
    """
    {
      "genre": [
        {
          "id": "b026b3f4-be48-11eb-8529-0242ac130003",
          "name": "Rock"
        }
      ]
    }
    """
    When i PUT to "http://localhost:8080/api/genre/add"
    Then the response code is 200
