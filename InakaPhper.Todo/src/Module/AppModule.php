<?php

namespace MyVendor\MyProject\Module;

use BEAR\Package\PackageModule;
use BEAR\Package\Provide\Router\AuraRouterModule;
use MyVendor\MyProject\Annotation\BenchMark;
use MyVendor\MyProject\Interceptor\BenchMarker;
use Psr\Log\LoggerInterface;
use Ray\Di\AbstractModule;
use Ray\Di\Scope;

class AppModule extends AbstractModule
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->install(new PackageModule);
        $this->override(new AuraRouterModule);
        $this->bind(LoggerInterface::class)->toProvider(MonologLoggerProvider::class)->in(Scope::SINGLETON);

        $this->bindInterceptor(
            $this->matcher->any(),                           // どのクラスでも
            $this->matcher->annotatedWith(BenchMark::class), // @BenchMarkとアノテートされているメソッドに
            [BenchMarker::class]                             // BenchMarkerインターセプターを適用
        );
    }
}
