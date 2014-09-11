Setup:

Add to app.php 'providers' array:

'Bulforce\ExtDirect\ExtDirectServiceProvider',

Add route:

Route::group(array('prefix' => 'rpc'), function(){
    Route::any('/', function() {
        return ExtDirect::provide();
    });
});

Publish config file and set list of Controllers in 'api_array'

In the controllers where you want methods to be exposed add method comment @direct

