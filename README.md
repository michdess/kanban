# Kanban
An implementation of some kanban boards.
It uses Laravel for the backend, VueJS for the frontend and TailwindCSS for the styling.
## Installation:
* Git clone
* CD into directory
`composer install`
* Create .env file
`cp .env.example .env`
* Edit the .env file and add your database credentials (you will need to have made a database for the project to use)
* Generate the application key
`php artisan key:generate`
* migrate the database
`php artisan migrate`
* install node dependencies
`npm install`
* Compile Assets
`npm run dev`
* Register, Login and start using the boards!

## Tests
The endpoints have been driven out using TDD and all tests can be found in the tests folder. They can be run using phpunit.

