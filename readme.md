## Alex's Playing Cards App

## Basic Info 

Simple card shuffling and dealing app.
 
![Screen Shot](https://abuchholz.github.io/playing-cards/public/assets/images/screenshot.png)

## Dependencies
* Ant 1.9 or higher
* Docker 17.06 or higher
* Docker Compose 1.14 or higher

## Getting Started

1. Create .env and .env.testing files from the examples
2. Fill in all variables other than `APP_KEY`. That will be set automatically.
   - Make sure to set all port variables with unused ports on your machine. There are examples set for you but those might be in use 
3. Build and run docker containers: `ant docker`
4. Initialize Project Code and Database: `ant init`
5. Make sure `SITE_DOMAIN` and `TEST_DOMAIN` point to your machine

## Tests

Once the site is configured run test suite to make sure everything is working: `ant tests`

## TODOs

* Probably move shuffle and deal calls into ajax and remove socket functionality. Fancy, but laggy
* Add JavaScript tests
* Add callback functionality to listeners. Maybe add some 
* Add ability to play an actual game, like blackjack  

## Shout Outs

This tool was built off of a number of different libraries. Here are a few:
* [Laravel](https://github.com/laravel/laravel) 
* [Deck Of Cards](https://github.com/pakastin/deck-of-cards) 
* [RequireJs](https://github.com/requirejs/requirejs)
* [Laradock Docker Containers](https://github.com/laradock/laradock) 