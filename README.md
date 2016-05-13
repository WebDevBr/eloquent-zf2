# Eloquent for Zend Framework 2

## Instalation

Run:

	composer require webdevbr/eloquent-zf2


## Configuration

In the ```config\autoload\global.php``` put:

	return array(
	    'database' => [
	    	'default' => [
			    'driver'    => 'mysql',
			    'host'      => 'localhost',
			    'database'  => 'database',
			    'username'  => 'root',
			    'password'  => 'password',
			    'charset'   => 'utf8',
			    'collation' => 'utf8_unicode_ci',
			    'prefix'    => '',
			]
	    ],
	    'eloquent' => [
	    	'database_default'=>'default',
	    	'setAsGlobal'=>true,
	    ]
	);
