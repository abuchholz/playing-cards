Feature: Any user can go to the home page and deal one card

  Scenario: User deals one card
    Given I am on the homepage
      And I click "Start"
      And The cards are in a certain order
    When I click "Deal One Card"
    Then I should see a random card
