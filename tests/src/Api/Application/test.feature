Feature:
  In order to prove that the Behat Symfony extension is correctly installed
  As a user
  I want to have a demo scenario

  Scenario: It receives a response from Symfony's kernel
    Given the Request body is:
    """
    {
    }
    """
    When i GET to "http://localhost:8080/api/doc"
    Then the response code is 200
