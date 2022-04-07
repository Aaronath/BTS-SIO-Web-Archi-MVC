````
   ___        _         _                                
  / _ \ _   _(_)_______(_)____                           
 | | | | | | | |_  /_  / |_  /                           
 | |_| | |_| | |/ / / /| |/ /                            
  \__\_\\__,_|_/___/___|_/___|         __  __ _          
 | __ )  __ _  ___| | __  / _ \ _ __  / _|/ _(_) ___ ___ 
 |  _ \ / _` |/ __| |/ / | | | | '_ \| |_| |_| |/ __/ _ \
 | |_) | (_| | (__|   <  | |_| | | | |  _|  _| | (_|  __/
 |____/ \__,_|\___|_|\_\  \___/|_| |_|_| |_| |_|\___\___|
                                                         
````
# BST-SIO-A-2022-Quizziz-Backend

### SETUP PROJET
Installation du projet
````
$ composer install
````

Mettre un fichier .env
````
$ cp .env-exemple .env
````

Demarrer ton projet
````
$ composer start
````


### DEV PROJET
En cas de création ou de mise a jour des classes du projet, faire la commande de autoloader
````
$ composer dump-autoload 
````

### DEV STACK
````
# Gestion Environnement
"vlucas/phpdotenv": "^5.4"
# Gestion de template (Couche MODEL)
"twig/twig": "^3.0"
# Gestion des controllers (Couche CONTROLLER)
"nikic/fast-route": "^1.3"
````