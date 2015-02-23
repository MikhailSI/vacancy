<?php

function autoload($className)
{
    $className = ltrim($className, '\\');
    $fileName  = '..' . DIRECTORY_SEPARATOR;
    $namespace = '';

    if ($lastNsPos = strrpos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName = ".." . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
        $appFileName = ".." . DIRECTORY_SEPARATOR . 'App' . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }

    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
    $appFileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

    if (is_readable($fileName)) {
        include $fileName;
        return true;
    } elseif (is_readable($appFileName)) {
        echo $appFileName;
        include $appFileName;
        return true;
    }

    throw new Exception("No class file for \"{$className}\"");
}

spl_autoload_register('autoload');