<?php

declare(strict_types=1);

namespace ImageKit\Contracts\Files;

use ImageKit\Files\Details\DetailUpdateParams;
use ImageKit\Files\Details\DetailUpdateParams\Extension\AutoTaggingExtension;
use ImageKit\Files\Details\DetailUpdateParams\Extension\RemovedotBgExtension;
use ImageKit\Files\Details\DetailUpdateParams\Publish;
use ImageKit\Files\Details\DetailUpdateParams\RemoveAITags\UnionMember1;
use ImageKit\RequestOptions;
use ImageKit\Responses\Files\Details\DetailGetResponse;
use ImageKit\Responses\Files\Details\DetailUpdateResponse;

interface DetailsContract
{
    public function retrieve(
        string $fileID,
        ?RequestOptions $requestOptions = null
    ): DetailGetResponse;

    /**
     * @param array{
     *   customCoordinates?: null|string,
     *   customMetadata?: mixed,
     *   extensions?: list<AutoTaggingExtension|RemovedotBgExtension>,
     *   removeAITags?: list<string>|UnionMember1::*,
     *   tags?: null|list<string>,
     *   webhookURL?: string,
     *   publish?: Publish,
     * }|DetailUpdateParams $params
     */
    public function update(
        string $fileID,
        array|DetailUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): DetailUpdateResponse;
}
