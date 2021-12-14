<?php

use PHPUnit\Framework\TestCase;
use Prophecy\Exception\Doubler\MethodNotFoundException;
use App\src\Entity\Destination;
use App\src\Entity\Quote;
use App\src\Entity\Site;
use App\src\Entity\Template;
use App\src\Entity\User;
use App\src\Exceptions\InconsistentReplacementArrayException;
use App\src\Helper\ReflectionTrait;
use App\src\Repository\DestinationRepository;
use App\src\Repository\SiteRepository;
use App\src\TemplateManager;

class TemplateManagerTest extends TestCase
{
    use ReflectionTrait;

    public function providerTestGetTemplateComputed(): array
    {
        return [
            [0, '', '', '', '', ''],
            [0, '', '', '', 'Salut tu vas bien ? :)', 'Salut tu vas bien ? :)'],
            [1, '', 'www.atlantide.img', 'atlantide', 'Va vite sur [quote:destination_link] !', 'Va vite sur www.atlantide.img/atlantide/quote/1 !'],
            [42, '', '', '', 'Sommaire : [quote:summary_html]', 'Sommaire : <p>42</p>'],
            [42, '', '', '', 'Sommaire : [quote:summary]', 'Sommaire : 42'],
            [0, '', '', 'Calabria', 'Destination : [quote:destination_name]', 'Destination : Calabria'],
            [0, 'BERTRAND', '', '', 'Tu t\'appelles : [user:first_name]', 'Tu t\'appelles : Bertrand'],
            [
                42,
                'BERNARD',
                'https://www.evaneos.com',
                'Watopia',
                'Bonjour [user:first_name], tu pars à [quote:destination_name]. Retrouve les infos ici : [quote:destination_link] Voici ton résumé : [quote:summary], consulte également la version web : [quote:summary_html]',
                'Bonjour Bernard, tu pars à Watopia. Retrouve les infos ici : https://www.evaneos.com/Watopia/quote/42 Voici ton résumé : 42, consulte également la version web : <p>42</p>',
            ]
        ];
    }

    /**
     * @dataProvider providerTestGetTemplateComputed
     *
     * @throws InconsistentReplacementArrayException
     * @throws ReflectionException
     * @throws MethodNotFoundException
     */
    public function testGetTemplateComputed(
        int    $idQuote,
        string $userFirstname,
        string $siteUrl,
        string $countryName,
        string $text,
        string $expected
    ): void {
        $quote = new Quote($idQuote, 1, 1);
        $user = new User(1, $userFirstname);
        $site = new Site(1, $siteUrl);
        $destination = new Destination(1, $countryName);

        $siteRepositoryMock = $this->createMock(SiteRepository::class);
        $siteRepositoryMock->method('getById')->willReturn($site);

        $destinationRepositoryMock = $this->createMock(DestinationRepository::class);
        $destinationRepositoryMock->method('getById')->willReturn($destination);

        self::mockSingletonRepository(SiteRepository::class, $siteRepositoryMock);
        self::mockSingletonRepository(DestinationRepository::class, $destinationRepositoryMock);

        $templateManager = new TemplateManager($quote, $user);
        $template = (new Template(1,$text, $text));

        self::assertSame($expected, ($templateManager->getTemplateComputed($template))->getSubject());
        self::assertSame($expected, ($templateManager->getTemplateComputed($template))->getContent());
    }
}
