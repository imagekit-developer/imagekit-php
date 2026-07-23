<?php

declare(strict_types=1);

namespace ImageKit\Accounts\UsageAnalytics;

use ImageKit\Accounts\UsageAnalytics\UsageAnalyticsResponse\Browser;
use ImageKit\Accounts\UsageAnalytics\UsageAnalyticsResponse\Cache;
use ImageKit\Accounts\UsageAnalytics\UsageAnalyticsResponse\Country;
use ImageKit\Accounts\UsageAnalytics\UsageAnalyticsResponse\Device;
use ImageKit\Accounts\UsageAnalytics\UsageAnalyticsResponse\ErrorReason;
use ImageKit\Accounts\UsageAnalytics\UsageAnalyticsResponse\Extension;
use ImageKit\Accounts\UsageAnalytics\UsageAnalyticsResponse\Format;
use ImageKit\Accounts\UsageAnalytics\UsageAnalyticsResponse\StatusCode;
use ImageKit\Accounts\UsageAnalytics\UsageAnalyticsResponse\Top404Asset;
use ImageKit\Accounts\UsageAnalytics\UsageAnalyticsResponse\TopImages;
use ImageKit\Accounts\UsageAnalytics\UsageAnalyticsResponse\TopImageTransforms;
use ImageKit\Accounts\UsageAnalytics\UsageAnalyticsResponse\TopOtherAssets;
use ImageKit\Accounts\UsageAnalytics\UsageAnalyticsResponse\TopReferrers;
use ImageKit\Accounts\UsageAnalytics\UsageAnalyticsResponse\TopUserAgents;
use ImageKit\Accounts\UsageAnalytics\UsageAnalyticsResponse\TopVideos;
use ImageKit\Accounts\UsageAnalytics\UsageAnalyticsResponse\TopVideoTransforms;
use ImageKit\Accounts\UsageAnalytics\UsageAnalyticsResponse\URLEndpoints;
use ImageKit\Accounts\UsageAnalytics\UsageAnalyticsResponse\VideoProcessing;
use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type BrowserShape from \ImageKit\Accounts\UsageAnalytics\UsageAnalyticsResponse\Browser
 * @phpstan-import-type CacheShape from \ImageKit\Accounts\UsageAnalytics\UsageAnalyticsResponse\Cache
 * @phpstan-import-type CountryShape from \ImageKit\Accounts\UsageAnalytics\UsageAnalyticsResponse\Country
 * @phpstan-import-type DeviceShape from \ImageKit\Accounts\UsageAnalytics\UsageAnalyticsResponse\Device
 * @phpstan-import-type ErrorReasonShape from \ImageKit\Accounts\UsageAnalytics\UsageAnalyticsResponse\ErrorReason
 * @phpstan-import-type ExtensionShape from \ImageKit\Accounts\UsageAnalytics\UsageAnalyticsResponse\Extension
 * @phpstan-import-type FormatShape from \ImageKit\Accounts\UsageAnalytics\UsageAnalyticsResponse\Format
 * @phpstan-import-type StatusCodeShape from \ImageKit\Accounts\UsageAnalytics\UsageAnalyticsResponse\StatusCode
 * @phpstan-import-type Top404AssetShape from \ImageKit\Accounts\UsageAnalytics\UsageAnalyticsResponse\Top404Asset
 * @phpstan-import-type TopImagesShape from \ImageKit\Accounts\UsageAnalytics\UsageAnalyticsResponse\TopImages
 * @phpstan-import-type TopImageTransformsShape from \ImageKit\Accounts\UsageAnalytics\UsageAnalyticsResponse\TopImageTransforms
 * @phpstan-import-type TopOtherAssetsShape from \ImageKit\Accounts\UsageAnalytics\UsageAnalyticsResponse\TopOtherAssets
 * @phpstan-import-type TopReferrersShape from \ImageKit\Accounts\UsageAnalytics\UsageAnalyticsResponse\TopReferrers
 * @phpstan-import-type TopUserAgentsShape from \ImageKit\Accounts\UsageAnalytics\UsageAnalyticsResponse\TopUserAgents
 * @phpstan-import-type TopVideosShape from \ImageKit\Accounts\UsageAnalytics\UsageAnalyticsResponse\TopVideos
 * @phpstan-import-type TopVideoTransformsShape from \ImageKit\Accounts\UsageAnalytics\UsageAnalyticsResponse\TopVideoTransforms
 * @phpstan-import-type URLEndpointsShape from \ImageKit\Accounts\UsageAnalytics\UsageAnalyticsResponse\URLEndpoints
 * @phpstan-import-type VideoProcessingShape from \ImageKit\Accounts\UsageAnalytics\UsageAnalyticsResponse\VideoProcessing
 *
 * @phpstan-type UsageAnalyticsResponseShape = array{
 *   bandwidthBytes: float,
 *   browser: Browser|BrowserShape,
 *   cache: Cache|CacheShape,
 *   country: Country|CountryShape,
 *   device: Device|DeviceShape,
 *   endDate: string,
 *   errorReasons: list<ErrorReason|ErrorReasonShape>,
 *   extensions: list<Extension|ExtensionShape>,
 *   format: Format|FormatShape,
 *   generatedAt: \DateTimeInterface,
 *   requestCount: float,
 *   startDate: string,
 *   statusCodes: list<StatusCode|StatusCodeShape>,
 *   top404Assets: list<Top404Asset|Top404AssetShape>,
 *   topImages: TopImages|TopImagesShape,
 *   topImageTransforms: TopImageTransforms|TopImageTransformsShape,
 *   topOtherAssets: TopOtherAssets|TopOtherAssetsShape,
 *   topReferrers: TopReferrers|TopReferrersShape,
 *   topUserAgents: TopUserAgents|TopUserAgentsShape,
 *   topVideos: TopVideos|TopVideosShape,
 *   topVideoTransforms: TopVideoTransforms|TopVideoTransformsShape,
 *   urlEndpoints: URLEndpoints|URLEndpointsShape,
 *   videoProcessing: list<VideoProcessing|VideoProcessingShape>,
 * }
 */
final class UsageAnalyticsResponse implements BaseModel
{
    /** @use SdkModel<UsageAnalyticsResponseShape> */
    use SdkModel;

    /**
     * Total bandwidth, in bytes, utilized during the specified date range.
     */
    #[Required]
    public float $bandwidthBytes;

    /**
     * CDN traffic grouped by browser.
     */
    #[Required]
    public Browser $browser;

    /**
     * CDN cache hit, miss and error counts for the date range.
     */
    #[Required]
    public Cache $cache;

    /**
     * CDN traffic grouped by country.
     */
    #[Required]
    public Country $country;

    /**
     * CDN traffic grouped by device and operating system (e.g. `Desktop - Apple Mac`, `Smartphone - Apple iPhone`).
     */
    #[Required]
    public Device $device;

    /**
     * End date of the computed analytics data.
     */
    #[Required]
    public string $endDate;

    /**
     * Request count grouped by origin error reason. This covers failed origin fetches, such as an asset not found at origin or an origin timeout. It is not the HTTP status code returned to the client, see `statusCodes` for that.
     *
     * @var list<ErrorReason> $errorReasons
     */
    #[Required(list: ErrorReason::class)]
    public array $errorReasons;

    /**
     * Raw per-extension operation counts for the date range. These are raw operation counts, not billable extension units. For billable usage, use the `/v1/accounts/usage` endpoint.
     *
     * @var list<Extension> $extensions
     */
    #[Required(list: Extension::class)]
    public array $extensions;

    /**
     * CDN traffic grouped by response `Content-Type`.
     */
    #[Required]
    public Format $format;

    /**
     * Date and time when the analytics data was computed. Use this to gauge how fresh the returned data is. The date and time is in ISO8601 format.
     */
    #[Required]
    public \DateTimeInterface $generatedAt;

    /**
     * Total number of requests made during the specified date range.
     */
    #[Required]
    public float $requestCount;

    /**
     * Start date of the computed analytics data.
     */
    #[Required]
    public string $startDate;

    /**
     * Request count grouped by HTTP status code.
     *
     * @var list<StatusCode> $statusCodes
     */
    #[Required(list: StatusCode::class)]
    public array $statusCodes;

    /**
     * Top URLs that returned a 404 response.
     *
     * @var list<Top404Asset> $top404Assets
     */
    #[Required(list: Top404Asset::class)]
    public array $top404Assets;

    /**
     * Top image assets by traffic.
     */
    #[Required]
    public TopImages $topImages;

    /**
     * Top image transformation strings by traffic.
     */
    #[Required]
    public TopImageTransforms $topImageTransforms;

    /**
     * Top non-image, non-video assets by traffic.
     */
    #[Required]
    public TopOtherAssets $topOtherAssets;

    /**
     * Top HTTP referrers by traffic.
     */
    #[Required]
    public TopReferrers $topReferrers;

    /**
     * Top user agents by traffic.
     */
    #[Required]
    public TopUserAgents $topUserAgents;

    /**
     * Top video assets by traffic.
     */
    #[Required]
    public TopVideos $topVideos;

    /**
     * Top video transformation strings by traffic.
     */
    #[Required]
    public TopVideoTransforms $topVideoTransforms;

    /**
     * CDN traffic grouped by configured URL endpoint. Traffic that does not match any named URL endpoint pattern is grouped under `Default`.
     */
    #[Required]
    public URLEndpoints $urlEndpoints;

    /**
     * Raw observed video transcode output duration, in seconds, grouped by resolution and codec. These are raw seconds, not billable Video Processing Units (VPU). For billable VPU totals, use the `/v1/accounts/usage` endpoint.
     *
     * @var list<VideoProcessing> $videoProcessing
     */
    #[Required(list: VideoProcessing::class)]
    public array $videoProcessing;

    /**
     * `new UsageAnalyticsResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UsageAnalyticsResponse::with(
     *   bandwidthBytes: ...,
     *   browser: ...,
     *   cache: ...,
     *   country: ...,
     *   device: ...,
     *   endDate: ...,
     *   errorReasons: ...,
     *   extensions: ...,
     *   format: ...,
     *   generatedAt: ...,
     *   requestCount: ...,
     *   startDate: ...,
     *   statusCodes: ...,
     *   top404Assets: ...,
     *   topImages: ...,
     *   topImageTransforms: ...,
     *   topOtherAssets: ...,
     *   topReferrers: ...,
     *   topUserAgents: ...,
     *   topVideos: ...,
     *   topVideoTransforms: ...,
     *   urlEndpoints: ...,
     *   videoProcessing: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UsageAnalyticsResponse)
     *   ->withBandwidthBytes(...)
     *   ->withBrowser(...)
     *   ->withCache(...)
     *   ->withCountry(...)
     *   ->withDevice(...)
     *   ->withEndDate(...)
     *   ->withErrorReasons(...)
     *   ->withExtensions(...)
     *   ->withFormat(...)
     *   ->withGeneratedAt(...)
     *   ->withRequestCount(...)
     *   ->withStartDate(...)
     *   ->withStatusCodes(...)
     *   ->withTop404Assets(...)
     *   ->withTopImages(...)
     *   ->withTopImageTransforms(...)
     *   ->withTopOtherAssets(...)
     *   ->withTopReferrers(...)
     *   ->withTopUserAgents(...)
     *   ->withTopVideos(...)
     *   ->withTopVideoTransforms(...)
     *   ->withURLEndpoints(...)
     *   ->withVideoProcessing(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Browser|BrowserShape $browser
     * @param Cache|CacheShape $cache
     * @param Country|CountryShape $country
     * @param Device|DeviceShape $device
     * @param list<ErrorReason|ErrorReasonShape> $errorReasons
     * @param list<Extension|ExtensionShape> $extensions
     * @param Format|FormatShape $format
     * @param list<StatusCode|StatusCodeShape> $statusCodes
     * @param list<Top404Asset|Top404AssetShape> $top404Assets
     * @param TopImages|TopImagesShape $topImages
     * @param TopImageTransforms|TopImageTransformsShape $topImageTransforms
     * @param TopOtherAssets|TopOtherAssetsShape $topOtherAssets
     * @param TopReferrers|TopReferrersShape $topReferrers
     * @param TopUserAgents|TopUserAgentsShape $topUserAgents
     * @param TopVideos|TopVideosShape $topVideos
     * @param TopVideoTransforms|TopVideoTransformsShape $topVideoTransforms
     * @param URLEndpoints|URLEndpointsShape $urlEndpoints
     * @param list<VideoProcessing|VideoProcessingShape> $videoProcessing
     */
    public static function with(
        float $bandwidthBytes,
        Browser|array $browser,
        Cache|array $cache,
        Country|array $country,
        Device|array $device,
        string $endDate,
        array $errorReasons,
        array $extensions,
        Format|array $format,
        \DateTimeInterface $generatedAt,
        float $requestCount,
        string $startDate,
        array $statusCodes,
        array $top404Assets,
        TopImages|array $topImages,
        TopImageTransforms|array $topImageTransforms,
        TopOtherAssets|array $topOtherAssets,
        TopReferrers|array $topReferrers,
        TopUserAgents|array $topUserAgents,
        TopVideos|array $topVideos,
        TopVideoTransforms|array $topVideoTransforms,
        URLEndpoints|array $urlEndpoints,
        array $videoProcessing,
    ): self {
        $self = new self;

        $self['bandwidthBytes'] = $bandwidthBytes;
        $self['browser'] = $browser;
        $self['cache'] = $cache;
        $self['country'] = $country;
        $self['device'] = $device;
        $self['endDate'] = $endDate;
        $self['errorReasons'] = $errorReasons;
        $self['extensions'] = $extensions;
        $self['format'] = $format;
        $self['generatedAt'] = $generatedAt;
        $self['requestCount'] = $requestCount;
        $self['startDate'] = $startDate;
        $self['statusCodes'] = $statusCodes;
        $self['top404Assets'] = $top404Assets;
        $self['topImages'] = $topImages;
        $self['topImageTransforms'] = $topImageTransforms;
        $self['topOtherAssets'] = $topOtherAssets;
        $self['topReferrers'] = $topReferrers;
        $self['topUserAgents'] = $topUserAgents;
        $self['topVideos'] = $topVideos;
        $self['topVideoTransforms'] = $topVideoTransforms;
        $self['urlEndpoints'] = $urlEndpoints;
        $self['videoProcessing'] = $videoProcessing;

        return $self;
    }

    /**
     * Total bandwidth, in bytes, utilized during the specified date range.
     */
    public function withBandwidthBytes(float $bandwidthBytes): self
    {
        $self = clone $this;
        $self['bandwidthBytes'] = $bandwidthBytes;

        return $self;
    }

    /**
     * CDN traffic grouped by browser.
     *
     * @param Browser|BrowserShape $browser
     */
    public function withBrowser(Browser|array $browser): self
    {
        $self = clone $this;
        $self['browser'] = $browser;

        return $self;
    }

    /**
     * CDN cache hit, miss and error counts for the date range.
     *
     * @param Cache|CacheShape $cache
     */
    public function withCache(Cache|array $cache): self
    {
        $self = clone $this;
        $self['cache'] = $cache;

        return $self;
    }

    /**
     * CDN traffic grouped by country.
     *
     * @param Country|CountryShape $country
     */
    public function withCountry(Country|array $country): self
    {
        $self = clone $this;
        $self['country'] = $country;

        return $self;
    }

    /**
     * CDN traffic grouped by device and operating system (e.g. `Desktop - Apple Mac`, `Smartphone - Apple iPhone`).
     *
     * @param Device|DeviceShape $device
     */
    public function withDevice(Device|array $device): self
    {
        $self = clone $this;
        $self['device'] = $device;

        return $self;
    }

    /**
     * End date of the computed analytics data.
     */
    public function withEndDate(string $endDate): self
    {
        $self = clone $this;
        $self['endDate'] = $endDate;

        return $self;
    }

    /**
     * Request count grouped by origin error reason. This covers failed origin fetches, such as an asset not found at origin or an origin timeout. It is not the HTTP status code returned to the client, see `statusCodes` for that.
     *
     * @param list<ErrorReason|ErrorReasonShape> $errorReasons
     */
    public function withErrorReasons(array $errorReasons): self
    {
        $self = clone $this;
        $self['errorReasons'] = $errorReasons;

        return $self;
    }

    /**
     * Raw per-extension operation counts for the date range. These are raw operation counts, not billable extension units. For billable usage, use the `/v1/accounts/usage` endpoint.
     *
     * @param list<Extension|ExtensionShape> $extensions
     */
    public function withExtensions(array $extensions): self
    {
        $self = clone $this;
        $self['extensions'] = $extensions;

        return $self;
    }

    /**
     * CDN traffic grouped by response `Content-Type`.
     *
     * @param Format|FormatShape $format
     */
    public function withFormat(Format|array $format): self
    {
        $self = clone $this;
        $self['format'] = $format;

        return $self;
    }

    /**
     * Date and time when the analytics data was computed. Use this to gauge how fresh the returned data is. The date and time is in ISO8601 format.
     */
    public function withGeneratedAt(\DateTimeInterface $generatedAt): self
    {
        $self = clone $this;
        $self['generatedAt'] = $generatedAt;

        return $self;
    }

    /**
     * Total number of requests made during the specified date range.
     */
    public function withRequestCount(float $requestCount): self
    {
        $self = clone $this;
        $self['requestCount'] = $requestCount;

        return $self;
    }

    /**
     * Start date of the computed analytics data.
     */
    public function withStartDate(string $startDate): self
    {
        $self = clone $this;
        $self['startDate'] = $startDate;

        return $self;
    }

    /**
     * Request count grouped by HTTP status code.
     *
     * @param list<StatusCode|StatusCodeShape> $statusCodes
     */
    public function withStatusCodes(array $statusCodes): self
    {
        $self = clone $this;
        $self['statusCodes'] = $statusCodes;

        return $self;
    }

    /**
     * Top URLs that returned a 404 response.
     *
     * @param list<Top404Asset|Top404AssetShape> $top404Assets
     */
    public function withTop404Assets(array $top404Assets): self
    {
        $self = clone $this;
        $self['top404Assets'] = $top404Assets;

        return $self;
    }

    /**
     * Top image assets by traffic.
     *
     * @param TopImages|TopImagesShape $topImages
     */
    public function withTopImages(TopImages|array $topImages): self
    {
        $self = clone $this;
        $self['topImages'] = $topImages;

        return $self;
    }

    /**
     * Top image transformation strings by traffic.
     *
     * @param TopImageTransforms|TopImageTransformsShape $topImageTransforms
     */
    public function withTopImageTransforms(
        TopImageTransforms|array $topImageTransforms
    ): self {
        $self = clone $this;
        $self['topImageTransforms'] = $topImageTransforms;

        return $self;
    }

    /**
     * Top non-image, non-video assets by traffic.
     *
     * @param TopOtherAssets|TopOtherAssetsShape $topOtherAssets
     */
    public function withTopOtherAssets(
        TopOtherAssets|array $topOtherAssets
    ): self {
        $self = clone $this;
        $self['topOtherAssets'] = $topOtherAssets;

        return $self;
    }

    /**
     * Top HTTP referrers by traffic.
     *
     * @param TopReferrers|TopReferrersShape $topReferrers
     */
    public function withTopReferrers(TopReferrers|array $topReferrers): self
    {
        $self = clone $this;
        $self['topReferrers'] = $topReferrers;

        return $self;
    }

    /**
     * Top user agents by traffic.
     *
     * @param TopUserAgents|TopUserAgentsShape $topUserAgents
     */
    public function withTopUserAgents(TopUserAgents|array $topUserAgents): self
    {
        $self = clone $this;
        $self['topUserAgents'] = $topUserAgents;

        return $self;
    }

    /**
     * Top video assets by traffic.
     *
     * @param TopVideos|TopVideosShape $topVideos
     */
    public function withTopVideos(TopVideos|array $topVideos): self
    {
        $self = clone $this;
        $self['topVideos'] = $topVideos;

        return $self;
    }

    /**
     * Top video transformation strings by traffic.
     *
     * @param TopVideoTransforms|TopVideoTransformsShape $topVideoTransforms
     */
    public function withTopVideoTransforms(
        TopVideoTransforms|array $topVideoTransforms
    ): self {
        $self = clone $this;
        $self['topVideoTransforms'] = $topVideoTransforms;

        return $self;
    }

    /**
     * CDN traffic grouped by configured URL endpoint. Traffic that does not match any named URL endpoint pattern is grouped under `Default`.
     *
     * @param URLEndpoints|URLEndpointsShape $urlEndpoints
     */
    public function withURLEndpoints(URLEndpoints|array $urlEndpoints): self
    {
        $self = clone $this;
        $self['urlEndpoints'] = $urlEndpoints;

        return $self;
    }

    /**
     * Raw observed video transcode output duration, in seconds, grouped by resolution and codec. These are raw seconds, not billable Video Processing Units (VPU). For billable VPU totals, use the `/v1/accounts/usage` endpoint.
     *
     * @param list<VideoProcessing|VideoProcessingShape> $videoProcessing
     */
    public function withVideoProcessing(array $videoProcessing): self
    {
        $self = clone $this;
        $self['videoProcessing'] = $videoProcessing;

        return $self;
    }
}
