@local @local_taxonomy
Feature: Index
  In order to see Vocabulary Lists
  As admin
  I need to access index.php file
  
  @javascript
  Scenario: Simple Access to Vocabulary List 
    Given I log in as "admin"
    And I navigate to "Taxonomy" node in "Site administration"
    Then I should see "Vocabulary"
    And I should see "Add new vocabulary"

  @javascript
  Scenario: Create a new Vocabulary List
    Given I log in as "admin"
    And I navigate to "Taxonomy" node in "Site administration"
    And I follow "Add new vocabulary"
    And I set the field "name" to "vocabulary1"
    And I set the field "shortname" to "voc1"
    And I set the field "description" to "description of vocabulary 1"
    And I press "submitbutton"
    Then I should see "Vocabulary"
    And I should see "vocabulary1"
    And I should see "description of vocabulary 1"