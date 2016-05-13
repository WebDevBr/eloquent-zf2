<?php

namespace EloquentZf2;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

class ConnectionManager
{

	public function __construct(array $config)
	{
		//set a default database configuration
        //or get a config/autoload/[global.php, local.php] if exists
        $database_default = 'default';
        if (!empty($config['eloquent']['database_default'])) {
            $database_default = $config['eloquent']['database_default'];
        }

        //set a default value to setAsGlobal
        //or get a config/autoload/[global.php, local.php] if exists
        $set_as_global = true;
        if (isset($config['eloquent']['setAsGlobal'])) {
            $set_as_global = $config['eloquent']['setAsGlobal'];
        }

        //if not exists database config show a exception
        if (!isset($config['database'][$database_default])) {
            throw new \Exception("Database not properly configurated, seed {{doc url here}}", 1);
        }

        //configure Illuminate datase
        $capsule = new Capsule;
        $capsule->addConnection($config['database'][$database_default]);

        unset($config['database'][$database_default]);

        if (isset($config['database']['default'])) {
        	unset($config['database']['default']);
        }

        foreach ($config['database'] as $name=>$db_config) {
        	$capsule->addConnection($db_config, $name);
        }

        // Set the event dispatcher used by Eloquent models
        $capsule->setEventDispatcher(new Dispatcher(new Container));

        // Make this Capsule instance available globally via static methods... (optional)
        if ($set_as_global) {
            $capsule->setAsGlobal();
        }

        // Setup the Eloquent ORM
        $capsule->bootEloquent();
	}
}