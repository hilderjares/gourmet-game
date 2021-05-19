<?php

use DI\ContainerBuilder;

$definitions = require __DIR__. '/definitions.php';

$builder = new ContainerBuilder();
$builder->addDefinitions($definitions);
$builder->build();

$container = $builder->build();