<?php
/**
3 * Example Implementation of PSR-0
4 *
5 * @param $className
6 */
function autoload($className)
{
    $className = ltrim($className, '\\');
    $fileName = '';
    $namespace = '';
    if ($lastNsPos = strrpos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) .
        DIRECTORY_SEPARATOR;
    }
    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

    if (file_exists($fileName)) {
        require $fileName;
    } else {
//        throw new \ErrorException('Class cannot be autoloaded');
        //If the Class cannot be found send the user to 404
        header('location: ../views/notfound');
    }
}

spl_autoload_register('autoload');