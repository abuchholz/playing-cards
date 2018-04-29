## Alex's Deck of Cards App

Playing card shuffling and dealing app.

![Screen Shot](https://abuchholz.github.io/playing-cards/public/assets/images/screenshot.png)

## Key Features 

* **Shuffle**: reorders the deck of cards and stacks the on the left
* **Deal one card**: deals one card off the top of the deck
* **Deal all cards**: deals all the cards left in the deck at once
* **Scatter**:  Spreads the cards face up on the table
* **Coming soon (TBD)**: Two person live action Blackjack using web sockets


## Dependencies
* Ant 1.9 or higher
  - Note, if you do not have Ant installed, look at the build.xml file for all the commands that are required in the following steps. Having Ant installed will make initializing and running the site much easier.
* Docker 17.06 or higher
* Docker Compose 1.14 or higher

## Getting Started

1. Create .env and .env.testing files from the examples by running the following: 


   `cp .env.example .env; cp .env.testing.example .env.testing;`

2. Fill in all variables other than `APP_KEY`. That will be set automatically.
   - Make sure to set all port variables with unused ports on your machine. There are examples set for you but those might be in use. Docker will fail to boot if that is the case. Just change the ports and it should work fine.
3. Build and run docker containers. Note that this might take a few minutes if this is the first time you are downloading and running the containers utilized in this project: 


    `ant docker`

4. Initialize Project Code and Database. This will set permissions, run composer, run yarn (npm dependencies), generate APP_KEYs in .env and .env.testing, and initialize your databases. To do this, run the following command. Note that this might take a few minutes: 


    `ant init`
    
5. Make sure `SITE_DOMAIN` and `TEST_DOMAIN` point to your machine, e.g. point `cards.loc` and cards.test to `127.0.0.1` in your `/etc/hosts` file
6. For good measure, let's reboot the docker containers to make sure nothing got stuck. Note that this is a helpful command if you don't see the cards shuffle or see other issues:

 
    `ant docker-reboot`
    
7. To access the site replace your .env values in `http://SITE_DOMAIN:CONTAINER_NGINX_PORT_80X`, e.g. `http://cards.loc:801`
8. Once you are done checking out the app, let's shut everything down. You can run `ant docker-boot` to start things back up!


    `ant docker-down`
     

## Tests

Once the site is configured run test suite to make sure everything is working: 

    `ant tests`
    
Code coverage can be found here: `/tests/_output/coverage/index.html`

## TODOs

* Fix Acceptance Test
* Finish two player game that takes advantage of sockets, like blackjack
* Add JavaScript tests
* Add callback functionality to listeners. 
* Store and display statistics on shuffling on homepage  

## Shout Outs

This tool was built off of a number of different libraries. Here are a few:
* Myself! Took some of this code from a few earlier pet projects 
* [Laravel](https://github.com/laravel/laravel) 
* [Deck Of Cards](https://github.com/pakastin/deck-of-cards) 
* [RequireJs](https://github.com/requirejs/requirejs)
* [Laradock Docker Containers](https://github.com/laradock/laradock) 