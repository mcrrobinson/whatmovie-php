# whatmovie-php

An old PHP movie-recommendation website (circa 2020) that lets users browse and search for movies and TV shows and view ranked recommendations, backed by a MySQL database.

## Tech stack

- PHP (server-side pages, e.g. `index.php`, `browse.php`, `search.php`, `movie.php`)
- MySQL (schema and data in `whatmovi_project.sql`)
- jQuery / JavaScript and CSS for the frontend (`src/js`, `src/css`, `style.css`)

## Setup

1. Import the database dump into MySQL:
   ```
   mysql -u <user> -p <database> < whatmovi_project.sql
   ```
2. Configure the database credentials in `src/dbc.php`.
3. Serve the `src/` directory with a PHP-capable web server (e.g. Apache with PHP, or `php -S localhost:8000 -t src`).

## Status

Archived and no longer maintained. Superseded by [whatmovie-js](https://github.com/mcrrobinson/whatmovie-js).
