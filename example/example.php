<?php

if (!file_exists(__DIR__ . '/../vendor/autoload.php')) {
    die('Unable to load autoload.php, please run "make dump-autoload"');
}

require_once __DIR__ . '/../vendor/autoload.php';

use Faker\Factory;
use App\src\Entity\Quote;
use App\src\Entity\Template;
use App\src\TemplateManager;

$faker = Factory::create();

$template = new Template(
    1,
    'Votre voyage avec une agence locale [quote:destination_name]',
    "
Bonjour [user:first_name],

Merci d'avoir contacté un agent local pour votre voyage [quote:destination_name].

Bien cordialement,

L'équipe Evaneos.com
www.evaneos.com
");

try {
    $templateManager = new TemplateManager(new Quote($faker->randomNumber(), $faker->randomNumber(), $faker->randomNumber()));
    $message = $templateManager->getTemplateComputed($template);
    echo $message->getSubject() . "\n" . $message->getContent();
} catch (Exception $e) {
    echo "An error occured during the rendering of the template : {$e->getMessage()}";
}