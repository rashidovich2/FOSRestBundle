#!/usr/bin/env php
<?php

set_time_limit(0);

$vendorDir = __DIR__;
$deps = array(
    array('symfony', 'http://github.com/symfony/symfony', isset($_ENV['SYMFONY_VERSION']) ? $_ENV['SYMFONY_VERSION'] : 'origin/master'),
    array('doctrine-common', 'http://github.com/doctrine/common.git', 'origin/master'),
    array('JMS/SerializerBundle', 'http://github.com/schmittjoh/JMSSerializerBundle', 'origin/master'),
    array('Sensio/Bundle/FrameworkExtraBundle', 'http://github.com/sensio/SensioFrameworkExtraBundle', 'origin/master'),
);

foreach ($deps as $dep) {
    list($name, $url, $rev) = $dep;

    echo "> Installing/Updating $name\n";

    $installDir = $vendorDir.'/'.$name;
    if (!is_dir($installDir)) {
        system(sprintf('git clone %s %s', escapeshellarg($url), escapeshellarg($installDir)));
    }

    system(sprintf('cd %s && git fetch origin && git reset --hard %s', escapeshellarg($installDir), escapeshellarg($rev)));
}
