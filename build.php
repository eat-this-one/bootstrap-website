<?php

/**
 * Fill placeholders with i18n language strings.
 */

if (php_sapi_name() !== "cli") {
    echo "Error: Only CLI" . PHP_EOL;
    exit(1);
}

// LOL.
if (!file_exists('.gitignore')) {
    echo "Error: Run it only from the project root" . PHP_EOL;
    exit(1);
}

$langs = array(
    'en' => 'index.html',
    'es' => 'es/index.html'
);

$template = 'index.template';
foreach ($langs as $lang => $file) {

    unset($i18n);

    $langfile = 'lang/' . $lang . '.php';

    if (!file_exists($langfile)) {
        echo "Error: $lang i18n file not found" . PHP_EOL;
        continue;
    }

    include($langfile);
    $keys = array_keys($i18n);
    $values = array_values($i18n);

    $i18ncontents = str_replace($keys, $values, file_get_contents($template));
    file_put_contents($file, $i18ncontents);

    echo "Generated $lang file" . PHP_EOL;
}

echo "Done" . PHP_EOL;
exit(0);
