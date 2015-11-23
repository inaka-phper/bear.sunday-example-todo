<?php

namespace Ray\Di\Compiler;

$instance = new \MyVendor\MyProject\Resource\Page\Index();
$instance->setRenderer($singleton('BEAR\\Resource\\RenderInterface-', array('BEAR\\Resource\\ResourceObject', 'setRenderer', 'renderer')));
return $instance;