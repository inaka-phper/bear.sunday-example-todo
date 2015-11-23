<?php

namespace Ray\Di\Compiler;

$instance = new \BEAR\QueryRepository\StorageProvider($singleton('Doctrine\\Common\\Cache\\CacheProvider-BEAR\\RepositoryModule\\Annotation\\Storage'));
$instance->setAppName('MyVendor\\MyProject');
return $instance->get();