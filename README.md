# Convertedin Task

This is the repository for the Convertedin task. It includes the necessary code and instructions to set up and run the project.

## Getting Started

### Prerequisites

Make sure you have Docker installed on your machine.

### Installation
1. Clone the repository: 

    shell 
    ```git clone https://github.com/Amro404/convertedin-task```
   
2. Change into the project directory:
   
    shell 
    ```cd convertedin-task```
   
3. Build the Docker containers:
   
shell ```sh ./start.sh``` this command will do the following

1. build up the containers
2. install composer & npm dependencies
3. migrate the database and seed the data needed
4. run the tests

##### Note: make sure the port ```90``` is free

##

#### The project has 3 main pages with the following routes:

1. Create a task for user page ```/admin/tasks/create```  ```GET```
2. Tasks list page ```/admin/users/tasks``` ```GET```
3. The statistics page ```/admin/users/tasks/statistics``` ```GET```
##
and one route for persist the task in the DB <br>
4. Store the task ```/admin/tasks/create```  ```POST```
##

#### Most of the business core logic will be under the following directories:

in the ```src``` directory:

```\app\Http\Controllers``` <br>
```\app\Repositories``` <br>
```\app\Services```<br>
```\app\Console\Commands```<br>
```\app\Http\Requests```<br>
```\app\Jobs```<br>
```\app\resources\views\admin```<br>

##
also, you can set up the database and seed it with testing data, run the following command:
shell
``` docker-compose run --rm artisan migrate:fresh --seed ```
## Tests
To run all unit tests, use the following command:
shell
``` docker-compose run --rm php vendor/bin/phpunit ```