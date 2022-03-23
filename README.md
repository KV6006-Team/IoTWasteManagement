# IoT Waste Management Solution
~~~

### Concept
~~~
Using Esp8266 devices with force sensors to be placed at the bottom of Bins, connected to a network.
These devices then connect to an Express Backend that takes the GET requests with force data as a parameter.
From that the express server uploads it to a MySql server.
A PHP middlewear solution then gets the sensor information from the database.
This middlewear is then used in an AJAX script running on the frontend that uses it in a fetch request to get the data.
This data is then displayed and colour coded on a page using JQuery and PHP
