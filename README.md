# A Simple Project Manger Built with TALL Stack

## Setup Guide
- CLone this repository
- in your terminal and in the cloned project directory run:
    - `composer install` to install PHP dependencies
    - `npm install && npm run build` to install and build frontend assets
- copy over the example .env file so you can update to yous system settings: `cp .env.example .env`
- setup a MySQL database and update the `.env` file accordingly
- Your set to get started

## Usage Guide
- start up a local webserver with `php artisan serve` and open the displayed URL in your browser
- You can use the Register/Login links to register or login to the app.
- Once logged in, you can add projects, edit or delete them
- You are able to update the status of projects by dragging the project card at the project title across the various
status boards (Pending - default, In Progress and Completed)
- You may run the test suite with `vendor/bin/pest`

## Screencast
[Watch](https://drive.google.com/file/d/1W-Sz_x87M4phSLMw_y0RdAlYkoMOUY7j/view?usp=sharing)

## Implementation Overview
The Project Manager is built a a separate module with the help of
(Laravel Modules)[https://laravelmodules.com/]
