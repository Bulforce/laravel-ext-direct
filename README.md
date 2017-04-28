##Info
This is ext-direct provider for laravel 5 and ExtJS 4 (works with extjs 5 as well)

Looking for the laravel 4 package, check this laravel4 branch.

The idea behind ext-direct is to allow javascript to call remote php methods as they were client side javascript methods. This is reducing dramatically the development time.

Heavily(almost 99%) based on http://www.sencha.com/forum/showthread.php?102357-Extremely-Easy-Ext.Direct-integration-with-PHP

The original class was touched just a little bit.


##Installation##

Add this line to the composer.json require list and run composer update

```
"bulforce/ext-direct": "dev-master"
```


Add to app.php 'providers' array:

``` 
'Bulforce\ExtDirect\ExtDirectServiceProvider', 
```

This package comes with a Facade but you dont have to include it in your app.php it is automatically included.

You **MUST** publish or create this config file:

```
../laravel_project/app/config/packages/bulforce/ext-direct/config.php
```
You **MUST** edit the config.php file:
```
<?php

return array(
    'namespace' => 'Ext.rpc',
    'descriptor' => 'Ext.rpc.REMOTING_API',
    'timeout' => 30,
    'debug' => true,
    'api_classes' => array(
        'Items' => 'ItemsController'
    )
);
```
Most important part is the **api_classes** array, there you have to list all the classes(normally controllers) from your application that you want to make availabe to extjs to call directly. 

**Note** that it doesnt have to be associative array, you can simply list the class name in a normal indexed array. However if you list them as associative array then you can call them from extjs using the array element ``key`` instead of the actuall controller class name. This way you can hide your real application structure from the front end.

**TAG Direct methods** 
In order for a controller method to be made available to extjs/sencha to call directly **two** conditions must be met:

    1. Method needs to be declared as **public**
    2. Method needs to contain comment tag @direct

example:
```php
    /**
     * @direct
     */
    public function read($params = null) {
        return Item::take(50)->get();
    }
```


add a route in your routes.php
```php
    Route::any('/rpc', function() {
        return ExtDirect::provide();
    });
```

Lastly add something like this in your index.html (after extjs library and before your application code!!!)
```html
<script type="text/javascript" src="http://laravel_project.dev/rpc?javascript"></script>
```

Now you should be able to call laravel controller methods from javascript directly
```javascript
Ext.rpc.Items.read(function(response) {
    console.log(response);
});

//with params, params will be passed to the controller method as php object
Ext.rpc.Items.read({page: 5},function(response) {
    console.log(response);
});

//use it in direct stores api object
api: {
    read: Ext.rpc.Items.read
}
```

