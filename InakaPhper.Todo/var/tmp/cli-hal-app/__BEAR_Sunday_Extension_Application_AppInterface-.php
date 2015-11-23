<?php

namespace Ray\Di\Compiler;

$instance = new \MyVendor\MyProject\Module\App($prototype('BEAR\\Sunday\\Extension\\Router\\RouterInterface-'), $prototype('BEAR\\Sunday\\Extension\\Transfer\\TransferInterface-'), $singleton('BEAR\\Resource\\ResourceInterface-'), $prototype('BEAR\\Sunday\\Extension\\Error\\ErrorInterface-'));
return $instance;