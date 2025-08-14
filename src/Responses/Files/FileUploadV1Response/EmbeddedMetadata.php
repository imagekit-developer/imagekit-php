<?php

declare(strict_types=1);

namespace ImageKit\Responses\Files\FileUploadV1Response;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\Model;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Core\Conversion\ListOf;

/**
 * Consolidated embedded metadata associated with the file. It includes exif, iptc, and xmp data. Send `embeddedMetadata` in `responseFields` in API request to get embeddedMetadata in the upload API response.
 *
 * @phpstan-type embedded_metadata_alias = array{
 *   aboutCvTermCvID?: string,
 *   aboutCvTermID?: string,
 *   aboutCvTermName?: string,
 *   aboutCvTermRefinedAbout?: string,
 *   additionalModelInformation?: string,
 *   applicationRecordVersion?: int,
 *   artist?: string,
 *   artworkCircaDateCreated?: string,
 *   artworkContentDescription?: string,
 *   artworkContributionDescription?: string,
 *   artworkCopyrightNotice?: string,
 *   artworkCopyrightOwnerID?: string,
 *   artworkCopyrightOwnerName?: string,
 *   artworkCreator?: list<string>,
 *   artworkCreatorID?: list<string>,
 *   artworkDateCreated?: \DateTimeInterface,
 *   artworkLicensorID?: string,
 *   artworkLicensorName?: string,
 *   artworkPhysicalDescription?: string,
 *   artworkSource?: string,
 *   artworkSourceInventoryNo?: string,
 *   artworkSourceInvURL?: string,
 *   artworkStylePeriod?: list<string>,
 *   artworkTitle?: string,
 *   authorsPosition?: string,
 *   byline?: string,
 *   bylineTitle?: string,
 *   caption?: string,
 *   captionAbstract?: string,
 *   captionWriter?: string,
 *   city?: string,
 *   colorSpace?: string,
 *   componentsConfiguration?: string,
 *   copyright?: string,
 *   copyrightNotice?: string,
 *   copyrightOwnerID?: list<string>,
 *   copyrightOwnerName?: list<string>,
 *   country?: string,
 *   countryCode?: string,
 *   countryPrimaryLocationCode?: string,
 *   countryPrimaryLocationName?: string,
 *   creator?: string,
 *   creatorAddress?: string,
 *   creatorCity?: string,
 *   creatorCountry?: string,
 *   creatorPostalCode?: string,
 *   creatorRegion?: string,
 *   creatorWorkEmail?: string,
 *   creatorWorkTelephone?: string,
 *   creatorWorkURL?: string,
 *   credit?: string,
 *   dateCreated?: \DateTimeInterface,
 *   dateTimeCreated?: \DateTimeInterface,
 *   dateTimeOriginal?: \DateTimeInterface,
 *   description?: string,
 *   digitalImageGuid?: string,
 *   digitalSourceType?: string,
 *   embeddedEncodedRightsExpr?: string,
 *   embeddedEncodedRightsExprLangID?: string,
 *   embeddedEncodedRightsExprType?: string,
 *   event?: string,
 *   exifVersion?: string,
 *   flashpixVersion?: string,
 *   genreCvID?: string,
 *   genreCvTermID?: string,
 *   genreCvTermName?: string,
 *   genreCvTermRefinedAbout?: string,
 *   headline?: string,
 *   imageCreatorID?: string,
 *   imageCreatorImageID?: string,
 *   imageCreatorName?: string,
 *   imageDescription?: string,
 *   imageRegionBoundaryH?: list<float>,
 *   imageRegionBoundaryRx?: list<float>,
 *   imageRegionBoundaryShape?: list<string>,
 *   imageRegionBoundaryUnit?: list<string>,
 *   imageRegionBoundaryVerticesX?: list<float>,
 *   imageRegionBoundaryVerticesY?: list<float>,
 *   imageRegionBoundaryW?: list<float>,
 *   imageRegionBoundaryX?: list<float>,
 *   imageRegionBoundaryY?: list<float>,
 *   imageRegionCtypeIdentifier?: list<string>,
 *   imageRegionCtypeName?: list<string>,
 *   imageRegionID?: list<string>,
 *   imageRegionName?: list<string>,
 *   imageRegionOrganisationInImageName?: list<string>,
 *   imageRegionPersonInImage?: list<string>,
 *   imageRegionRoleIdentifier?: list<string>,
 *   imageRegionRoleName?: list<string>,
 *   imageSupplierID?: string,
 *   imageSupplierImageID?: string,
 *   imageSupplierName?: string,
 *   instructions?: string,
 *   intellectualGenre?: string,
 *   keywords?: list<string>,
 *   licensorCity?: list<string>,
 *   licensorCountry?: list<string>,
 *   licensorEmail?: list<string>,
 *   licensorExtendedAddress?: list<string>,
 *   licensorID?: list<string>,
 *   licensorName?: list<string>,
 *   licensorPostalCode?: list<string>,
 *   licensorRegion?: list<string>,
 *   licensorStreetAddress?: list<string>,
 *   licensorTelephone1?: list<string>,
 *   licensorTelephone2?: list<string>,
 *   licensorURL?: list<string>,
 *   linkedEncodedRightsExpr?: string,
 *   linkedEncodedRightsExprLangID?: string,
 *   linkedEncodedRightsExprType?: string,
 *   location?: string,
 *   locationCreatedCity?: string,
 *   locationCreatedCountryCode?: string,
 *   locationCreatedCountryName?: string,
 *   locationCreatedGpsAltitude?: string,
 *   locationCreatedGpsLatitude?: string,
 *   locationCreatedGpsLongitude?: string,
 *   locationCreatedLocationID?: string,
 *   locationCreatedLocationName?: string,
 *   locationCreatedProvinceState?: string,
 *   locationCreatedSublocation?: string,
 *   locationCreatedWorldRegion?: string,
 *   locationShownCity?: list<string>,
 *   locationShownCountryCode?: list<string>,
 *   locationShownCountryName?: list<string>,
 *   locationShownGpsAltitude?: list<string>,
 *   locationShownGpsLatitude?: list<string>,
 *   locationShownGpsLongitude?: list<string>,
 *   locationShownLocationID?: list<string>,
 *   locationShownLocationName?: list<string>,
 *   locationShownProvinceState?: list<string>,
 *   locationShownSublocation?: list<string>,
 *   locationShownWorldRegion?: list<string>,
 *   maxAvailHeight?: float,
 *   maxAvailWidth?: float,
 *   modelAge?: list<float>,
 *   modelReleaseID?: list<string>,
 *   objectAttributeReference?: string,
 *   objectName?: string,
 *   offsetTimeOriginal?: string,
 *   organisationInImageCode?: list<string>,
 *   organisationInImageName?: list<string>,
 *   orientation?: string,
 *   originalTransmissionReference?: string,
 *   personInImage?: list<string>,
 *   personInImageCvTermCvID?: list<string>,
 *   personInImageCvTermID?: list<string>,
 *   personInImageCvTermName?: list<string>,
 *   personInImageCvTermRefinedAbout?: list<string>,
 *   personInImageDescription?: list<string>,
 *   personInImageID?: list<string>,
 *   personInImageName?: list<string>,
 *   productInImageDescription?: list<string>,
 *   productInImageGtin?: list<float>,
 *   productInImageName?: list<string>,
 *   propertyReleaseID?: list<string>,
 *   provinceState?: string,
 *   rating?: int,
 *   registryEntryRole?: list<string>,
 *   registryItemID?: list<string>,
 *   registryOrganisationID?: list<string>,
 *   resolutionUnit?: string,
 *   rights?: string,
 *   scene?: list<string>,
 *   source?: string,
 *   specialInstructions?: string,
 *   state?: string,
 *   subject?: list<string>,
 *   subjectCode?: list<string>,
 *   subjectReference?: list<string>,
 *   sublocation?: string,
 *   timeCreated?: string,
 *   title?: string,
 *   transmissionReference?: string,
 *   usageTerms?: string,
 *   webStatement?: string,
 *   writer?: string,
 *   writerEditor?: string,
 *   xResolution?: float,
 *   yResolution?: float,
 * }
 */
final class EmbeddedMetadata implements BaseModel
{
    use Model;

    #[Api('AboutCvTermCvId', optional: true)]
    public ?string $aboutCvTermCvID;

    #[Api('AboutCvTermId', optional: true)]
    public ?string $aboutCvTermID;

    #[Api('AboutCvTermName', optional: true)]
    public ?string $aboutCvTermName;

    #[Api('AboutCvTermRefinedAbout', optional: true)]
    public ?string $aboutCvTermRefinedAbout;

    #[Api('AdditionalModelInformation', optional: true)]
    public ?string $additionalModelInformation;

    #[Api('ApplicationRecordVersion', optional: true)]
    public ?int $applicationRecordVersion;

    #[Api('Artist', optional: true)]
    public ?string $artist;

    #[Api('ArtworkCircaDateCreated', optional: true)]
    public ?string $artworkCircaDateCreated;

    #[Api('ArtworkContentDescription', optional: true)]
    public ?string $artworkContentDescription;

    #[Api('ArtworkContributionDescription', optional: true)]
    public ?string $artworkContributionDescription;

    #[Api('ArtworkCopyrightNotice', optional: true)]
    public ?string $artworkCopyrightNotice;

    #[Api('ArtworkCopyrightOwnerID', optional: true)]
    public ?string $artworkCopyrightOwnerID;

    #[Api('ArtworkCopyrightOwnerName', optional: true)]
    public ?string $artworkCopyrightOwnerName;

    /** @var null|list<string> $artworkCreator */
    #[Api('ArtworkCreator', type: new ListOf('string'), optional: true)]
    public ?array $artworkCreator;

    /** @var null|list<string> $artworkCreatorID */
    #[Api('ArtworkCreatorID', type: new ListOf('string'), optional: true)]
    public ?array $artworkCreatorID;

    #[Api('ArtworkDateCreated', optional: true)]
    public ?\DateTimeInterface $artworkDateCreated;

    #[Api('ArtworkLicensorID', optional: true)]
    public ?string $artworkLicensorID;

    #[Api('ArtworkLicensorName', optional: true)]
    public ?string $artworkLicensorName;

    #[Api('ArtworkPhysicalDescription', optional: true)]
    public ?string $artworkPhysicalDescription;

    #[Api('ArtworkSource', optional: true)]
    public ?string $artworkSource;

    #[Api('ArtworkSourceInventoryNo', optional: true)]
    public ?string $artworkSourceInventoryNo;

    #[Api('ArtworkSourceInvURL', optional: true)]
    public ?string $artworkSourceInvURL;

    /** @var null|list<string> $artworkStylePeriod */
    #[Api('ArtworkStylePeriod', type: new ListOf('string'), optional: true)]
    public ?array $artworkStylePeriod;

    #[Api('ArtworkTitle', optional: true)]
    public ?string $artworkTitle;

    #[Api('AuthorsPosition', optional: true)]
    public ?string $authorsPosition;

    #[Api('Byline', optional: true)]
    public ?string $byline;

    #[Api('BylineTitle', optional: true)]
    public ?string $bylineTitle;

    #[Api('Caption', optional: true)]
    public ?string $caption;

    #[Api('CaptionAbstract', optional: true)]
    public ?string $captionAbstract;

    #[Api('CaptionWriter', optional: true)]
    public ?string $captionWriter;

    #[Api('City', optional: true)]
    public ?string $city;

    #[Api('ColorSpace', optional: true)]
    public ?string $colorSpace;

    #[Api('ComponentsConfiguration', optional: true)]
    public ?string $componentsConfiguration;

    #[Api('Copyright', optional: true)]
    public ?string $copyright;

    #[Api('CopyrightNotice', optional: true)]
    public ?string $copyrightNotice;

    /** @var null|list<string> $copyrightOwnerID */
    #[Api('CopyrightOwnerID', type: new ListOf('string'), optional: true)]
    public ?array $copyrightOwnerID;

    /** @var null|list<string> $copyrightOwnerName */
    #[Api('CopyrightOwnerName', type: new ListOf('string'), optional: true)]
    public ?array $copyrightOwnerName;

    #[Api('Country', optional: true)]
    public ?string $country;

    #[Api('CountryCode', optional: true)]
    public ?string $countryCode;

    #[Api('CountryPrimaryLocationCode', optional: true)]
    public ?string $countryPrimaryLocationCode;

    #[Api('CountryPrimaryLocationName', optional: true)]
    public ?string $countryPrimaryLocationName;

    #[Api('Creator', optional: true)]
    public ?string $creator;

    #[Api('CreatorAddress', optional: true)]
    public ?string $creatorAddress;

    #[Api('CreatorCity', optional: true)]
    public ?string $creatorCity;

    #[Api('CreatorCountry', optional: true)]
    public ?string $creatorCountry;

    #[Api('CreatorPostalCode', optional: true)]
    public ?string $creatorPostalCode;

    #[Api('CreatorRegion', optional: true)]
    public ?string $creatorRegion;

    #[Api('CreatorWorkEmail', optional: true)]
    public ?string $creatorWorkEmail;

    #[Api('CreatorWorkTelephone', optional: true)]
    public ?string $creatorWorkTelephone;

    #[Api('CreatorWorkURL', optional: true)]
    public ?string $creatorWorkURL;

    #[Api('Credit', optional: true)]
    public ?string $credit;

    #[Api('DateCreated', optional: true)]
    public ?\DateTimeInterface $dateCreated;

    #[Api('DateTimeCreated', optional: true)]
    public ?\DateTimeInterface $dateTimeCreated;

    #[Api('DateTimeOriginal', optional: true)]
    public ?\DateTimeInterface $dateTimeOriginal;

    #[Api('Description', optional: true)]
    public ?string $description;

    #[Api('DigitalImageGUID', optional: true)]
    public ?string $digitalImageGuid;

    #[Api('DigitalSourceType', optional: true)]
    public ?string $digitalSourceType;

    #[Api('EmbeddedEncodedRightsExpr', optional: true)]
    public ?string $embeddedEncodedRightsExpr;

    #[Api('EmbeddedEncodedRightsExprLangID', optional: true)]
    public ?string $embeddedEncodedRightsExprLangID;

    #[Api('EmbeddedEncodedRightsExprType', optional: true)]
    public ?string $embeddedEncodedRightsExprType;

    #[Api('Event', optional: true)]
    public ?string $event;

    #[Api('ExifVersion', optional: true)]
    public ?string $exifVersion;

    #[Api('FlashpixVersion', optional: true)]
    public ?string $flashpixVersion;

    #[Api('GenreCvId', optional: true)]
    public ?string $genreCvID;

    #[Api('GenreCvTermId', optional: true)]
    public ?string $genreCvTermID;

    #[Api('GenreCvTermName', optional: true)]
    public ?string $genreCvTermName;

    #[Api('GenreCvTermRefinedAbout', optional: true)]
    public ?string $genreCvTermRefinedAbout;

    #[Api('Headline', optional: true)]
    public ?string $headline;

    #[Api('ImageCreatorID', optional: true)]
    public ?string $imageCreatorID;

    #[Api('ImageCreatorImageID', optional: true)]
    public ?string $imageCreatorImageID;

    #[Api('ImageCreatorName', optional: true)]
    public ?string $imageCreatorName;

    #[Api('ImageDescription', optional: true)]
    public ?string $imageDescription;

    /** @var null|list<float> $imageRegionBoundaryH */
    #[Api('ImageRegionBoundaryH', type: new ListOf('float'), optional: true)]
    public ?array $imageRegionBoundaryH;

    /** @var null|list<float> $imageRegionBoundaryRx */
    #[Api('ImageRegionBoundaryRx', type: new ListOf('float'), optional: true)]
    public ?array $imageRegionBoundaryRx;

    /** @var null|list<string> $imageRegionBoundaryShape */
    #[Api('ImageRegionBoundaryShape', type: new ListOf('string'), optional: true)]
    public ?array $imageRegionBoundaryShape;

    /** @var null|list<string> $imageRegionBoundaryUnit */
    #[Api('ImageRegionBoundaryUnit', type: new ListOf('string'), optional: true)]
    public ?array $imageRegionBoundaryUnit;

    /** @var null|list<float> $imageRegionBoundaryVerticesX */
    #[Api(
        'ImageRegionBoundaryVerticesX',
        type: new ListOf('float'),
        optional: true
    )]
    public ?array $imageRegionBoundaryVerticesX;

    /** @var null|list<float> $imageRegionBoundaryVerticesY */
    #[Api(
        'ImageRegionBoundaryVerticesY',
        type: new ListOf('float'),
        optional: true
    )]
    public ?array $imageRegionBoundaryVerticesY;

    /** @var null|list<float> $imageRegionBoundaryW */
    #[Api('ImageRegionBoundaryW', type: new ListOf('float'), optional: true)]
    public ?array $imageRegionBoundaryW;

    /** @var null|list<float> $imageRegionBoundaryX */
    #[Api('ImageRegionBoundaryX', type: new ListOf('float'), optional: true)]
    public ?array $imageRegionBoundaryX;

    /** @var null|list<float> $imageRegionBoundaryY */
    #[Api('ImageRegionBoundaryY', type: new ListOf('float'), optional: true)]
    public ?array $imageRegionBoundaryY;

    /** @var null|list<string> $imageRegionCtypeIdentifier */
    #[Api(
        'ImageRegionCtypeIdentifier',
        type: new ListOf('string'),
        optional: true
    )]
    public ?array $imageRegionCtypeIdentifier;

    /** @var null|list<string> $imageRegionCtypeName */
    #[Api('ImageRegionCtypeName', type: new ListOf('string'), optional: true)]
    public ?array $imageRegionCtypeName;

    /** @var null|list<string> $imageRegionID */
    #[Api('ImageRegionID', type: new ListOf('string'), optional: true)]
    public ?array $imageRegionID;

    /** @var null|list<string> $imageRegionName */
    #[Api('ImageRegionName', type: new ListOf('string'), optional: true)]
    public ?array $imageRegionName;

    /** @var null|list<string> $imageRegionOrganisationInImageName */
    #[Api(
        'ImageRegionOrganisationInImageName',
        type: new ListOf('string'),
        optional: true,
    )]
    public ?array $imageRegionOrganisationInImageName;

    /** @var null|list<string> $imageRegionPersonInImage */
    #[Api('ImageRegionPersonInImage', type: new ListOf('string'), optional: true)]
    public ?array $imageRegionPersonInImage;

    /** @var null|list<string> $imageRegionRoleIdentifier */
    #[Api(
        'ImageRegionRoleIdentifier',
        type: new ListOf('string'),
        optional: true
    )]
    public ?array $imageRegionRoleIdentifier;

    /** @var null|list<string> $imageRegionRoleName */
    #[Api('ImageRegionRoleName', type: new ListOf('string'), optional: true)]
    public ?array $imageRegionRoleName;

    #[Api('ImageSupplierID', optional: true)]
    public ?string $imageSupplierID;

    #[Api('ImageSupplierImageID', optional: true)]
    public ?string $imageSupplierImageID;

    #[Api('ImageSupplierName', optional: true)]
    public ?string $imageSupplierName;

    #[Api('Instructions', optional: true)]
    public ?string $instructions;

    #[Api('IntellectualGenre', optional: true)]
    public ?string $intellectualGenre;

    /** @var null|list<string> $keywords */
    #[Api('Keywords', type: new ListOf('string'), optional: true)]
    public ?array $keywords;

    /** @var null|list<string> $licensorCity */
    #[Api('LicensorCity', type: new ListOf('string'), optional: true)]
    public ?array $licensorCity;

    /** @var null|list<string> $licensorCountry */
    #[Api('LicensorCountry', type: new ListOf('string'), optional: true)]
    public ?array $licensorCountry;

    /** @var null|list<string> $licensorEmail */
    #[Api('LicensorEmail', type: new ListOf('string'), optional: true)]
    public ?array $licensorEmail;

    /** @var null|list<string> $licensorExtendedAddress */
    #[Api('LicensorExtendedAddress', type: new ListOf('string'), optional: true)]
    public ?array $licensorExtendedAddress;

    /** @var null|list<string> $licensorID */
    #[Api('LicensorID', type: new ListOf('string'), optional: true)]
    public ?array $licensorID;

    /** @var null|list<string> $licensorName */
    #[Api('LicensorName', type: new ListOf('string'), optional: true)]
    public ?array $licensorName;

    /** @var null|list<string> $licensorPostalCode */
    #[Api('LicensorPostalCode', type: new ListOf('string'), optional: true)]
    public ?array $licensorPostalCode;

    /** @var null|list<string> $licensorRegion */
    #[Api('LicensorRegion', type: new ListOf('string'), optional: true)]
    public ?array $licensorRegion;

    /** @var null|list<string> $licensorStreetAddress */
    #[Api('LicensorStreetAddress', type: new ListOf('string'), optional: true)]
    public ?array $licensorStreetAddress;

    /** @var null|list<string> $licensorTelephone1 */
    #[Api('LicensorTelephone1', type: new ListOf('string'), optional: true)]
    public ?array $licensorTelephone1;

    /** @var null|list<string> $licensorTelephone2 */
    #[Api('LicensorTelephone2', type: new ListOf('string'), optional: true)]
    public ?array $licensorTelephone2;

    /** @var null|list<string> $licensorURL */
    #[Api('LicensorURL', type: new ListOf('string'), optional: true)]
    public ?array $licensorURL;

    #[Api('LinkedEncodedRightsExpr', optional: true)]
    public ?string $linkedEncodedRightsExpr;

    #[Api('LinkedEncodedRightsExprLangID', optional: true)]
    public ?string $linkedEncodedRightsExprLangID;

    #[Api('LinkedEncodedRightsExprType', optional: true)]
    public ?string $linkedEncodedRightsExprType;

    #[Api('Location', optional: true)]
    public ?string $location;

    #[Api('LocationCreatedCity', optional: true)]
    public ?string $locationCreatedCity;

    #[Api('LocationCreatedCountryCode', optional: true)]
    public ?string $locationCreatedCountryCode;

    #[Api('LocationCreatedCountryName', optional: true)]
    public ?string $locationCreatedCountryName;

    #[Api('LocationCreatedGPSAltitude', optional: true)]
    public ?string $locationCreatedGpsAltitude;

    #[Api('LocationCreatedGPSLatitude', optional: true)]
    public ?string $locationCreatedGpsLatitude;

    #[Api('LocationCreatedGPSLongitude', optional: true)]
    public ?string $locationCreatedGpsLongitude;

    #[Api('LocationCreatedLocationId', optional: true)]
    public ?string $locationCreatedLocationID;

    #[Api('LocationCreatedLocationName', optional: true)]
    public ?string $locationCreatedLocationName;

    #[Api('LocationCreatedProvinceState', optional: true)]
    public ?string $locationCreatedProvinceState;

    #[Api('LocationCreatedSublocation', optional: true)]
    public ?string $locationCreatedSublocation;

    #[Api('LocationCreatedWorldRegion', optional: true)]
    public ?string $locationCreatedWorldRegion;

    /** @var null|list<string> $locationShownCity */
    #[Api('LocationShownCity', type: new ListOf('string'), optional: true)]
    public ?array $locationShownCity;

    /** @var null|list<string> $locationShownCountryCode */
    #[Api('LocationShownCountryCode', type: new ListOf('string'), optional: true)]
    public ?array $locationShownCountryCode;

    /** @var null|list<string> $locationShownCountryName */
    #[Api('LocationShownCountryName', type: new ListOf('string'), optional: true)]
    public ?array $locationShownCountryName;

    /** @var null|list<string> $locationShownGpsAltitude */
    #[Api('LocationShownGPSAltitude', type: new ListOf('string'), optional: true)]
    public ?array $locationShownGpsAltitude;

    /** @var null|list<string> $locationShownGpsLatitude */
    #[Api('LocationShownGPSLatitude', type: new ListOf('string'), optional: true)]
    public ?array $locationShownGpsLatitude;

    /** @var null|list<string> $locationShownGpsLongitude */
    #[Api(
        'LocationShownGPSLongitude',
        type: new ListOf('string'),
        optional: true
    )]
    public ?array $locationShownGpsLongitude;

    /** @var null|list<string> $locationShownLocationID */
    #[Api('LocationShownLocationId', type: new ListOf('string'), optional: true)]
    public ?array $locationShownLocationID;

    /** @var null|list<string> $locationShownLocationName */
    #[Api(
        'LocationShownLocationName',
        type: new ListOf('string'),
        optional: true
    )]
    public ?array $locationShownLocationName;

    /** @var null|list<string> $locationShownProvinceState */
    #[Api(
        'LocationShownProvinceState',
        type: new ListOf('string'),
        optional: true
    )]
    public ?array $locationShownProvinceState;

    /** @var null|list<string> $locationShownSublocation */
    #[Api('LocationShownSublocation', type: new ListOf('string'), optional: true)]
    public ?array $locationShownSublocation;

    /** @var null|list<string> $locationShownWorldRegion */
    #[Api('LocationShownWorldRegion', type: new ListOf('string'), optional: true)]
    public ?array $locationShownWorldRegion;

    #[Api('MaxAvailHeight', optional: true)]
    public ?float $maxAvailHeight;

    #[Api('MaxAvailWidth', optional: true)]
    public ?float $maxAvailWidth;

    /** @var null|list<float> $modelAge */
    #[Api('ModelAge', type: new ListOf('float'), optional: true)]
    public ?array $modelAge;

    /** @var null|list<string> $modelReleaseID */
    #[Api('ModelReleaseID', type: new ListOf('string'), optional: true)]
    public ?array $modelReleaseID;

    #[Api('ObjectAttributeReference', optional: true)]
    public ?string $objectAttributeReference;

    #[Api('ObjectName', optional: true)]
    public ?string $objectName;

    #[Api('OffsetTimeOriginal', optional: true)]
    public ?string $offsetTimeOriginal;

    /** @var null|list<string> $organisationInImageCode */
    #[Api('OrganisationInImageCode', type: new ListOf('string'), optional: true)]
    public ?array $organisationInImageCode;

    /** @var null|list<string> $organisationInImageName */
    #[Api('OrganisationInImageName', type: new ListOf('string'), optional: true)]
    public ?array $organisationInImageName;

    #[Api('Orientation', optional: true)]
    public ?string $orientation;

    #[Api('OriginalTransmissionReference', optional: true)]
    public ?string $originalTransmissionReference;

    /** @var null|list<string> $personInImage */
    #[Api('PersonInImage', type: new ListOf('string'), optional: true)]
    public ?array $personInImage;

    /** @var null|list<string> $personInImageCvTermCvID */
    #[Api('PersonInImageCvTermCvId', type: new ListOf('string'), optional: true)]
    public ?array $personInImageCvTermCvID;

    /** @var null|list<string> $personInImageCvTermID */
    #[Api('PersonInImageCvTermId', type: new ListOf('string'), optional: true)]
    public ?array $personInImageCvTermID;

    /** @var null|list<string> $personInImageCvTermName */
    #[Api('PersonInImageCvTermName', type: new ListOf('string'), optional: true)]
    public ?array $personInImageCvTermName;

    /** @var null|list<string> $personInImageCvTermRefinedAbout */
    #[Api(
        'PersonInImageCvTermRefinedAbout',
        type: new ListOf('string'),
        optional: true,
    )]
    public ?array $personInImageCvTermRefinedAbout;

    /** @var null|list<string> $personInImageDescription */
    #[Api('PersonInImageDescription', type: new ListOf('string'), optional: true)]
    public ?array $personInImageDescription;

    /** @var null|list<string> $personInImageID */
    #[Api('PersonInImageId', type: new ListOf('string'), optional: true)]
    public ?array $personInImageID;

    /** @var null|list<string> $personInImageName */
    #[Api('PersonInImageName', type: new ListOf('string'), optional: true)]
    public ?array $personInImageName;

    /** @var null|list<string> $productInImageDescription */
    #[Api(
        'ProductInImageDescription',
        type: new ListOf('string'),
        optional: true
    )]
    public ?array $productInImageDescription;

    /** @var null|list<float> $productInImageGtin */
    #[Api('ProductInImageGTIN', type: new ListOf('float'), optional: true)]
    public ?array $productInImageGtin;

    /** @var null|list<string> $productInImageName */
    #[Api('ProductInImageName', type: new ListOf('string'), optional: true)]
    public ?array $productInImageName;

    /** @var null|list<string> $propertyReleaseID */
    #[Api('PropertyReleaseID', type: new ListOf('string'), optional: true)]
    public ?array $propertyReleaseID;

    #[Api('ProvinceState', optional: true)]
    public ?string $provinceState;

    #[Api('Rating', optional: true)]
    public ?int $rating;

    /** @var null|list<string> $registryEntryRole */
    #[Api('RegistryEntryRole', type: new ListOf('string'), optional: true)]
    public ?array $registryEntryRole;

    /** @var null|list<string> $registryItemID */
    #[Api('RegistryItemID', type: new ListOf('string'), optional: true)]
    public ?array $registryItemID;

    /** @var null|list<string> $registryOrganisationID */
    #[Api('RegistryOrganisationID', type: new ListOf('string'), optional: true)]
    public ?array $registryOrganisationID;

    #[Api('ResolutionUnit', optional: true)]
    public ?string $resolutionUnit;

    #[Api('Rights', optional: true)]
    public ?string $rights;

    /** @var null|list<string> $scene */
    #[Api('Scene', type: new ListOf('string'), optional: true)]
    public ?array $scene;

    #[Api('Source', optional: true)]
    public ?string $source;

    #[Api('SpecialInstructions', optional: true)]
    public ?string $specialInstructions;

    #[Api('State', optional: true)]
    public ?string $state;

    /** @var null|list<string> $subject */
    #[Api('Subject', type: new ListOf('string'), optional: true)]
    public ?array $subject;

    /** @var null|list<string> $subjectCode */
    #[Api('SubjectCode', type: new ListOf('string'), optional: true)]
    public ?array $subjectCode;

    /** @var null|list<string> $subjectReference */
    #[Api('SubjectReference', type: new ListOf('string'), optional: true)]
    public ?array $subjectReference;

    #[Api('Sublocation', optional: true)]
    public ?string $sublocation;

    #[Api('TimeCreated', optional: true)]
    public ?string $timeCreated;

    #[Api('Title', optional: true)]
    public ?string $title;

    #[Api('TransmissionReference', optional: true)]
    public ?string $transmissionReference;

    #[Api('UsageTerms', optional: true)]
    public ?string $usageTerms;

    #[Api('WebStatement', optional: true)]
    public ?string $webStatement;

    #[Api('Writer', optional: true)]
    public ?string $writer;

    #[Api('WriterEditor', optional: true)]
    public ?string $writerEditor;

    #[Api('XResolution', optional: true)]
    public ?float $xResolution;

    #[Api('YResolution', optional: true)]
    public ?float $yResolution;

    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param null|list<string> $artworkCreator
     * @param null|list<string> $artworkCreatorID
     * @param null|list<string> $artworkStylePeriod
     * @param null|list<string> $copyrightOwnerID
     * @param null|list<string> $copyrightOwnerName
     * @param null|list<float> $imageRegionBoundaryH
     * @param null|list<float> $imageRegionBoundaryRx
     * @param null|list<string> $imageRegionBoundaryShape
     * @param null|list<string> $imageRegionBoundaryUnit
     * @param null|list<float> $imageRegionBoundaryVerticesX
     * @param null|list<float> $imageRegionBoundaryVerticesY
     * @param null|list<float> $imageRegionBoundaryW
     * @param null|list<float> $imageRegionBoundaryX
     * @param null|list<float> $imageRegionBoundaryY
     * @param null|list<string> $imageRegionCtypeIdentifier
     * @param null|list<string> $imageRegionCtypeName
     * @param null|list<string> $imageRegionID
     * @param null|list<string> $imageRegionName
     * @param null|list<string> $imageRegionOrganisationInImageName
     * @param null|list<string> $imageRegionPersonInImage
     * @param null|list<string> $imageRegionRoleIdentifier
     * @param null|list<string> $imageRegionRoleName
     * @param null|list<string> $keywords
     * @param null|list<string> $licensorCity
     * @param null|list<string> $licensorCountry
     * @param null|list<string> $licensorEmail
     * @param null|list<string> $licensorExtendedAddress
     * @param null|list<string> $licensorID
     * @param null|list<string> $licensorName
     * @param null|list<string> $licensorPostalCode
     * @param null|list<string> $licensorRegion
     * @param null|list<string> $licensorStreetAddress
     * @param null|list<string> $licensorTelephone1
     * @param null|list<string> $licensorTelephone2
     * @param null|list<string> $licensorURL
     * @param null|list<string> $locationShownCity
     * @param null|list<string> $locationShownCountryCode
     * @param null|list<string> $locationShownCountryName
     * @param null|list<string> $locationShownGpsAltitude
     * @param null|list<string> $locationShownGpsLatitude
     * @param null|list<string> $locationShownGpsLongitude
     * @param null|list<string> $locationShownLocationID
     * @param null|list<string> $locationShownLocationName
     * @param null|list<string> $locationShownProvinceState
     * @param null|list<string> $locationShownSublocation
     * @param null|list<string> $locationShownWorldRegion
     * @param null|list<float> $modelAge
     * @param null|list<string> $modelReleaseID
     * @param null|list<string> $organisationInImageCode
     * @param null|list<string> $organisationInImageName
     * @param null|list<string> $personInImage
     * @param null|list<string> $personInImageCvTermCvID
     * @param null|list<string> $personInImageCvTermID
     * @param null|list<string> $personInImageCvTermName
     * @param null|list<string> $personInImageCvTermRefinedAbout
     * @param null|list<string> $personInImageDescription
     * @param null|list<string> $personInImageID
     * @param null|list<string> $personInImageName
     * @param null|list<string> $productInImageDescription
     * @param null|list<float> $productInImageGtin
     * @param null|list<string> $productInImageName
     * @param null|list<string> $propertyReleaseID
     * @param null|list<string> $registryEntryRole
     * @param null|list<string> $registryItemID
     * @param null|list<string> $registryOrganisationID
     * @param null|list<string> $scene
     * @param null|list<string> $subject
     * @param null|list<string> $subjectCode
     * @param null|list<string> $subjectReference
     */
    public static function with(
        ?string $aboutCvTermCvID = null,
        ?string $aboutCvTermID = null,
        ?string $aboutCvTermName = null,
        ?string $aboutCvTermRefinedAbout = null,
        ?string $additionalModelInformation = null,
        ?int $applicationRecordVersion = null,
        ?string $artist = null,
        ?string $artworkCircaDateCreated = null,
        ?string $artworkContentDescription = null,
        ?string $artworkContributionDescription = null,
        ?string $artworkCopyrightNotice = null,
        ?string $artworkCopyrightOwnerID = null,
        ?string $artworkCopyrightOwnerName = null,
        ?array $artworkCreator = null,
        ?array $artworkCreatorID = null,
        ?\DateTimeInterface $artworkDateCreated = null,
        ?string $artworkLicensorID = null,
        ?string $artworkLicensorName = null,
        ?string $artworkPhysicalDescription = null,
        ?string $artworkSource = null,
        ?string $artworkSourceInventoryNo = null,
        ?string $artworkSourceInvURL = null,
        ?array $artworkStylePeriod = null,
        ?string $artworkTitle = null,
        ?string $authorsPosition = null,
        ?string $byline = null,
        ?string $bylineTitle = null,
        ?string $caption = null,
        ?string $captionAbstract = null,
        ?string $captionWriter = null,
        ?string $city = null,
        ?string $colorSpace = null,
        ?string $componentsConfiguration = null,
        ?string $copyright = null,
        ?string $copyrightNotice = null,
        ?array $copyrightOwnerID = null,
        ?array $copyrightOwnerName = null,
        ?string $country = null,
        ?string $countryCode = null,
        ?string $countryPrimaryLocationCode = null,
        ?string $countryPrimaryLocationName = null,
        ?string $creator = null,
        ?string $creatorAddress = null,
        ?string $creatorCity = null,
        ?string $creatorCountry = null,
        ?string $creatorPostalCode = null,
        ?string $creatorRegion = null,
        ?string $creatorWorkEmail = null,
        ?string $creatorWorkTelephone = null,
        ?string $creatorWorkURL = null,
        ?string $credit = null,
        ?\DateTimeInterface $dateCreated = null,
        ?\DateTimeInterface $dateTimeCreated = null,
        ?\DateTimeInterface $dateTimeOriginal = null,
        ?string $description = null,
        ?string $digitalImageGuid = null,
        ?string $digitalSourceType = null,
        ?string $embeddedEncodedRightsExpr = null,
        ?string $embeddedEncodedRightsExprLangID = null,
        ?string $embeddedEncodedRightsExprType = null,
        ?string $event = null,
        ?string $exifVersion = null,
        ?string $flashpixVersion = null,
        ?string $genreCvID = null,
        ?string $genreCvTermID = null,
        ?string $genreCvTermName = null,
        ?string $genreCvTermRefinedAbout = null,
        ?string $headline = null,
        ?string $imageCreatorID = null,
        ?string $imageCreatorImageID = null,
        ?string $imageCreatorName = null,
        ?string $imageDescription = null,
        ?array $imageRegionBoundaryH = null,
        ?array $imageRegionBoundaryRx = null,
        ?array $imageRegionBoundaryShape = null,
        ?array $imageRegionBoundaryUnit = null,
        ?array $imageRegionBoundaryVerticesX = null,
        ?array $imageRegionBoundaryVerticesY = null,
        ?array $imageRegionBoundaryW = null,
        ?array $imageRegionBoundaryX = null,
        ?array $imageRegionBoundaryY = null,
        ?array $imageRegionCtypeIdentifier = null,
        ?array $imageRegionCtypeName = null,
        ?array $imageRegionID = null,
        ?array $imageRegionName = null,
        ?array $imageRegionOrganisationInImageName = null,
        ?array $imageRegionPersonInImage = null,
        ?array $imageRegionRoleIdentifier = null,
        ?array $imageRegionRoleName = null,
        ?string $imageSupplierID = null,
        ?string $imageSupplierImageID = null,
        ?string $imageSupplierName = null,
        ?string $instructions = null,
        ?string $intellectualGenre = null,
        ?array $keywords = null,
        ?array $licensorCity = null,
        ?array $licensorCountry = null,
        ?array $licensorEmail = null,
        ?array $licensorExtendedAddress = null,
        ?array $licensorID = null,
        ?array $licensorName = null,
        ?array $licensorPostalCode = null,
        ?array $licensorRegion = null,
        ?array $licensorStreetAddress = null,
        ?array $licensorTelephone1 = null,
        ?array $licensorTelephone2 = null,
        ?array $licensorURL = null,
        ?string $linkedEncodedRightsExpr = null,
        ?string $linkedEncodedRightsExprLangID = null,
        ?string $linkedEncodedRightsExprType = null,
        ?string $location = null,
        ?string $locationCreatedCity = null,
        ?string $locationCreatedCountryCode = null,
        ?string $locationCreatedCountryName = null,
        ?string $locationCreatedGpsAltitude = null,
        ?string $locationCreatedGpsLatitude = null,
        ?string $locationCreatedGpsLongitude = null,
        ?string $locationCreatedLocationID = null,
        ?string $locationCreatedLocationName = null,
        ?string $locationCreatedProvinceState = null,
        ?string $locationCreatedSublocation = null,
        ?string $locationCreatedWorldRegion = null,
        ?array $locationShownCity = null,
        ?array $locationShownCountryCode = null,
        ?array $locationShownCountryName = null,
        ?array $locationShownGpsAltitude = null,
        ?array $locationShownGpsLatitude = null,
        ?array $locationShownGpsLongitude = null,
        ?array $locationShownLocationID = null,
        ?array $locationShownLocationName = null,
        ?array $locationShownProvinceState = null,
        ?array $locationShownSublocation = null,
        ?array $locationShownWorldRegion = null,
        ?float $maxAvailHeight = null,
        ?float $maxAvailWidth = null,
        ?array $modelAge = null,
        ?array $modelReleaseID = null,
        ?string $objectAttributeReference = null,
        ?string $objectName = null,
        ?string $offsetTimeOriginal = null,
        ?array $organisationInImageCode = null,
        ?array $organisationInImageName = null,
        ?string $orientation = null,
        ?string $originalTransmissionReference = null,
        ?array $personInImage = null,
        ?array $personInImageCvTermCvID = null,
        ?array $personInImageCvTermID = null,
        ?array $personInImageCvTermName = null,
        ?array $personInImageCvTermRefinedAbout = null,
        ?array $personInImageDescription = null,
        ?array $personInImageID = null,
        ?array $personInImageName = null,
        ?array $productInImageDescription = null,
        ?array $productInImageGtin = null,
        ?array $productInImageName = null,
        ?array $propertyReleaseID = null,
        ?string $provinceState = null,
        ?int $rating = null,
        ?array $registryEntryRole = null,
        ?array $registryItemID = null,
        ?array $registryOrganisationID = null,
        ?string $resolutionUnit = null,
        ?string $rights = null,
        ?array $scene = null,
        ?string $source = null,
        ?string $specialInstructions = null,
        ?string $state = null,
        ?array $subject = null,
        ?array $subjectCode = null,
        ?array $subjectReference = null,
        ?string $sublocation = null,
        ?string $timeCreated = null,
        ?string $title = null,
        ?string $transmissionReference = null,
        ?string $usageTerms = null,
        ?string $webStatement = null,
        ?string $writer = null,
        ?string $writerEditor = null,
        ?float $xResolution = null,
        ?float $yResolution = null,
    ): self {
        $obj = new self;

        null !== $aboutCvTermCvID && $obj->aboutCvTermCvID = $aboutCvTermCvID;
        null !== $aboutCvTermID && $obj->aboutCvTermID = $aboutCvTermID;
        null !== $aboutCvTermName && $obj->aboutCvTermName = $aboutCvTermName;
        null !== $aboutCvTermRefinedAbout && $obj->aboutCvTermRefinedAbout = $aboutCvTermRefinedAbout;
        null !== $additionalModelInformation && $obj->additionalModelInformation = $additionalModelInformation;
        null !== $applicationRecordVersion && $obj->applicationRecordVersion = $applicationRecordVersion;
        null !== $artist && $obj->artist = $artist;
        null !== $artworkCircaDateCreated && $obj->artworkCircaDateCreated = $artworkCircaDateCreated;
        null !== $artworkContentDescription && $obj->artworkContentDescription = $artworkContentDescription;
        null !== $artworkContributionDescription && $obj->artworkContributionDescription = $artworkContributionDescription;
        null !== $artworkCopyrightNotice && $obj->artworkCopyrightNotice = $artworkCopyrightNotice;
        null !== $artworkCopyrightOwnerID && $obj->artworkCopyrightOwnerID = $artworkCopyrightOwnerID;
        null !== $artworkCopyrightOwnerName && $obj->artworkCopyrightOwnerName = $artworkCopyrightOwnerName;
        null !== $artworkCreator && $obj->artworkCreator = $artworkCreator;
        null !== $artworkCreatorID && $obj->artworkCreatorID = $artworkCreatorID;
        null !== $artworkDateCreated && $obj->artworkDateCreated = $artworkDateCreated;
        null !== $artworkLicensorID && $obj->artworkLicensorID = $artworkLicensorID;
        null !== $artworkLicensorName && $obj->artworkLicensorName = $artworkLicensorName;
        null !== $artworkPhysicalDescription && $obj->artworkPhysicalDescription = $artworkPhysicalDescription;
        null !== $artworkSource && $obj->artworkSource = $artworkSource;
        null !== $artworkSourceInventoryNo && $obj->artworkSourceInventoryNo = $artworkSourceInventoryNo;
        null !== $artworkSourceInvURL && $obj->artworkSourceInvURL = $artworkSourceInvURL;
        null !== $artworkStylePeriod && $obj->artworkStylePeriod = $artworkStylePeriod;
        null !== $artworkTitle && $obj->artworkTitle = $artworkTitle;
        null !== $authorsPosition && $obj->authorsPosition = $authorsPosition;
        null !== $byline && $obj->byline = $byline;
        null !== $bylineTitle && $obj->bylineTitle = $bylineTitle;
        null !== $caption && $obj->caption = $caption;
        null !== $captionAbstract && $obj->captionAbstract = $captionAbstract;
        null !== $captionWriter && $obj->captionWriter = $captionWriter;
        null !== $city && $obj->city = $city;
        null !== $colorSpace && $obj->colorSpace = $colorSpace;
        null !== $componentsConfiguration && $obj->componentsConfiguration = $componentsConfiguration;
        null !== $copyright && $obj->copyright = $copyright;
        null !== $copyrightNotice && $obj->copyrightNotice = $copyrightNotice;
        null !== $copyrightOwnerID && $obj->copyrightOwnerID = $copyrightOwnerID;
        null !== $copyrightOwnerName && $obj->copyrightOwnerName = $copyrightOwnerName;
        null !== $country && $obj->country = $country;
        null !== $countryCode && $obj->countryCode = $countryCode;
        null !== $countryPrimaryLocationCode && $obj->countryPrimaryLocationCode = $countryPrimaryLocationCode;
        null !== $countryPrimaryLocationName && $obj->countryPrimaryLocationName = $countryPrimaryLocationName;
        null !== $creator && $obj->creator = $creator;
        null !== $creatorAddress && $obj->creatorAddress = $creatorAddress;
        null !== $creatorCity && $obj->creatorCity = $creatorCity;
        null !== $creatorCountry && $obj->creatorCountry = $creatorCountry;
        null !== $creatorPostalCode && $obj->creatorPostalCode = $creatorPostalCode;
        null !== $creatorRegion && $obj->creatorRegion = $creatorRegion;
        null !== $creatorWorkEmail && $obj->creatorWorkEmail = $creatorWorkEmail;
        null !== $creatorWorkTelephone && $obj->creatorWorkTelephone = $creatorWorkTelephone;
        null !== $creatorWorkURL && $obj->creatorWorkURL = $creatorWorkURL;
        null !== $credit && $obj->credit = $credit;
        null !== $dateCreated && $obj->dateCreated = $dateCreated;
        null !== $dateTimeCreated && $obj->dateTimeCreated = $dateTimeCreated;
        null !== $dateTimeOriginal && $obj->dateTimeOriginal = $dateTimeOriginal;
        null !== $description && $obj->description = $description;
        null !== $digitalImageGuid && $obj->digitalImageGuid = $digitalImageGuid;
        null !== $digitalSourceType && $obj->digitalSourceType = $digitalSourceType;
        null !== $embeddedEncodedRightsExpr && $obj->embeddedEncodedRightsExpr = $embeddedEncodedRightsExpr;
        null !== $embeddedEncodedRightsExprLangID && $obj->embeddedEncodedRightsExprLangID = $embeddedEncodedRightsExprLangID;
        null !== $embeddedEncodedRightsExprType && $obj->embeddedEncodedRightsExprType = $embeddedEncodedRightsExprType;
        null !== $event && $obj->event = $event;
        null !== $exifVersion && $obj->exifVersion = $exifVersion;
        null !== $flashpixVersion && $obj->flashpixVersion = $flashpixVersion;
        null !== $genreCvID && $obj->genreCvID = $genreCvID;
        null !== $genreCvTermID && $obj->genreCvTermID = $genreCvTermID;
        null !== $genreCvTermName && $obj->genreCvTermName = $genreCvTermName;
        null !== $genreCvTermRefinedAbout && $obj->genreCvTermRefinedAbout = $genreCvTermRefinedAbout;
        null !== $headline && $obj->headline = $headline;
        null !== $imageCreatorID && $obj->imageCreatorID = $imageCreatorID;
        null !== $imageCreatorImageID && $obj->imageCreatorImageID = $imageCreatorImageID;
        null !== $imageCreatorName && $obj->imageCreatorName = $imageCreatorName;
        null !== $imageDescription && $obj->imageDescription = $imageDescription;
        null !== $imageRegionBoundaryH && $obj->imageRegionBoundaryH = $imageRegionBoundaryH;
        null !== $imageRegionBoundaryRx && $obj->imageRegionBoundaryRx = $imageRegionBoundaryRx;
        null !== $imageRegionBoundaryShape && $obj->imageRegionBoundaryShape = $imageRegionBoundaryShape;
        null !== $imageRegionBoundaryUnit && $obj->imageRegionBoundaryUnit = $imageRegionBoundaryUnit;
        null !== $imageRegionBoundaryVerticesX && $obj->imageRegionBoundaryVerticesX = $imageRegionBoundaryVerticesX;
        null !== $imageRegionBoundaryVerticesY && $obj->imageRegionBoundaryVerticesY = $imageRegionBoundaryVerticesY;
        null !== $imageRegionBoundaryW && $obj->imageRegionBoundaryW = $imageRegionBoundaryW;
        null !== $imageRegionBoundaryX && $obj->imageRegionBoundaryX = $imageRegionBoundaryX;
        null !== $imageRegionBoundaryY && $obj->imageRegionBoundaryY = $imageRegionBoundaryY;
        null !== $imageRegionCtypeIdentifier && $obj->imageRegionCtypeIdentifier = $imageRegionCtypeIdentifier;
        null !== $imageRegionCtypeName && $obj->imageRegionCtypeName = $imageRegionCtypeName;
        null !== $imageRegionID && $obj->imageRegionID = $imageRegionID;
        null !== $imageRegionName && $obj->imageRegionName = $imageRegionName;
        null !== $imageRegionOrganisationInImageName && $obj->imageRegionOrganisationInImageName = $imageRegionOrganisationInImageName;
        null !== $imageRegionPersonInImage && $obj->imageRegionPersonInImage = $imageRegionPersonInImage;
        null !== $imageRegionRoleIdentifier && $obj->imageRegionRoleIdentifier = $imageRegionRoleIdentifier;
        null !== $imageRegionRoleName && $obj->imageRegionRoleName = $imageRegionRoleName;
        null !== $imageSupplierID && $obj->imageSupplierID = $imageSupplierID;
        null !== $imageSupplierImageID && $obj->imageSupplierImageID = $imageSupplierImageID;
        null !== $imageSupplierName && $obj->imageSupplierName = $imageSupplierName;
        null !== $instructions && $obj->instructions = $instructions;
        null !== $intellectualGenre && $obj->intellectualGenre = $intellectualGenre;
        null !== $keywords && $obj->keywords = $keywords;
        null !== $licensorCity && $obj->licensorCity = $licensorCity;
        null !== $licensorCountry && $obj->licensorCountry = $licensorCountry;
        null !== $licensorEmail && $obj->licensorEmail = $licensorEmail;
        null !== $licensorExtendedAddress && $obj->licensorExtendedAddress = $licensorExtendedAddress;
        null !== $licensorID && $obj->licensorID = $licensorID;
        null !== $licensorName && $obj->licensorName = $licensorName;
        null !== $licensorPostalCode && $obj->licensorPostalCode = $licensorPostalCode;
        null !== $licensorRegion && $obj->licensorRegion = $licensorRegion;
        null !== $licensorStreetAddress && $obj->licensorStreetAddress = $licensorStreetAddress;
        null !== $licensorTelephone1 && $obj->licensorTelephone1 = $licensorTelephone1;
        null !== $licensorTelephone2 && $obj->licensorTelephone2 = $licensorTelephone2;
        null !== $licensorURL && $obj->licensorURL = $licensorURL;
        null !== $linkedEncodedRightsExpr && $obj->linkedEncodedRightsExpr = $linkedEncodedRightsExpr;
        null !== $linkedEncodedRightsExprLangID && $obj->linkedEncodedRightsExprLangID = $linkedEncodedRightsExprLangID;
        null !== $linkedEncodedRightsExprType && $obj->linkedEncodedRightsExprType = $linkedEncodedRightsExprType;
        null !== $location && $obj->location = $location;
        null !== $locationCreatedCity && $obj->locationCreatedCity = $locationCreatedCity;
        null !== $locationCreatedCountryCode && $obj->locationCreatedCountryCode = $locationCreatedCountryCode;
        null !== $locationCreatedCountryName && $obj->locationCreatedCountryName = $locationCreatedCountryName;
        null !== $locationCreatedGpsAltitude && $obj->locationCreatedGpsAltitude = $locationCreatedGpsAltitude;
        null !== $locationCreatedGpsLatitude && $obj->locationCreatedGpsLatitude = $locationCreatedGpsLatitude;
        null !== $locationCreatedGpsLongitude && $obj->locationCreatedGpsLongitude = $locationCreatedGpsLongitude;
        null !== $locationCreatedLocationID && $obj->locationCreatedLocationID = $locationCreatedLocationID;
        null !== $locationCreatedLocationName && $obj->locationCreatedLocationName = $locationCreatedLocationName;
        null !== $locationCreatedProvinceState && $obj->locationCreatedProvinceState = $locationCreatedProvinceState;
        null !== $locationCreatedSublocation && $obj->locationCreatedSublocation = $locationCreatedSublocation;
        null !== $locationCreatedWorldRegion && $obj->locationCreatedWorldRegion = $locationCreatedWorldRegion;
        null !== $locationShownCity && $obj->locationShownCity = $locationShownCity;
        null !== $locationShownCountryCode && $obj->locationShownCountryCode = $locationShownCountryCode;
        null !== $locationShownCountryName && $obj->locationShownCountryName = $locationShownCountryName;
        null !== $locationShownGpsAltitude && $obj->locationShownGpsAltitude = $locationShownGpsAltitude;
        null !== $locationShownGpsLatitude && $obj->locationShownGpsLatitude = $locationShownGpsLatitude;
        null !== $locationShownGpsLongitude && $obj->locationShownGpsLongitude = $locationShownGpsLongitude;
        null !== $locationShownLocationID && $obj->locationShownLocationID = $locationShownLocationID;
        null !== $locationShownLocationName && $obj->locationShownLocationName = $locationShownLocationName;
        null !== $locationShownProvinceState && $obj->locationShownProvinceState = $locationShownProvinceState;
        null !== $locationShownSublocation && $obj->locationShownSublocation = $locationShownSublocation;
        null !== $locationShownWorldRegion && $obj->locationShownWorldRegion = $locationShownWorldRegion;
        null !== $maxAvailHeight && $obj->maxAvailHeight = $maxAvailHeight;
        null !== $maxAvailWidth && $obj->maxAvailWidth = $maxAvailWidth;
        null !== $modelAge && $obj->modelAge = $modelAge;
        null !== $modelReleaseID && $obj->modelReleaseID = $modelReleaseID;
        null !== $objectAttributeReference && $obj->objectAttributeReference = $objectAttributeReference;
        null !== $objectName && $obj->objectName = $objectName;
        null !== $offsetTimeOriginal && $obj->offsetTimeOriginal = $offsetTimeOriginal;
        null !== $organisationInImageCode && $obj->organisationInImageCode = $organisationInImageCode;
        null !== $organisationInImageName && $obj->organisationInImageName = $organisationInImageName;
        null !== $orientation && $obj->orientation = $orientation;
        null !== $originalTransmissionReference && $obj->originalTransmissionReference = $originalTransmissionReference;
        null !== $personInImage && $obj->personInImage = $personInImage;
        null !== $personInImageCvTermCvID && $obj->personInImageCvTermCvID = $personInImageCvTermCvID;
        null !== $personInImageCvTermID && $obj->personInImageCvTermID = $personInImageCvTermID;
        null !== $personInImageCvTermName && $obj->personInImageCvTermName = $personInImageCvTermName;
        null !== $personInImageCvTermRefinedAbout && $obj->personInImageCvTermRefinedAbout = $personInImageCvTermRefinedAbout;
        null !== $personInImageDescription && $obj->personInImageDescription = $personInImageDescription;
        null !== $personInImageID && $obj->personInImageID = $personInImageID;
        null !== $personInImageName && $obj->personInImageName = $personInImageName;
        null !== $productInImageDescription && $obj->productInImageDescription = $productInImageDescription;
        null !== $productInImageGtin && $obj->productInImageGtin = $productInImageGtin;
        null !== $productInImageName && $obj->productInImageName = $productInImageName;
        null !== $propertyReleaseID && $obj->propertyReleaseID = $propertyReleaseID;
        null !== $provinceState && $obj->provinceState = $provinceState;
        null !== $rating && $obj->rating = $rating;
        null !== $registryEntryRole && $obj->registryEntryRole = $registryEntryRole;
        null !== $registryItemID && $obj->registryItemID = $registryItemID;
        null !== $registryOrganisationID && $obj->registryOrganisationID = $registryOrganisationID;
        null !== $resolutionUnit && $obj->resolutionUnit = $resolutionUnit;
        null !== $rights && $obj->rights = $rights;
        null !== $scene && $obj->scene = $scene;
        null !== $source && $obj->source = $source;
        null !== $specialInstructions && $obj->specialInstructions = $specialInstructions;
        null !== $state && $obj->state = $state;
        null !== $subject && $obj->subject = $subject;
        null !== $subjectCode && $obj->subjectCode = $subjectCode;
        null !== $subjectReference && $obj->subjectReference = $subjectReference;
        null !== $sublocation && $obj->sublocation = $sublocation;
        null !== $timeCreated && $obj->timeCreated = $timeCreated;
        null !== $title && $obj->title = $title;
        null !== $transmissionReference && $obj->transmissionReference = $transmissionReference;
        null !== $usageTerms && $obj->usageTerms = $usageTerms;
        null !== $webStatement && $obj->webStatement = $webStatement;
        null !== $writer && $obj->writer = $writer;
        null !== $writerEditor && $obj->writerEditor = $writerEditor;
        null !== $xResolution && $obj->xResolution = $xResolution;
        null !== $yResolution && $obj->yResolution = $yResolution;

        return $obj;
    }

    public function withAboutCvTermCvID(string $aboutCvTermCvID): self
    {
        $obj = clone $this;
        $obj->aboutCvTermCvID = $aboutCvTermCvID;

        return $obj;
    }

    public function withAboutCvTermID(string $aboutCvTermID): self
    {
        $obj = clone $this;
        $obj->aboutCvTermID = $aboutCvTermID;

        return $obj;
    }

    public function withAboutCvTermName(string $aboutCvTermName): self
    {
        $obj = clone $this;
        $obj->aboutCvTermName = $aboutCvTermName;

        return $obj;
    }

    public function withAboutCvTermRefinedAbout(
        string $aboutCvTermRefinedAbout
    ): self {
        $obj = clone $this;
        $obj->aboutCvTermRefinedAbout = $aboutCvTermRefinedAbout;

        return $obj;
    }

    public function withAdditionalModelInformation(
        string $additionalModelInformation
    ): self {
        $obj = clone $this;
        $obj->additionalModelInformation = $additionalModelInformation;

        return $obj;
    }

    public function withApplicationRecordVersion(
        int $applicationRecordVersion
    ): self {
        $obj = clone $this;
        $obj->applicationRecordVersion = $applicationRecordVersion;

        return $obj;
    }

    public function withArtist(string $artist): self
    {
        $obj = clone $this;
        $obj->artist = $artist;

        return $obj;
    }

    public function withArtworkCircaDateCreated(
        string $artworkCircaDateCreated
    ): self {
        $obj = clone $this;
        $obj->artworkCircaDateCreated = $artworkCircaDateCreated;

        return $obj;
    }

    public function withArtworkContentDescription(
        string $artworkContentDescription
    ): self {
        $obj = clone $this;
        $obj->artworkContentDescription = $artworkContentDescription;

        return $obj;
    }

    public function withArtworkContributionDescription(
        string $artworkContributionDescription
    ): self {
        $obj = clone $this;
        $obj->artworkContributionDescription = $artworkContributionDescription;

        return $obj;
    }

    public function withArtworkCopyrightNotice(
        string $artworkCopyrightNotice
    ): self {
        $obj = clone $this;
        $obj->artworkCopyrightNotice = $artworkCopyrightNotice;

        return $obj;
    }

    public function withArtworkCopyrightOwnerID(
        string $artworkCopyrightOwnerID
    ): self {
        $obj = clone $this;
        $obj->artworkCopyrightOwnerID = $artworkCopyrightOwnerID;

        return $obj;
    }

    public function withArtworkCopyrightOwnerName(
        string $artworkCopyrightOwnerName
    ): self {
        $obj = clone $this;
        $obj->artworkCopyrightOwnerName = $artworkCopyrightOwnerName;

        return $obj;
    }

    /**
     * @param list<string> $artworkCreator
     */
    public function withArtworkCreator(array $artworkCreator): self
    {
        $obj = clone $this;
        $obj->artworkCreator = $artworkCreator;

        return $obj;
    }

    /**
     * @param list<string> $artworkCreatorID
     */
    public function withArtworkCreatorID(array $artworkCreatorID): self
    {
        $obj = clone $this;
        $obj->artworkCreatorID = $artworkCreatorID;

        return $obj;
    }

    public function withArtworkDateCreated(
        \DateTimeInterface $artworkDateCreated
    ): self {
        $obj = clone $this;
        $obj->artworkDateCreated = $artworkDateCreated;

        return $obj;
    }

    public function withArtworkLicensorID(string $artworkLicensorID): self
    {
        $obj = clone $this;
        $obj->artworkLicensorID = $artworkLicensorID;

        return $obj;
    }

    public function withArtworkLicensorName(string $artworkLicensorName): self
    {
        $obj = clone $this;
        $obj->artworkLicensorName = $artworkLicensorName;

        return $obj;
    }

    public function withArtworkPhysicalDescription(
        string $artworkPhysicalDescription
    ): self {
        $obj = clone $this;
        $obj->artworkPhysicalDescription = $artworkPhysicalDescription;

        return $obj;
    }

    public function withArtworkSource(string $artworkSource): self
    {
        $obj = clone $this;
        $obj->artworkSource = $artworkSource;

        return $obj;
    }

    public function withArtworkSourceInventoryNo(
        string $artworkSourceInventoryNo
    ): self {
        $obj = clone $this;
        $obj->artworkSourceInventoryNo = $artworkSourceInventoryNo;

        return $obj;
    }

    public function withArtworkSourceInvURL(string $artworkSourceInvURL): self
    {
        $obj = clone $this;
        $obj->artworkSourceInvURL = $artworkSourceInvURL;

        return $obj;
    }

    /**
     * @param list<string> $artworkStylePeriod
     */
    public function withArtworkStylePeriod(array $artworkStylePeriod): self
    {
        $obj = clone $this;
        $obj->artworkStylePeriod = $artworkStylePeriod;

        return $obj;
    }

    public function withArtworkTitle(string $artworkTitle): self
    {
        $obj = clone $this;
        $obj->artworkTitle = $artworkTitle;

        return $obj;
    }

    public function withAuthorsPosition(string $authorsPosition): self
    {
        $obj = clone $this;
        $obj->authorsPosition = $authorsPosition;

        return $obj;
    }

    public function withByline(string $byline): self
    {
        $obj = clone $this;
        $obj->byline = $byline;

        return $obj;
    }

    public function withBylineTitle(string $bylineTitle): self
    {
        $obj = clone $this;
        $obj->bylineTitle = $bylineTitle;

        return $obj;
    }

    public function withCaption(string $caption): self
    {
        $obj = clone $this;
        $obj->caption = $caption;

        return $obj;
    }

    public function withCaptionAbstract(string $captionAbstract): self
    {
        $obj = clone $this;
        $obj->captionAbstract = $captionAbstract;

        return $obj;
    }

    public function withCaptionWriter(string $captionWriter): self
    {
        $obj = clone $this;
        $obj->captionWriter = $captionWriter;

        return $obj;
    }

    public function withCity(string $city): self
    {
        $obj = clone $this;
        $obj->city = $city;

        return $obj;
    }

    public function withColorSpace(string $colorSpace): self
    {
        $obj = clone $this;
        $obj->colorSpace = $colorSpace;

        return $obj;
    }

    public function withComponentsConfiguration(
        string $componentsConfiguration
    ): self {
        $obj = clone $this;
        $obj->componentsConfiguration = $componentsConfiguration;

        return $obj;
    }

    public function withCopyright(string $copyright): self
    {
        $obj = clone $this;
        $obj->copyright = $copyright;

        return $obj;
    }

    public function withCopyrightNotice(string $copyrightNotice): self
    {
        $obj = clone $this;
        $obj->copyrightNotice = $copyrightNotice;

        return $obj;
    }

    /**
     * @param list<string> $copyrightOwnerID
     */
    public function withCopyrightOwnerID(array $copyrightOwnerID): self
    {
        $obj = clone $this;
        $obj->copyrightOwnerID = $copyrightOwnerID;

        return $obj;
    }

    /**
     * @param list<string> $copyrightOwnerName
     */
    public function withCopyrightOwnerName(array $copyrightOwnerName): self
    {
        $obj = clone $this;
        $obj->copyrightOwnerName = $copyrightOwnerName;

        return $obj;
    }

    public function withCountry(string $country): self
    {
        $obj = clone $this;
        $obj->country = $country;

        return $obj;
    }

    public function withCountryCode(string $countryCode): self
    {
        $obj = clone $this;
        $obj->countryCode = $countryCode;

        return $obj;
    }

    public function withCountryPrimaryLocationCode(
        string $countryPrimaryLocationCode
    ): self {
        $obj = clone $this;
        $obj->countryPrimaryLocationCode = $countryPrimaryLocationCode;

        return $obj;
    }

    public function withCountryPrimaryLocationName(
        string $countryPrimaryLocationName
    ): self {
        $obj = clone $this;
        $obj->countryPrimaryLocationName = $countryPrimaryLocationName;

        return $obj;
    }

    public function withCreator(string $creator): self
    {
        $obj = clone $this;
        $obj->creator = $creator;

        return $obj;
    }

    public function withCreatorAddress(string $creatorAddress): self
    {
        $obj = clone $this;
        $obj->creatorAddress = $creatorAddress;

        return $obj;
    }

    public function withCreatorCity(string $creatorCity): self
    {
        $obj = clone $this;
        $obj->creatorCity = $creatorCity;

        return $obj;
    }

    public function withCreatorCountry(string $creatorCountry): self
    {
        $obj = clone $this;
        $obj->creatorCountry = $creatorCountry;

        return $obj;
    }

    public function withCreatorPostalCode(string $creatorPostalCode): self
    {
        $obj = clone $this;
        $obj->creatorPostalCode = $creatorPostalCode;

        return $obj;
    }

    public function withCreatorRegion(string $creatorRegion): self
    {
        $obj = clone $this;
        $obj->creatorRegion = $creatorRegion;

        return $obj;
    }

    public function withCreatorWorkEmail(string $creatorWorkEmail): self
    {
        $obj = clone $this;
        $obj->creatorWorkEmail = $creatorWorkEmail;

        return $obj;
    }

    public function withCreatorWorkTelephone(string $creatorWorkTelephone): self
    {
        $obj = clone $this;
        $obj->creatorWorkTelephone = $creatorWorkTelephone;

        return $obj;
    }

    public function withCreatorWorkURL(string $creatorWorkURL): self
    {
        $obj = clone $this;
        $obj->creatorWorkURL = $creatorWorkURL;

        return $obj;
    }

    public function withCredit(string $credit): self
    {
        $obj = clone $this;
        $obj->credit = $credit;

        return $obj;
    }

    public function withDateCreated(\DateTimeInterface $dateCreated): self
    {
        $obj = clone $this;
        $obj->dateCreated = $dateCreated;

        return $obj;
    }

    public function withDateTimeCreated(
        \DateTimeInterface $dateTimeCreated
    ): self {
        $obj = clone $this;
        $obj->dateTimeCreated = $dateTimeCreated;

        return $obj;
    }

    public function withDateTimeOriginal(
        \DateTimeInterface $dateTimeOriginal
    ): self {
        $obj = clone $this;
        $obj->dateTimeOriginal = $dateTimeOriginal;

        return $obj;
    }

    public function withDescription(string $description): self
    {
        $obj = clone $this;
        $obj->description = $description;

        return $obj;
    }

    public function withDigitalImageGuid(string $digitalImageGuid): self
    {
        $obj = clone $this;
        $obj->digitalImageGuid = $digitalImageGuid;

        return $obj;
    }

    public function withDigitalSourceType(string $digitalSourceType): self
    {
        $obj = clone $this;
        $obj->digitalSourceType = $digitalSourceType;

        return $obj;
    }

    public function withEmbeddedEncodedRightsExpr(
        string $embeddedEncodedRightsExpr
    ): self {
        $obj = clone $this;
        $obj->embeddedEncodedRightsExpr = $embeddedEncodedRightsExpr;

        return $obj;
    }

    public function withEmbeddedEncodedRightsExprLangID(
        string $embeddedEncodedRightsExprLangID
    ): self {
        $obj = clone $this;
        $obj->embeddedEncodedRightsExprLangID = $embeddedEncodedRightsExprLangID;

        return $obj;
    }

    public function withEmbeddedEncodedRightsExprType(
        string $embeddedEncodedRightsExprType
    ): self {
        $obj = clone $this;
        $obj->embeddedEncodedRightsExprType = $embeddedEncodedRightsExprType;

        return $obj;
    }

    public function withEvent(string $event): self
    {
        $obj = clone $this;
        $obj->event = $event;

        return $obj;
    }

    public function withExifVersion(string $exifVersion): self
    {
        $obj = clone $this;
        $obj->exifVersion = $exifVersion;

        return $obj;
    }

    public function withFlashpixVersion(string $flashpixVersion): self
    {
        $obj = clone $this;
        $obj->flashpixVersion = $flashpixVersion;

        return $obj;
    }

    public function withGenreCvID(string $genreCvID): self
    {
        $obj = clone $this;
        $obj->genreCvID = $genreCvID;

        return $obj;
    }

    public function withGenreCvTermID(string $genreCvTermID): self
    {
        $obj = clone $this;
        $obj->genreCvTermID = $genreCvTermID;

        return $obj;
    }

    public function withGenreCvTermName(string $genreCvTermName): self
    {
        $obj = clone $this;
        $obj->genreCvTermName = $genreCvTermName;

        return $obj;
    }

    public function withGenreCvTermRefinedAbout(
        string $genreCvTermRefinedAbout
    ): self {
        $obj = clone $this;
        $obj->genreCvTermRefinedAbout = $genreCvTermRefinedAbout;

        return $obj;
    }

    public function withHeadline(string $headline): self
    {
        $obj = clone $this;
        $obj->headline = $headline;

        return $obj;
    }

    public function withImageCreatorID(string $imageCreatorID): self
    {
        $obj = clone $this;
        $obj->imageCreatorID = $imageCreatorID;

        return $obj;
    }

    public function withImageCreatorImageID(string $imageCreatorImageID): self
    {
        $obj = clone $this;
        $obj->imageCreatorImageID = $imageCreatorImageID;

        return $obj;
    }

    public function withImageCreatorName(string $imageCreatorName): self
    {
        $obj = clone $this;
        $obj->imageCreatorName = $imageCreatorName;

        return $obj;
    }

    public function withImageDescription(string $imageDescription): self
    {
        $obj = clone $this;
        $obj->imageDescription = $imageDescription;

        return $obj;
    }

    /**
     * @param list<float> $imageRegionBoundaryH
     */
    public function withImageRegionBoundaryH(array $imageRegionBoundaryH): self
    {
        $obj = clone $this;
        $obj->imageRegionBoundaryH = $imageRegionBoundaryH;

        return $obj;
    }

    /**
     * @param list<float> $imageRegionBoundaryRx
     */
    public function withImageRegionBoundaryRx(
        array $imageRegionBoundaryRx
    ): self {
        $obj = clone $this;
        $obj->imageRegionBoundaryRx = $imageRegionBoundaryRx;

        return $obj;
    }

    /**
     * @param list<string> $imageRegionBoundaryShape
     */
    public function withImageRegionBoundaryShape(
        array $imageRegionBoundaryShape
    ): self {
        $obj = clone $this;
        $obj->imageRegionBoundaryShape = $imageRegionBoundaryShape;

        return $obj;
    }

    /**
     * @param list<string> $imageRegionBoundaryUnit
     */
    public function withImageRegionBoundaryUnit(
        array $imageRegionBoundaryUnit
    ): self {
        $obj = clone $this;
        $obj->imageRegionBoundaryUnit = $imageRegionBoundaryUnit;

        return $obj;
    }

    /**
     * @param list<float> $imageRegionBoundaryVerticesX
     */
    public function withImageRegionBoundaryVerticesX(
        array $imageRegionBoundaryVerticesX
    ): self {
        $obj = clone $this;
        $obj->imageRegionBoundaryVerticesX = $imageRegionBoundaryVerticesX;

        return $obj;
    }

    /**
     * @param list<float> $imageRegionBoundaryVerticesY
     */
    public function withImageRegionBoundaryVerticesY(
        array $imageRegionBoundaryVerticesY
    ): self {
        $obj = clone $this;
        $obj->imageRegionBoundaryVerticesY = $imageRegionBoundaryVerticesY;

        return $obj;
    }

    /**
     * @param list<float> $imageRegionBoundaryW
     */
    public function withImageRegionBoundaryW(array $imageRegionBoundaryW): self
    {
        $obj = clone $this;
        $obj->imageRegionBoundaryW = $imageRegionBoundaryW;

        return $obj;
    }

    /**
     * @param list<float> $imageRegionBoundaryX
     */
    public function withImageRegionBoundaryX(array $imageRegionBoundaryX): self
    {
        $obj = clone $this;
        $obj->imageRegionBoundaryX = $imageRegionBoundaryX;

        return $obj;
    }

    /**
     * @param list<float> $imageRegionBoundaryY
     */
    public function withImageRegionBoundaryY(array $imageRegionBoundaryY): self
    {
        $obj = clone $this;
        $obj->imageRegionBoundaryY = $imageRegionBoundaryY;

        return $obj;
    }

    /**
     * @param list<string> $imageRegionCtypeIdentifier
     */
    public function withImageRegionCtypeIdentifier(
        array $imageRegionCtypeIdentifier
    ): self {
        $obj = clone $this;
        $obj->imageRegionCtypeIdentifier = $imageRegionCtypeIdentifier;

        return $obj;
    }

    /**
     * @param list<string> $imageRegionCtypeName
     */
    public function withImageRegionCtypeName(array $imageRegionCtypeName): self
    {
        $obj = clone $this;
        $obj->imageRegionCtypeName = $imageRegionCtypeName;

        return $obj;
    }

    /**
     * @param list<string> $imageRegionID
     */
    public function withImageRegionID(array $imageRegionID): self
    {
        $obj = clone $this;
        $obj->imageRegionID = $imageRegionID;

        return $obj;
    }

    /**
     * @param list<string> $imageRegionName
     */
    public function withImageRegionName(array $imageRegionName): self
    {
        $obj = clone $this;
        $obj->imageRegionName = $imageRegionName;

        return $obj;
    }

    /**
     * @param list<string> $imageRegionOrganisationInImageName
     */
    public function withImageRegionOrganisationInImageName(
        array $imageRegionOrganisationInImageName
    ): self {
        $obj = clone $this;
        $obj->imageRegionOrganisationInImageName = $imageRegionOrganisationInImageName;

        return $obj;
    }

    /**
     * @param list<string> $imageRegionPersonInImage
     */
    public function withImageRegionPersonInImage(
        array $imageRegionPersonInImage
    ): self {
        $obj = clone $this;
        $obj->imageRegionPersonInImage = $imageRegionPersonInImage;

        return $obj;
    }

    /**
     * @param list<string> $imageRegionRoleIdentifier
     */
    public function withImageRegionRoleIdentifier(
        array $imageRegionRoleIdentifier
    ): self {
        $obj = clone $this;
        $obj->imageRegionRoleIdentifier = $imageRegionRoleIdentifier;

        return $obj;
    }

    /**
     * @param list<string> $imageRegionRoleName
     */
    public function withImageRegionRoleName(array $imageRegionRoleName): self
    {
        $obj = clone $this;
        $obj->imageRegionRoleName = $imageRegionRoleName;

        return $obj;
    }

    public function withImageSupplierID(string $imageSupplierID): self
    {
        $obj = clone $this;
        $obj->imageSupplierID = $imageSupplierID;

        return $obj;
    }

    public function withImageSupplierImageID(string $imageSupplierImageID): self
    {
        $obj = clone $this;
        $obj->imageSupplierImageID = $imageSupplierImageID;

        return $obj;
    }

    public function withImageSupplierName(string $imageSupplierName): self
    {
        $obj = clone $this;
        $obj->imageSupplierName = $imageSupplierName;

        return $obj;
    }

    public function withInstructions(string $instructions): self
    {
        $obj = clone $this;
        $obj->instructions = $instructions;

        return $obj;
    }

    public function withIntellectualGenre(string $intellectualGenre): self
    {
        $obj = clone $this;
        $obj->intellectualGenre = $intellectualGenre;

        return $obj;
    }

    /**
     * @param list<string> $keywords
     */
    public function withKeywords(array $keywords): self
    {
        $obj = clone $this;
        $obj->keywords = $keywords;

        return $obj;
    }

    /**
     * @param list<string> $licensorCity
     */
    public function withLicensorCity(array $licensorCity): self
    {
        $obj = clone $this;
        $obj->licensorCity = $licensorCity;

        return $obj;
    }

    /**
     * @param list<string> $licensorCountry
     */
    public function withLicensorCountry(array $licensorCountry): self
    {
        $obj = clone $this;
        $obj->licensorCountry = $licensorCountry;

        return $obj;
    }

    /**
     * @param list<string> $licensorEmail
     */
    public function withLicensorEmail(array $licensorEmail): self
    {
        $obj = clone $this;
        $obj->licensorEmail = $licensorEmail;

        return $obj;
    }

    /**
     * @param list<string> $licensorExtendedAddress
     */
    public function withLicensorExtendedAddress(
        array $licensorExtendedAddress
    ): self {
        $obj = clone $this;
        $obj->licensorExtendedAddress = $licensorExtendedAddress;

        return $obj;
    }

    /**
     * @param list<string> $licensorID
     */
    public function withLicensorID(array $licensorID): self
    {
        $obj = clone $this;
        $obj->licensorID = $licensorID;

        return $obj;
    }

    /**
     * @param list<string> $licensorName
     */
    public function withLicensorName(array $licensorName): self
    {
        $obj = clone $this;
        $obj->licensorName = $licensorName;

        return $obj;
    }

    /**
     * @param list<string> $licensorPostalCode
     */
    public function withLicensorPostalCode(array $licensorPostalCode): self
    {
        $obj = clone $this;
        $obj->licensorPostalCode = $licensorPostalCode;

        return $obj;
    }

    /**
     * @param list<string> $licensorRegion
     */
    public function withLicensorRegion(array $licensorRegion): self
    {
        $obj = clone $this;
        $obj->licensorRegion = $licensorRegion;

        return $obj;
    }

    /**
     * @param list<string> $licensorStreetAddress
     */
    public function withLicensorStreetAddress(
        array $licensorStreetAddress
    ): self {
        $obj = clone $this;
        $obj->licensorStreetAddress = $licensorStreetAddress;

        return $obj;
    }

    /**
     * @param list<string> $licensorTelephone1
     */
    public function withLicensorTelephone1(array $licensorTelephone1): self
    {
        $obj = clone $this;
        $obj->licensorTelephone1 = $licensorTelephone1;

        return $obj;
    }

    /**
     * @param list<string> $licensorTelephone2
     */
    public function withLicensorTelephone2(array $licensorTelephone2): self
    {
        $obj = clone $this;
        $obj->licensorTelephone2 = $licensorTelephone2;

        return $obj;
    }

    /**
     * @param list<string> $licensorURL
     */
    public function withLicensorURL(array $licensorURL): self
    {
        $obj = clone $this;
        $obj->licensorURL = $licensorURL;

        return $obj;
    }

    public function withLinkedEncodedRightsExpr(
        string $linkedEncodedRightsExpr
    ): self {
        $obj = clone $this;
        $obj->linkedEncodedRightsExpr = $linkedEncodedRightsExpr;

        return $obj;
    }

    public function withLinkedEncodedRightsExprLangID(
        string $linkedEncodedRightsExprLangID
    ): self {
        $obj = clone $this;
        $obj->linkedEncodedRightsExprLangID = $linkedEncodedRightsExprLangID;

        return $obj;
    }

    public function withLinkedEncodedRightsExprType(
        string $linkedEncodedRightsExprType
    ): self {
        $obj = clone $this;
        $obj->linkedEncodedRightsExprType = $linkedEncodedRightsExprType;

        return $obj;
    }

    public function withLocation(string $location): self
    {
        $obj = clone $this;
        $obj->location = $location;

        return $obj;
    }

    public function withLocationCreatedCity(string $locationCreatedCity): self
    {
        $obj = clone $this;
        $obj->locationCreatedCity = $locationCreatedCity;

        return $obj;
    }

    public function withLocationCreatedCountryCode(
        string $locationCreatedCountryCode
    ): self {
        $obj = clone $this;
        $obj->locationCreatedCountryCode = $locationCreatedCountryCode;

        return $obj;
    }

    public function withLocationCreatedCountryName(
        string $locationCreatedCountryName
    ): self {
        $obj = clone $this;
        $obj->locationCreatedCountryName = $locationCreatedCountryName;

        return $obj;
    }

    public function withLocationCreatedGpsAltitude(
        string $locationCreatedGpsAltitude
    ): self {
        $obj = clone $this;
        $obj->locationCreatedGpsAltitude = $locationCreatedGpsAltitude;

        return $obj;
    }

    public function withLocationCreatedGpsLatitude(
        string $locationCreatedGpsLatitude
    ): self {
        $obj = clone $this;
        $obj->locationCreatedGpsLatitude = $locationCreatedGpsLatitude;

        return $obj;
    }

    public function withLocationCreatedGpsLongitude(
        string $locationCreatedGpsLongitude
    ): self {
        $obj = clone $this;
        $obj->locationCreatedGpsLongitude = $locationCreatedGpsLongitude;

        return $obj;
    }

    public function withLocationCreatedLocationID(
        string $locationCreatedLocationID
    ): self {
        $obj = clone $this;
        $obj->locationCreatedLocationID = $locationCreatedLocationID;

        return $obj;
    }

    public function withLocationCreatedLocationName(
        string $locationCreatedLocationName
    ): self {
        $obj = clone $this;
        $obj->locationCreatedLocationName = $locationCreatedLocationName;

        return $obj;
    }

    public function withLocationCreatedProvinceState(
        string $locationCreatedProvinceState
    ): self {
        $obj = clone $this;
        $obj->locationCreatedProvinceState = $locationCreatedProvinceState;

        return $obj;
    }

    public function withLocationCreatedSublocation(
        string $locationCreatedSublocation
    ): self {
        $obj = clone $this;
        $obj->locationCreatedSublocation = $locationCreatedSublocation;

        return $obj;
    }

    public function withLocationCreatedWorldRegion(
        string $locationCreatedWorldRegion
    ): self {
        $obj = clone $this;
        $obj->locationCreatedWorldRegion = $locationCreatedWorldRegion;

        return $obj;
    }

    /**
     * @param list<string> $locationShownCity
     */
    public function withLocationShownCity(array $locationShownCity): self
    {
        $obj = clone $this;
        $obj->locationShownCity = $locationShownCity;

        return $obj;
    }

    /**
     * @param list<string> $locationShownCountryCode
     */
    public function withLocationShownCountryCode(
        array $locationShownCountryCode
    ): self {
        $obj = clone $this;
        $obj->locationShownCountryCode = $locationShownCountryCode;

        return $obj;
    }

    /**
     * @param list<string> $locationShownCountryName
     */
    public function withLocationShownCountryName(
        array $locationShownCountryName
    ): self {
        $obj = clone $this;
        $obj->locationShownCountryName = $locationShownCountryName;

        return $obj;
    }

    /**
     * @param list<string> $locationShownGpsAltitude
     */
    public function withLocationShownGpsAltitude(
        array $locationShownGpsAltitude
    ): self {
        $obj = clone $this;
        $obj->locationShownGpsAltitude = $locationShownGpsAltitude;

        return $obj;
    }

    /**
     * @param list<string> $locationShownGpsLatitude
     */
    public function withLocationShownGpsLatitude(
        array $locationShownGpsLatitude
    ): self {
        $obj = clone $this;
        $obj->locationShownGpsLatitude = $locationShownGpsLatitude;

        return $obj;
    }

    /**
     * @param list<string> $locationShownGpsLongitude
     */
    public function withLocationShownGpsLongitude(
        array $locationShownGpsLongitude
    ): self {
        $obj = clone $this;
        $obj->locationShownGpsLongitude = $locationShownGpsLongitude;

        return $obj;
    }

    /**
     * @param list<string> $locationShownLocationID
     */
    public function withLocationShownLocationID(
        array $locationShownLocationID
    ): self {
        $obj = clone $this;
        $obj->locationShownLocationID = $locationShownLocationID;

        return $obj;
    }

    /**
     * @param list<string> $locationShownLocationName
     */
    public function withLocationShownLocationName(
        array $locationShownLocationName
    ): self {
        $obj = clone $this;
        $obj->locationShownLocationName = $locationShownLocationName;

        return $obj;
    }

    /**
     * @param list<string> $locationShownProvinceState
     */
    public function withLocationShownProvinceState(
        array $locationShownProvinceState
    ): self {
        $obj = clone $this;
        $obj->locationShownProvinceState = $locationShownProvinceState;

        return $obj;
    }

    /**
     * @param list<string> $locationShownSublocation
     */
    public function withLocationShownSublocation(
        array $locationShownSublocation
    ): self {
        $obj = clone $this;
        $obj->locationShownSublocation = $locationShownSublocation;

        return $obj;
    }

    /**
     * @param list<string> $locationShownWorldRegion
     */
    public function withLocationShownWorldRegion(
        array $locationShownWorldRegion
    ): self {
        $obj = clone $this;
        $obj->locationShownWorldRegion = $locationShownWorldRegion;

        return $obj;
    }

    public function withMaxAvailHeight(float $maxAvailHeight): self
    {
        $obj = clone $this;
        $obj->maxAvailHeight = $maxAvailHeight;

        return $obj;
    }

    public function withMaxAvailWidth(float $maxAvailWidth): self
    {
        $obj = clone $this;
        $obj->maxAvailWidth = $maxAvailWidth;

        return $obj;
    }

    /**
     * @param list<float> $modelAge
     */
    public function withModelAge(array $modelAge): self
    {
        $obj = clone $this;
        $obj->modelAge = $modelAge;

        return $obj;
    }

    /**
     * @param list<string> $modelReleaseID
     */
    public function withModelReleaseID(array $modelReleaseID): self
    {
        $obj = clone $this;
        $obj->modelReleaseID = $modelReleaseID;

        return $obj;
    }

    public function withObjectAttributeReference(
        string $objectAttributeReference
    ): self {
        $obj = clone $this;
        $obj->objectAttributeReference = $objectAttributeReference;

        return $obj;
    }

    public function withObjectName(string $objectName): self
    {
        $obj = clone $this;
        $obj->objectName = $objectName;

        return $obj;
    }

    public function withOffsetTimeOriginal(string $offsetTimeOriginal): self
    {
        $obj = clone $this;
        $obj->offsetTimeOriginal = $offsetTimeOriginal;

        return $obj;
    }

    /**
     * @param list<string> $organisationInImageCode
     */
    public function withOrganisationInImageCode(
        array $organisationInImageCode
    ): self {
        $obj = clone $this;
        $obj->organisationInImageCode = $organisationInImageCode;

        return $obj;
    }

    /**
     * @param list<string> $organisationInImageName
     */
    public function withOrganisationInImageName(
        array $organisationInImageName
    ): self {
        $obj = clone $this;
        $obj->organisationInImageName = $organisationInImageName;

        return $obj;
    }

    public function withOrientation(string $orientation): self
    {
        $obj = clone $this;
        $obj->orientation = $orientation;

        return $obj;
    }

    public function withOriginalTransmissionReference(
        string $originalTransmissionReference
    ): self {
        $obj = clone $this;
        $obj->originalTransmissionReference = $originalTransmissionReference;

        return $obj;
    }

    /**
     * @param list<string> $personInImage
     */
    public function withPersonInImage(array $personInImage): self
    {
        $obj = clone $this;
        $obj->personInImage = $personInImage;

        return $obj;
    }

    /**
     * @param list<string> $personInImageCvTermCvID
     */
    public function withPersonInImageCvTermCvID(
        array $personInImageCvTermCvID
    ): self {
        $obj = clone $this;
        $obj->personInImageCvTermCvID = $personInImageCvTermCvID;

        return $obj;
    }

    /**
     * @param list<string> $personInImageCvTermID
     */
    public function withPersonInImageCvTermID(
        array $personInImageCvTermID
    ): self {
        $obj = clone $this;
        $obj->personInImageCvTermID = $personInImageCvTermID;

        return $obj;
    }

    /**
     * @param list<string> $personInImageCvTermName
     */
    public function withPersonInImageCvTermName(
        array $personInImageCvTermName
    ): self {
        $obj = clone $this;
        $obj->personInImageCvTermName = $personInImageCvTermName;

        return $obj;
    }

    /**
     * @param list<string> $personInImageCvTermRefinedAbout
     */
    public function withPersonInImageCvTermRefinedAbout(
        array $personInImageCvTermRefinedAbout
    ): self {
        $obj = clone $this;
        $obj->personInImageCvTermRefinedAbout = $personInImageCvTermRefinedAbout;

        return $obj;
    }

    /**
     * @param list<string> $personInImageDescription
     */
    public function withPersonInImageDescription(
        array $personInImageDescription
    ): self {
        $obj = clone $this;
        $obj->personInImageDescription = $personInImageDescription;

        return $obj;
    }

    /**
     * @param list<string> $personInImageID
     */
    public function withPersonInImageID(array $personInImageID): self
    {
        $obj = clone $this;
        $obj->personInImageID = $personInImageID;

        return $obj;
    }

    /**
     * @param list<string> $personInImageName
     */
    public function withPersonInImageName(array $personInImageName): self
    {
        $obj = clone $this;
        $obj->personInImageName = $personInImageName;

        return $obj;
    }

    /**
     * @param list<string> $productInImageDescription
     */
    public function withProductInImageDescription(
        array $productInImageDescription
    ): self {
        $obj = clone $this;
        $obj->productInImageDescription = $productInImageDescription;

        return $obj;
    }

    /**
     * @param list<float> $productInImageGtin
     */
    public function withProductInImageGtin(array $productInImageGtin): self
    {
        $obj = clone $this;
        $obj->productInImageGtin = $productInImageGtin;

        return $obj;
    }

    /**
     * @param list<string> $productInImageName
     */
    public function withProductInImageName(array $productInImageName): self
    {
        $obj = clone $this;
        $obj->productInImageName = $productInImageName;

        return $obj;
    }

    /**
     * @param list<string> $propertyReleaseID
     */
    public function withPropertyReleaseID(array $propertyReleaseID): self
    {
        $obj = clone $this;
        $obj->propertyReleaseID = $propertyReleaseID;

        return $obj;
    }

    public function withProvinceState(string $provinceState): self
    {
        $obj = clone $this;
        $obj->provinceState = $provinceState;

        return $obj;
    }

    public function withRating(int $rating): self
    {
        $obj = clone $this;
        $obj->rating = $rating;

        return $obj;
    }

    /**
     * @param list<string> $registryEntryRole
     */
    public function withRegistryEntryRole(array $registryEntryRole): self
    {
        $obj = clone $this;
        $obj->registryEntryRole = $registryEntryRole;

        return $obj;
    }

    /**
     * @param list<string> $registryItemID
     */
    public function withRegistryItemID(array $registryItemID): self
    {
        $obj = clone $this;
        $obj->registryItemID = $registryItemID;

        return $obj;
    }

    /**
     * @param list<string> $registryOrganisationID
     */
    public function withRegistryOrganisationID(
        array $registryOrganisationID
    ): self {
        $obj = clone $this;
        $obj->registryOrganisationID = $registryOrganisationID;

        return $obj;
    }

    public function withResolutionUnit(string $resolutionUnit): self
    {
        $obj = clone $this;
        $obj->resolutionUnit = $resolutionUnit;

        return $obj;
    }

    public function withRights(string $rights): self
    {
        $obj = clone $this;
        $obj->rights = $rights;

        return $obj;
    }

    /**
     * @param list<string> $scene
     */
    public function withScene(array $scene): self
    {
        $obj = clone $this;
        $obj->scene = $scene;

        return $obj;
    }

    public function withSource(string $source): self
    {
        $obj = clone $this;
        $obj->source = $source;

        return $obj;
    }

    public function withSpecialInstructions(string $specialInstructions): self
    {
        $obj = clone $this;
        $obj->specialInstructions = $specialInstructions;

        return $obj;
    }

    public function withState(string $state): self
    {
        $obj = clone $this;
        $obj->state = $state;

        return $obj;
    }

    /**
     * @param list<string> $subject
     */
    public function withSubject(array $subject): self
    {
        $obj = clone $this;
        $obj->subject = $subject;

        return $obj;
    }

    /**
     * @param list<string> $subjectCode
     */
    public function withSubjectCode(array $subjectCode): self
    {
        $obj = clone $this;
        $obj->subjectCode = $subjectCode;

        return $obj;
    }

    /**
     * @param list<string> $subjectReference
     */
    public function withSubjectReference(array $subjectReference): self
    {
        $obj = clone $this;
        $obj->subjectReference = $subjectReference;

        return $obj;
    }

    public function withSublocation(string $sublocation): self
    {
        $obj = clone $this;
        $obj->sublocation = $sublocation;

        return $obj;
    }

    public function withTimeCreated(string $timeCreated): self
    {
        $obj = clone $this;
        $obj->timeCreated = $timeCreated;

        return $obj;
    }

    public function withTitle(string $title): self
    {
        $obj = clone $this;
        $obj->title = $title;

        return $obj;
    }

    public function withTransmissionReference(
        string $transmissionReference
    ): self {
        $obj = clone $this;
        $obj->transmissionReference = $transmissionReference;

        return $obj;
    }

    public function withUsageTerms(string $usageTerms): self
    {
        $obj = clone $this;
        $obj->usageTerms = $usageTerms;

        return $obj;
    }

    public function withWebStatement(string $webStatement): self
    {
        $obj = clone $this;
        $obj->webStatement = $webStatement;

        return $obj;
    }

    public function withWriter(string $writer): self
    {
        $obj = clone $this;
        $obj->writer = $writer;

        return $obj;
    }

    public function withWriterEditor(string $writerEditor): self
    {
        $obj = clone $this;
        $obj->writerEditor = $writerEditor;

        return $obj;
    }

    public function withXResolution(float $xResolution): self
    {
        $obj = clone $this;
        $obj->xResolution = $xResolution;

        return $obj;
    }

    public function withYResolution(float $yResolution): self
    {
        $obj = clone $this;
        $obj->yResolution = $yResolution;

        return $obj;
    }
}
