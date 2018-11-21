<strong>Installation</strong>

<strong>Step 1</strong>

Clone git repository

<i>git clone https://github.com/joashgomba/elogframe.git</i>

Go to the project folder

<i>cd elogframe</i>

Update composer

<i>composer update</i>

<strong>Step 2</strong>

Copy <i>.env.example</i> file to <i>.env</i>

For Unix

<i>cp .env.example .env</i>

For Windows

<i>copy .env.example .env</i>

And then, run this commands

<i>php artisan key:generate</i>

Create your database and configure your .env file and run :

<i>php artisan migrate</i>

Run database seed

<i>php artisan db:seed</i>

<strong>You are good to go!!!!!!</strong>
