# WordPress
this repository for a assesment task for iconic

tasks::
  Please setup a Blank WordPress project

2.      Do initial commit of blank project on a GitHub repository (Just push wp-content/plugins and wp-content/themes Folders)

this repository has first commit of plugin and theme folders
3.      Write a function that will redirect the user away from the site if their IP address starts with 77.29. Use WordPress native hooks and APIs to handle this.

     Ans:   this code is written in ikonictask.php which is included in functions.php of child theme of astra.
4.      Register post type called "Projects" and a taxonomy "Project Type" for this post type.

     Ans:      this code is written in ikonictask.php which is included in functions.php of child theme of astra.
5.      Create a WordPress archive page that displays six Projects per page with pagination. Simple pagination is enough (with next, prev buttons)

  Ans:  to add a template for projects post type there is a file called archive-projects.php which includes the code for above task,
6.      Create an Ajax endpoint that will output the last three published "Projects" that belong in the "Project Type" called "Architecture" If the user is not logged in. If the user is logged In it should return the last six published "Projects" in the project type call. "Architecture". Results should be returned in the following JSON format {success: true, data: [{object}, {object}, {object}, {object}, {object}]}. The object should contain three properties (id, title, link).

 Ans:      i have showcased the data in console .
7.      Use the WordPress HTTP API to create a function called hs_give_me_coffee() that will return a direct link to a cup of coffee. for us using the Random Coffee API [JSON].

   Ans:      admin will get email of the link
8.      Use this API https://api.kanye.rest/ and show 5 quotes on a page.

Ans: also created template for this task file name **kanye-quotes-template.php**
