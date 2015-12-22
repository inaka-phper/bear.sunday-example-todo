<?php

namespace MyVendor\MyProject\Module;

use BEAR\Resource\Module\ImportAppModule;
use BEAR\Resource\ImportApp;
use BEAR\Package\Context;
use BEAR\Package\PackageModule;
use BEAR\Package\Provide\Router\AuraRouterModule;
use MyVendor\MyProject\Annotation\BenchMark;
use MyVendor\MyProject\Interceptor\BenchMarker;
use Psr\Log\LoggerInterface;
use Ray\AuraSqlModule\AuraSqlModule;
use Ray\AuraSqlModule\AuraSqlQueryModule;
use Ray\CakeDbModule\CakeDbModule;
use Ray\Di\AbstractModule;
use Ray\Di\Scope;

class AppModule extends AbstractModule
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $importConfig = [
            new ImportApp('blog', 'Acme\Blog', 'prod-hal-app') // ホスト, 名前, コンテキスト
        ];
        $this->override(new ImportAppModule($importConfig , Context::class));

        $this->install(new PackageModule);
        $this->override(new AuraRouterModule);
        $this->bind(LoggerInterface::class)->toProvider(MonologLoggerProvider::class)->in(Scope::SINGLETON);

        $this->bindInterceptor(
            $this->matcher->any(),                           // どのクラスでも
            $this->matcher->annotatedWith(BenchMark::class), // @BenchMarkとアノテートされているメソッドに
            [BenchMarker::class]                             // BenchMarkerインターセプターを適用
        );

        $dbConfig = [
            'driver' => 'Cake\Database\Driver\Sqlite',
            'database' => dirname(dirname(__DIR__)) . '/var/db/todo.sqlite3'
        ];
        $this->install(new CakeDbModule($dbConfig));

        $dbConfig = 'sqlite:' . dirname(dirname(__DIR__)). '/var/db/post.sqlite3';
        $this->install(new AuraSqlModule($dbConfig));
    }
}
