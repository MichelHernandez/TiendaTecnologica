Feature: Registro

  Scenario: As a user, I can create an user account.

  Given I am on the "register" page
  When I sign in with "<name>", "<email>", "<password>" and "<password_confirmation>"
  Then I should see a message saying "<message>"

  Examples:
    | name | email | password | password_confirmation | message |
    | michel | michel@email.com | 123456789 | 123456789 | ¡Bienvenido! |
    | Anna | Anna@gmail.com | 123456789 | 123456789 | ¡Bienvenido! |
