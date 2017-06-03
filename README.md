# Localhost Dashbard
A PHP dashboard for organizing project links. It should appear when you navigate to http://localhost, or wherever in the web root you place these files.

![Dashboard](Dashboard.png)

To create the dashboard:

- copy the config.example.yml to config.yml and adjust it with your desired links. 
- Copy config.example.php to config.php and make any adjustments needed to alter the array created by the YAML file. The example adds dynamic ports to the Docker links by parsing the `docker ps` command.
- Make sure to add something like the following in the ```<Directory>``` configuration for apache so it will read the php file:

```
DirectoryIndex index.php
```

The config file is a YAML file that depicts an array of arrays. Each item on the dashboard is expressed by the information in the config array.

- The first key is the name of the link collection, like 'MY Site'.
- The arrays below that are separated into an array of production links, and an array of local or development links. The difference is the class added to the links, production links will display with a dark background.
- Each link can be either a string url value (the link text will be the domain name of the url), or an array of link text and url.
- If the link contains port information, i.e. localhost:8080, the port will display in the text.
- The link can contain user and pass information for http protected environments, i.e. http://user:pass@mysite.com. The link will be constructed with this information, your mileage may vary since not all browsers support that.
- The config.php file contains an example of finding a dynamically-created port for a docker container-