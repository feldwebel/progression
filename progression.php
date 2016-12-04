<?php

include __DIR__.'/vendor/autoload.php';

echo Progression::create($argv)->detect();
