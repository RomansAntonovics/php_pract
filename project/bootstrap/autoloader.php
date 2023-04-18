<?php

$configuration = json_decode(
    file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'autoloader_config.json'),
    true
);

$namespaces = $configuration['autoload']['psr-4'];

function fqcnToPath(string $fqcn, string $prefix) {

    $relativeClass = ltrim($fqcn, $prefix);

    return str_replace('\\', '/', $relativeClass) . '.php';
}

spl_autoload_register(function (string $class) use ($namespaces) {

    $prefix = strtok($class, '\\') . '\\';

    // We don't handle that namespace.
    // Return and hope some other autoloader handles it.
    if (!array_key_exists($prefix, $namespaces)) {
        return;
    }

    $baseDirectory = $namespaces[$prefix];
    $path = fqcnToPath($class, $prefix);

    require ROOT_DIR . '/' . $baseDirectory . '/' . $path;
});

