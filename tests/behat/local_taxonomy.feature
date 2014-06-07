@local @local_taxonomy
Feature: Index
  In order to manage Vocabulary Lists
  As admin
  I need to access taxonomy



  @javascript
  Scenario: Simple Access to Vocabulary List 
    Given I log in as "admin"
    And I navigate to "Taxonomy" node in "Site administration"
    Then I should see "Vocabulary"
    And I should see "Add new vocabulary"

  @javascript
  Scenario: Create a new Vocabulary List
    Given I log in as "admin"
    When I navigate to "Taxonomy" node in "Site administration"
    And I follow "Add new vocabulary"
    And I set the field "name" to "vocabulary1"
    And I set the field "shortname" to "voc1"
    And I set the field "description" to "description of vocabulary 1"
    And I set the field "weight" to "-48"
    And I press "submitbutton"
    Then I should see "Vocabulary"
    And I should see "vocabulary1"
    And I should see "description of vocabulary 1"
    And I should see "-48"
    And I should see "Modify"
    And I should see "Delete"

  @javascript
  Scenario: Delete a Vocabulary List
    Given I log in as "admin"
    When I navigate to "Taxonomy" node in "Site administration"
    And I follow "Add new vocabulary"
    And I set the field "name" to "vocabulary1"
    And I set the field "shortname" to "voc1"
    And I set the field "description" to "description of vocabulary 1"
    And I set the field "weight" to "-48"
    And I press "submitbutton"
    And I follow "Delete"
    And I press "Continue"
    Then I should see "Deleting voc1"

  @javascript
  Scenario: modify a vocabulary list
    Given I log in as "admin"
    When I navigate to "Taxonomy" node in "Site administration"
    And I follow "Add new vocabulary"
    And I set the field "name" to "vocabulary1"
    And I set the field "shortname" to "voc1"
    And I set the field "description" to "description of vocabulary 1"
    And I set the field "weight" to "-48"
    And I press "submitbutton"
    And I follow "Modify"
    And I set the field "weight" to "10"
    And I press "submitbutton"
    Then I should see "Vocabulary"
    And I should see "vocabulary1"
    And I should see "description of vocabulary 1"
    And I should see "10"


  @javascript
  Scenario: access term list
    Given I log in as "admin"
    When I navigate to "Taxonomy" node in "Site administration"
    And I follow "Add new vocabulary"
    And I set the field "name" to "vocabulary1"
    And I set the field "shortname" to "voc1"
    And I press "submitbutton"
    And I follow "vocabulary1"
    Then I should see "Term not found"
    And I should see "Add new term"

  @javascript
  Scenario: add one term to a vocabulary
    Given I log in as "admin"
    When I navigate to "Taxonomy" node in "Site administration"
    And I follow "Add new vocabulary"
    And I set the field "name" to "vocabulary1"
    And I set the field "shortname" to "voc1"
    And I press "submitbutton"
    And I follow "vocabulary1"
    And I follow "Add new term"
    And I set the field "name" to "term 1"
    And I set the field "shortname" to "term1"
    And I set the field "description" to "description of term 1"
    And I set the field "weight" to "-48"
    And I press "submitbutton"
    Then I should see "term 1"
    And I should see "description of term 1"

  @javascript
  Scenario: try to add one term but forget to fill shortname
    Given I log in as "admin"
    When I navigate to "Taxonomy" node in "Site administration"
    And I follow "Add new vocabulary"
    And I set the field "name" to "vocabulary1"
    And I set the field "shortname" to "voc1"
    And I press "submitbutton"
    And I follow "vocabulary1"
    And I follow "Add new term"
    And I set the field "name" to "term 1"
    And I press "submitbutton"
    Then I should see "Error"

  @javascript
  Scenario: Delete a term
    Given I log in as "admin"
    When I navigate to "Taxonomy" node in "Site administration"
    And I follow "Add new vocabulary"
    And I set the field "name" to "vocabulary1"
    And I set the field "shortname" to "voc1"
    And I press "submitbutton"
    And I follow "vocabulary1"
    And I follow "Add new term"
    And I set the field "name" to "term 1"
    And I set the field "shortname" to "term1"
    And I press "submitbutton"
    And I follow "Delete"
    And I press "Continue"
    Then I should see "Deleting term1"

