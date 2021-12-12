<?php

namespace src;

use Exception;
use src\Context\ApplicationContext;
use src\Entity\Quote;
use src\Entity\Template;
use src\Entity\User;
use src\Repository\DestinationRepository;
use src\Repository\QuoteRepository;
use src\Repository\SiteRepository;

class TemplateManager
{
    /**
     * @throws Exception
     */
    public function getTemplateComputed(Template $tpl, array $data): Template
    {
        $replaced = clone($tpl);
        $replaced->setSubject($this->computeText($replaced->getSubject(), $data));
        $replaced->setContent($this->computeText($replaced->getContent(), $data));

        return $replaced;
    }

    /**
     * @throws Exception
     */
    private function computeText(string $text, array $data): string
    {
        $quote = (isset($data['quote']) and $data['quote'] instanceof Quote) ? $data['quote'] : null;

        if ($quote === null) {
            throw new Exception('quote not provided');
        }

        $APPLICATION_CONTEXT = ApplicationContext::getInstance();
        $_quoteFromRepository = QuoteRepository::getInstance()->getById($quote->getId());
        $usefulObject = SiteRepository::getInstance()->getById($quote->getSiteId());
        $destinationOfQuote = DestinationRepository::getInstance()->getById($quote->getDestinationId());

        if (str_contains($text, '[quote:destination_link]')) {
            $destination = DestinationRepository::getInstance()->getById($quote->getDestinationId());
        }

        $containsSummaryHtml = strpos($text, '[quote:summary_html]');
        $containsSummary = strpos($text, '[quote:summary]');

        if ($containsSummaryHtml !== false || $containsSummary !== false) {
            if ($containsSummaryHtml !== false) {
                $text = str_replace(
                    '[quote:summary_html]',
                    $_quoteFromRepository->renderHtml(),
                    $text
                );
            }
            if ($containsSummary !== false) {
                $text = str_replace(
                    '[quote:summary]',
                    (string) $_quoteFromRepository,
                    $text
                );
            }
        }

        (str_contains($text, '[quote:destination_name]')) and $text = str_replace('[quote:destination_name]', $destinationOfQuote->getCountryName(), $text);

        $text = isset($destination)
            ? str_replace('[quote:destination_link]', $usefulObject->getUrl() . '/' . $destination->getCountryName() . '/quote/' . $_quoteFromRepository->getId(), $text)
            : str_replace('[quote:destination_link]', '', $text);

        $_user = (isset($data['user']) and ($data['user'] instanceof User)) ? $data['user'] : $APPLICATION_CONTEXT->getCurrentUser();
        if ($_user) {
            (str_contains($text, '[user:first_name]')) and $text = str_replace('[user:first_name]', ucfirst(mb_strtolower($_user->getFirstname())), $text);
        }

        return $text;
    }
}
