<?php

namespace Ray\Di\Compiler;

$instance = new \BEAR\Resource\Module\SchemeCollectionProvider('MyVendor\\MyProject', $injector());
return $instance->get();