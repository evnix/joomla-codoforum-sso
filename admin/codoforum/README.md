CODOFORUM

 - Providing the best forum experience


Installation: 

1. Extract zip file
2. Go to http://path_to_codoforum/install

codoforum 1.2

TODO
====

 - Back to top button
 - ability to control options in menubar
 - allow to change logo link
 - Synchronized scrolling
 - Oembed using https://github.com/starfishmod/jquery-oembed-all
 - Vote up and down feature
 - Allow member titles/rank , reputation system
 - trust level for users
 - Allow Sticky topics
 - unread and read topics
 - Add polling feature
 - move topics between categories
 - allow to create new topic from "post" in same/different category
 - autocomplete username with @
 - allow tags
 - recent topics, similar topics, online members plugin
 - Replace handlebars with your own templating engine for better performance 

IN PROGRESS
===========


DONE
====
 - search feature
 - titles change with page 
 - added notification error class
 - added notification for user login error 
 - added notification for mail error
 - SSO for joomla
 - add super powerful favicon[frontend and backend]
 - increment profile views bug fixed
 - make the editor responsive 
 - change password 
 - forgot password feature
 - added meta generator

codoforum 1.1

DONE
====

 - SSO
 - Social sign in feature
 - breadcrumbs
 - builder
 - importer for drupal
 - Removed base tag -> solution
    - During editing replace with absolute urls . 
    - When saving make it relative then during output prepend again to make 
      absolute depending on domain path.


codoforum 1.0

DONE
====

 - skeleton framework
 - all basic features



LAST UPDATED Wed May 21 2014, 12:16

codoforum v1.2 released .

After completing all the basic features, we are now moving on to add some
advanced features. 

One of them is our new search feature . 

  Basic search parameters
 
   - -<Keywords>  To exculde a string from search  
   - category <Category names> To search in categories (comma separated)  
   - sort <Sort type>  
   - order <ASC/DESC>  
 
 
   But the actual search string can have
   
   1. "-" i.e exclude operator
   2. AND  make sure two or more keywords exist together
   3. OR   make sure any of these keywords exist
 
   for eg.  
    - dog -cat will search for "dog" not including "cat"
    - dog OR cat -bat will search for posts containing dog or cat but will exclude bat
    - dog AND cat -rat will search for posts containing dog and cat in the same post but exclude rat
 
   All other search parameters are provided as POST data for simplicity
 
   By default , when two search terms are separated by space i.e cat dog
   It is considered as AND . so cat dog rat is equivalent to cat AND dog AND rat

For advanced options, you can have a look at the file codoforum/sys/Lib/Search/Search.php

IMAGE

Following important changes have been made to the codoforum

 - titles change with page 
 - added notification error class
 - added notification for user login error 
 - added notification for mail error
 - SSO for joomla
 - add super powerful favicon[frontend and backend]
 - increment profile views bug fixed
 - make the editor responsive 
 - change password 
 - forgot password feature
 - added meta generator


