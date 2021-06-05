# wp-theme-college

## Let's create a full college wordpress theme with the following features

* Custom Page templates 
* Custom Front Page
* Custom Single pages for custom post types
* Custom Archive Pages for custom post types
* Header.php
* Footer.php
* Template Parts
* Custom Blog Page
* Custom Post Types (via code or CPT UI plugin)
* Custom Field (via code for Advanced Custom Field plugin)

## Custom Post Types

* Academic Programs
* Professors
* Events
* Campus

## Relationship between Post Types
* Program
  * Has one or more related Professors
  * Has one or more realted Events
* Events
  * Has one or more related program
* Professors
  * Has one or more related programs (subjects taught)
* Campuses
  * Has one or more realted program(s)


### Custom Queries
* Custom query for displaying most recent post on a custom front page
* Custom query for displaying custom field (ACF) on custom front page 

