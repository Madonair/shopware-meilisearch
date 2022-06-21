<?php

declare(strict_types=1);

namespace Mdnr\Meilisearch\Framework;

use MeiliSearch\Client;
use Shopware\Core\System\SystemConfig\SystemConfigService;

class MeilisearchHelper
{
  private SystemConfigService $systemConfigService;

  public function __construct(SystemConfigService $systemConfigService)
  {
    $this->systemConfigService = $systemConfigService;
  }


  public function getClient(): Client
  {
    return (new Client($this->getEndpoint(), $this->getMasterKey()));
  }

  public function getEndpoint(): string
  {
    return $this->systemConfigService->get('Meilisearch.config.urlEndpoint');
  }
  public function getMasterKey(): string
  {
    return $this->systemConfigService->get('Meilisearch.config.masterKey');
  }

  public function getPrefix(): string
  {
    return $this->systemConfigService->get('Meilisearch.config.prefix');
  }
}