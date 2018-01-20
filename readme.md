# PHP MVC Framework
    Built on top of TraversyMVC Framework

## Features
* **M**odel **V**iew **C**ontroller workflow
* Default database connection with ``mysqli`` objects
* **Autoloading dependencies** through ``composer``
* ``PHPUnit`` included for **unit testing**
* ``SASS`` compliation enabled
* Basic **grid layout system** included - ``app/assets/scss/grid.scss``
* Router available

## Set Up
* ``composer install`` for initiating PHPUnit for unit testing
* Go to ``config/config.php`` to set up database/site configuration

## SASS Compilation
* In your project root directory, open terminal and do ``sass --watch app/assets/scss/app.scss:public/css/app.css``

## Routing
* Unmatched urls will be redirected to the home page
* Register routes in ``app/routes.php``
```php
    $router->get('/posts','PostController@index');
```
* Callback is also supported
```php
    $router->get('/example', function() {
        $data = ['name'=>'John Doe'];
        view('pages/example', $data);
    });
```
* Parameters are only supported as numbers for now
```php
    $router->get('/example/:id', function($id) {
        view('pages/example', ['id'=>$id]);
    });
```

## Controllers
* Default controller - ``app/controllers/PageController.php``
* Creating new controllers
    * Please follow the naming convention
        > Ex 1) Controller for user model - UserController.php
    * Include your model in the constructor of the controller
        * In your controller class file
        * ```php
            public __construct() {
                parent::__construct();
                $this->userModel = $this->model('User');
            }
          ```
        * You can include more than one model

## Models
* Default Methods
    * ``Model->all();`` returns all records of the model as an array of objects
    * ``Model->where($fields = [], $conditions = [], $values = []);`` returns records of the model with conditions
        > Ex) ``$user = userModel->where(['id' ,'email'], ['>', '='], [3, 'lee5250@fredonia.edu']);`` returns an array of objects where id > 3 **and** email = 'lee5250@fredonia.edu'
* ```php
    protected $hidden = [];
  ```
    * Default is an empty array, specify properties you **don't want** to return by using default methods of models

* Creating New Models
    * Create your own models by making new files in ``app/models`` directory
    * Each model needs to extend ``Model`` class

## View
* Accepts data through ``$data`` array
* ```php
    <?php include APPROOT.'/views/inc/header.php'; ?>

        // Your Content Goes Here

    <?php include APPROOT.'/views/inc/footer.php'; ?>
    ```

## Database
* Used in your model as a property ``$this->db``
* Details are included in ``app/libraries/Database.php``

### Other details are included in each class files. Please contact <lee5250@fredonia.edu> for quetions/concerns