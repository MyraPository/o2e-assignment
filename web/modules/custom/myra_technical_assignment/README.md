## INTRODUCTION

The Myra Technical Assignment module

The primary use case for this module is showing the results of two numbers
that are defined by a user in a form added together

## REQUIREMENTS

no dependencies (core modules only)

## INSTALLATION

Install as you would normally install a contributed Drupal module.

using drush: `drush en myra_technical_assignment`

See: https://www.drupal.org/node/895232 for further information.

The front page should redirect to the Controller-defined page
at /assignment.

## MAINTAINERS

Current maintainers for Drupal 10:

- MYRA RICHARDS 

## FACTORS AFFECTING MY SOLUTION

I decided to use a simple custom form to demonstrate the flexibillty of the services I implemented.
The translatable string output by the StringFormatter service is displayed by an ajax callback when
one or more of the fields have been filled out. Hitting enter or tab upon entering a value updates the sum.

The two input fields I reserved as unformated textfields (as opposed to enforcing a 'type' => 'number in
the field's attributes) for:
  - ability to use decimal places
  - ability to use scientific notation (ie. 4.5e6)
  - ability to handle numbers outside of the integer max/min

I decided to use ajax on the form for fast results and minimal processing.