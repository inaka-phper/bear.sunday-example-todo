<?php

namespace MyVendor\MyProject\Resource\App;

use BEAR\Resource\ResourceObject;
use Psr\Log\LoggerInterface;
use MyVendor\MyProject\Annotation\BenchMark;

class Weekday extends ResourceObject
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @BenchMark
     * @param $year
     * @param $month
     * @param $day
     * @return $this
     */
    public function onGet($year, $month, $day)
    {
        $date = \DateTime::createFromFormat('Y-m-d', "$year-$month-$day");
        $this['weekday'] = $date->format("D");
        $this->logger->info("$year-$month-$day {$this['weekday']}");

        return $this;
    }
}