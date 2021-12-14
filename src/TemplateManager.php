<?php

namespace App\src;

use App\src\Context\ApplicationContext;
use App\src\Entity\Destination;
use App\src\Entity\Quote;
use App\src\Entity\Site;
use App\src\Entity\Template;
use App\src\Entity\User;
use App\src\Exceptions\InconsistentReplacementArrayException;
use App\src\Repository\DestinationRepository;
use App\src\Repository\SiteRepository;

class TemplateManager
{
    private Quote $quote;
    private User $user;
    private Site $site;
    private Destination $destination;

    private array $searches = [
        self::OPENING_CHAR . self::QUOTE_DESTINATION_LINK . self::CLOSING_CHAR,
        self::OPENING_CHAR . self::QUOTE_SUMMARY_HTML . self::CLOSING_CHAR,
        self::OPENING_CHAR . self::QUOTE_SUMMARY . self::CLOSING_CHAR,
        self::OPENING_CHAR . self::QUOTE_DESTINATION_NAME . self::CLOSING_CHAR,
        self::OPENING_CHAR . self::USER_FIRST_NAME . self::CLOSING_CHAR,
    ];

    private array $replacements = [];

    public const OPENING_CHAR = '[';
    public const CLOSING_CHAR = ']';

    public const QUOTE_DESTINATION_LINK = 'quote:destination_link';
    public const QUOTE_SUMMARY_HTML = 'quote:summary_html';
    public const QUOTE_SUMMARY = 'quote:summary';
    public const QUOTE_DESTINATION_NAME = 'quote:destination_name';
    public const USER_FIRST_NAME = 'user:first_name';

    /**
     * @throws InconsistentReplacementArrayException
     */
    public function __construct(Quote $quote, ?User $user = null)
    {
        $this->quote = $quote;
        $this->user = $user ?? (ApplicationContext::getInstance())->getCurrentUser();
        $this->site = SiteRepository::getInstance()->getById($this->quote->getSiteId());
        $this->destination = DestinationRepository::getInstance()->getById($this->quote->getDestinationId());

        $this->initializeReplacementsArray();

        if (count($this->searches) !== count($this->replacements)) {
            throw new InconsistentReplacementArrayException();
        }
    }

    public function getTemplateComputed(Template $template, array $data = []): Template
    {
        /** @noinspection PhpExpressionResultUnusedInspection */
        count($data) > 0 ? trigger_error('Using "data" parameter is not needed anymore', E_USER_DEPRECATED) : null;

        return (clone($template))
            ->setSubject($this->computeText($template->getSubject()))
            ->setContent($this->computeText($template->getContent()));
    }

    private function computeText(string $text): string
    {
        return str_replace($this->searches, $this->replacements, $text);
    }

    private function initializeReplacementsArray(): void
    {
        $this->replacements = [
            $this->site->getUrl() . '/' . $this->destination->getCountryName() . '/quote/' . $this->quote->getId(),
            $this->quote->renderHtml(),
            (string)$this->quote,
            $this->destination->getCountryName(),
            ucfirst(mb_strtolower($this->user->getFirstname()))
        ];
    }
}
