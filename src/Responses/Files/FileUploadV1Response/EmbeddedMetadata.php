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
    public static function new(
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

    public function setAboutCvTermCvID(string $aboutCvTermCvID): self
    {
        $this->aboutCvTermCvID = $aboutCvTermCvID;

        return $this;
    }

    public function setAboutCvTermID(string $aboutCvTermID): self
    {
        $this->aboutCvTermID = $aboutCvTermID;

        return $this;
    }

    public function setAboutCvTermName(string $aboutCvTermName): self
    {
        $this->aboutCvTermName = $aboutCvTermName;

        return $this;
    }

    public function setAboutCvTermRefinedAbout(
        string $aboutCvTermRefinedAbout
    ): self {
        $this->aboutCvTermRefinedAbout = $aboutCvTermRefinedAbout;

        return $this;
    }

    public function setAdditionalModelInformation(
        string $additionalModelInformation
    ): self {
        $this->additionalModelInformation = $additionalModelInformation;

        return $this;
    }

    public function setApplicationRecordVersion(
        int $applicationRecordVersion
    ): self {
        $this->applicationRecordVersion = $applicationRecordVersion;

        return $this;
    }

    public function setArtist(string $artist): self
    {
        $this->artist = $artist;

        return $this;
    }

    public function setArtworkCircaDateCreated(
        string $artworkCircaDateCreated
    ): self {
        $this->artworkCircaDateCreated = $artworkCircaDateCreated;

        return $this;
    }

    public function setArtworkContentDescription(
        string $artworkContentDescription
    ): self {
        $this->artworkContentDescription = $artworkContentDescription;

        return $this;
    }

    public function setArtworkContributionDescription(
        string $artworkContributionDescription
    ): self {
        $this->artworkContributionDescription = $artworkContributionDescription;

        return $this;
    }

    public function setArtworkCopyrightNotice(
        string $artworkCopyrightNotice
    ): self {
        $this->artworkCopyrightNotice = $artworkCopyrightNotice;

        return $this;
    }

    public function setArtworkCopyrightOwnerID(
        string $artworkCopyrightOwnerID
    ): self {
        $this->artworkCopyrightOwnerID = $artworkCopyrightOwnerID;

        return $this;
    }

    public function setArtworkCopyrightOwnerName(
        string $artworkCopyrightOwnerName
    ): self {
        $this->artworkCopyrightOwnerName = $artworkCopyrightOwnerName;

        return $this;
    }

    /**
     * @param list<string> $artworkCreator
     */
    public function setArtworkCreator(array $artworkCreator): self
    {
        $this->artworkCreator = $artworkCreator;

        return $this;
    }

    /**
     * @param list<string> $artworkCreatorID
     */
    public function setArtworkCreatorID(array $artworkCreatorID): self
    {
        $this->artworkCreatorID = $artworkCreatorID;

        return $this;
    }

    public function setArtworkDateCreated(
        \DateTimeInterface $artworkDateCreated
    ): self {
        $this->artworkDateCreated = $artworkDateCreated;

        return $this;
    }

    public function setArtworkLicensorID(string $artworkLicensorID): self
    {
        $this->artworkLicensorID = $artworkLicensorID;

        return $this;
    }

    public function setArtworkLicensorName(string $artworkLicensorName): self
    {
        $this->artworkLicensorName = $artworkLicensorName;

        return $this;
    }

    public function setArtworkPhysicalDescription(
        string $artworkPhysicalDescription
    ): self {
        $this->artworkPhysicalDescription = $artworkPhysicalDescription;

        return $this;
    }

    public function setArtworkSource(string $artworkSource): self
    {
        $this->artworkSource = $artworkSource;

        return $this;
    }

    public function setArtworkSourceInventoryNo(
        string $artworkSourceInventoryNo
    ): self {
        $this->artworkSourceInventoryNo = $artworkSourceInventoryNo;

        return $this;
    }

    public function setArtworkSourceInvURL(string $artworkSourceInvURL): self
    {
        $this->artworkSourceInvURL = $artworkSourceInvURL;

        return $this;
    }

    /**
     * @param list<string> $artworkStylePeriod
     */
    public function setArtworkStylePeriod(array $artworkStylePeriod): self
    {
        $this->artworkStylePeriod = $artworkStylePeriod;

        return $this;
    }

    public function setArtworkTitle(string $artworkTitle): self
    {
        $this->artworkTitle = $artworkTitle;

        return $this;
    }

    public function setAuthorsPosition(string $authorsPosition): self
    {
        $this->authorsPosition = $authorsPosition;

        return $this;
    }

    public function setByline(string $byline): self
    {
        $this->byline = $byline;

        return $this;
    }

    public function setBylineTitle(string $bylineTitle): self
    {
        $this->bylineTitle = $bylineTitle;

        return $this;
    }

    public function setCaption(string $caption): self
    {
        $this->caption = $caption;

        return $this;
    }

    public function setCaptionAbstract(string $captionAbstract): self
    {
        $this->captionAbstract = $captionAbstract;

        return $this;
    }

    public function setCaptionWriter(string $captionWriter): self
    {
        $this->captionWriter = $captionWriter;

        return $this;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function setColorSpace(string $colorSpace): self
    {
        $this->colorSpace = $colorSpace;

        return $this;
    }

    public function setComponentsConfiguration(
        string $componentsConfiguration
    ): self {
        $this->componentsConfiguration = $componentsConfiguration;

        return $this;
    }

    public function setCopyright(string $copyright): self
    {
        $this->copyright = $copyright;

        return $this;
    }

    public function setCopyrightNotice(string $copyrightNotice): self
    {
        $this->copyrightNotice = $copyrightNotice;

        return $this;
    }

    /**
     * @param list<string> $copyrightOwnerID
     */
    public function setCopyrightOwnerID(array $copyrightOwnerID): self
    {
        $this->copyrightOwnerID = $copyrightOwnerID;

        return $this;
    }

    /**
     * @param list<string> $copyrightOwnerName
     */
    public function setCopyrightOwnerName(array $copyrightOwnerName): self
    {
        $this->copyrightOwnerName = $copyrightOwnerName;

        return $this;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function setCountryCode(string $countryCode): self
    {
        $this->countryCode = $countryCode;

        return $this;
    }

    public function setCountryPrimaryLocationCode(
        string $countryPrimaryLocationCode
    ): self {
        $this->countryPrimaryLocationCode = $countryPrimaryLocationCode;

        return $this;
    }

    public function setCountryPrimaryLocationName(
        string $countryPrimaryLocationName
    ): self {
        $this->countryPrimaryLocationName = $countryPrimaryLocationName;

        return $this;
    }

    public function setCreator(string $creator): self
    {
        $this->creator = $creator;

        return $this;
    }

    public function setCreatorAddress(string $creatorAddress): self
    {
        $this->creatorAddress = $creatorAddress;

        return $this;
    }

    public function setCreatorCity(string $creatorCity): self
    {
        $this->creatorCity = $creatorCity;

        return $this;
    }

    public function setCreatorCountry(string $creatorCountry): self
    {
        $this->creatorCountry = $creatorCountry;

        return $this;
    }

    public function setCreatorPostalCode(string $creatorPostalCode): self
    {
        $this->creatorPostalCode = $creatorPostalCode;

        return $this;
    }

    public function setCreatorRegion(string $creatorRegion): self
    {
        $this->creatorRegion = $creatorRegion;

        return $this;
    }

    public function setCreatorWorkEmail(string $creatorWorkEmail): self
    {
        $this->creatorWorkEmail = $creatorWorkEmail;

        return $this;
    }

    public function setCreatorWorkTelephone(string $creatorWorkTelephone): self
    {
        $this->creatorWorkTelephone = $creatorWorkTelephone;

        return $this;
    }

    public function setCreatorWorkURL(string $creatorWorkURL): self
    {
        $this->creatorWorkURL = $creatorWorkURL;

        return $this;
    }

    public function setCredit(string $credit): self
    {
        $this->credit = $credit;

        return $this;
    }

    public function setDateCreated(\DateTimeInterface $dateCreated): self
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    public function setDateTimeCreated(
        \DateTimeInterface $dateTimeCreated
    ): self {
        $this->dateTimeCreated = $dateTimeCreated;

        return $this;
    }

    public function setDateTimeOriginal(
        \DateTimeInterface $dateTimeOriginal
    ): self {
        $this->dateTimeOriginal = $dateTimeOriginal;

        return $this;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function setDigitalImageGuid(string $digitalImageGuid): self
    {
        $this->digitalImageGuid = $digitalImageGuid;

        return $this;
    }

    public function setDigitalSourceType(string $digitalSourceType): self
    {
        $this->digitalSourceType = $digitalSourceType;

        return $this;
    }

    public function setEmbeddedEncodedRightsExpr(
        string $embeddedEncodedRightsExpr
    ): self {
        $this->embeddedEncodedRightsExpr = $embeddedEncodedRightsExpr;

        return $this;
    }

    public function setEmbeddedEncodedRightsExprLangID(
        string $embeddedEncodedRightsExprLangID
    ): self {
        $this->embeddedEncodedRightsExprLangID = $embeddedEncodedRightsExprLangID;

        return $this;
    }

    public function setEmbeddedEncodedRightsExprType(
        string $embeddedEncodedRightsExprType
    ): self {
        $this->embeddedEncodedRightsExprType = $embeddedEncodedRightsExprType;

        return $this;
    }

    public function setEvent(string $event): self
    {
        $this->event = $event;

        return $this;
    }

    public function setExifVersion(string $exifVersion): self
    {
        $this->exifVersion = $exifVersion;

        return $this;
    }

    public function setFlashpixVersion(string $flashpixVersion): self
    {
        $this->flashpixVersion = $flashpixVersion;

        return $this;
    }

    public function setGenreCvID(string $genreCvID): self
    {
        $this->genreCvID = $genreCvID;

        return $this;
    }

    public function setGenreCvTermID(string $genreCvTermID): self
    {
        $this->genreCvTermID = $genreCvTermID;

        return $this;
    }

    public function setGenreCvTermName(string $genreCvTermName): self
    {
        $this->genreCvTermName = $genreCvTermName;

        return $this;
    }

    public function setGenreCvTermRefinedAbout(
        string $genreCvTermRefinedAbout
    ): self {
        $this->genreCvTermRefinedAbout = $genreCvTermRefinedAbout;

        return $this;
    }

    public function setHeadline(string $headline): self
    {
        $this->headline = $headline;

        return $this;
    }

    public function setImageCreatorID(string $imageCreatorID): self
    {
        $this->imageCreatorID = $imageCreatorID;

        return $this;
    }

    public function setImageCreatorImageID(string $imageCreatorImageID): self
    {
        $this->imageCreatorImageID = $imageCreatorImageID;

        return $this;
    }

    public function setImageCreatorName(string $imageCreatorName): self
    {
        $this->imageCreatorName = $imageCreatorName;

        return $this;
    }

    public function setImageDescription(string $imageDescription): self
    {
        $this->imageDescription = $imageDescription;

        return $this;
    }

    /**
     * @param list<float> $imageRegionBoundaryH
     */
    public function setImageRegionBoundaryH(array $imageRegionBoundaryH): self
    {
        $this->imageRegionBoundaryH = $imageRegionBoundaryH;

        return $this;
    }

    /**
     * @param list<float> $imageRegionBoundaryRx
     */
    public function setImageRegionBoundaryRx(array $imageRegionBoundaryRx): self
    {
        $this->imageRegionBoundaryRx = $imageRegionBoundaryRx;

        return $this;
    }

    /**
     * @param list<string> $imageRegionBoundaryShape
     */
    public function setImageRegionBoundaryShape(
        array $imageRegionBoundaryShape
    ): self {
        $this->imageRegionBoundaryShape = $imageRegionBoundaryShape;

        return $this;
    }

    /**
     * @param list<string> $imageRegionBoundaryUnit
     */
    public function setImageRegionBoundaryUnit(
        array $imageRegionBoundaryUnit
    ): self {
        $this->imageRegionBoundaryUnit = $imageRegionBoundaryUnit;

        return $this;
    }

    /**
     * @param list<float> $imageRegionBoundaryVerticesX
     */
    public function setImageRegionBoundaryVerticesX(
        array $imageRegionBoundaryVerticesX
    ): self {
        $this->imageRegionBoundaryVerticesX = $imageRegionBoundaryVerticesX;

        return $this;
    }

    /**
     * @param list<float> $imageRegionBoundaryVerticesY
     */
    public function setImageRegionBoundaryVerticesY(
        array $imageRegionBoundaryVerticesY
    ): self {
        $this->imageRegionBoundaryVerticesY = $imageRegionBoundaryVerticesY;

        return $this;
    }

    /**
     * @param list<float> $imageRegionBoundaryW
     */
    public function setImageRegionBoundaryW(array $imageRegionBoundaryW): self
    {
        $this->imageRegionBoundaryW = $imageRegionBoundaryW;

        return $this;
    }

    /**
     * @param list<float> $imageRegionBoundaryX
     */
    public function setImageRegionBoundaryX(array $imageRegionBoundaryX): self
    {
        $this->imageRegionBoundaryX = $imageRegionBoundaryX;

        return $this;
    }

    /**
     * @param list<float> $imageRegionBoundaryY
     */
    public function setImageRegionBoundaryY(array $imageRegionBoundaryY): self
    {
        $this->imageRegionBoundaryY = $imageRegionBoundaryY;

        return $this;
    }

    /**
     * @param list<string> $imageRegionCtypeIdentifier
     */
    public function setImageRegionCtypeIdentifier(
        array $imageRegionCtypeIdentifier
    ): self {
        $this->imageRegionCtypeIdentifier = $imageRegionCtypeIdentifier;

        return $this;
    }

    /**
     * @param list<string> $imageRegionCtypeName
     */
    public function setImageRegionCtypeName(array $imageRegionCtypeName): self
    {
        $this->imageRegionCtypeName = $imageRegionCtypeName;

        return $this;
    }

    /**
     * @param list<string> $imageRegionID
     */
    public function setImageRegionID(array $imageRegionID): self
    {
        $this->imageRegionID = $imageRegionID;

        return $this;
    }

    /**
     * @param list<string> $imageRegionName
     */
    public function setImageRegionName(array $imageRegionName): self
    {
        $this->imageRegionName = $imageRegionName;

        return $this;
    }

    /**
     * @param list<string> $imageRegionOrganisationInImageName
     */
    public function setImageRegionOrganisationInImageName(
        array $imageRegionOrganisationInImageName
    ): self {
        $this
            ->imageRegionOrganisationInImageName = $imageRegionOrganisationInImageName
        ;

        return $this;
    }

    /**
     * @param list<string> $imageRegionPersonInImage
     */
    public function setImageRegionPersonInImage(
        array $imageRegionPersonInImage
    ): self {
        $this->imageRegionPersonInImage = $imageRegionPersonInImage;

        return $this;
    }

    /**
     * @param list<string> $imageRegionRoleIdentifier
     */
    public function setImageRegionRoleIdentifier(
        array $imageRegionRoleIdentifier
    ): self {
        $this->imageRegionRoleIdentifier = $imageRegionRoleIdentifier;

        return $this;
    }

    /**
     * @param list<string> $imageRegionRoleName
     */
    public function setImageRegionRoleName(array $imageRegionRoleName): self
    {
        $this->imageRegionRoleName = $imageRegionRoleName;

        return $this;
    }

    public function setImageSupplierID(string $imageSupplierID): self
    {
        $this->imageSupplierID = $imageSupplierID;

        return $this;
    }

    public function setImageSupplierImageID(string $imageSupplierImageID): self
    {
        $this->imageSupplierImageID = $imageSupplierImageID;

        return $this;
    }

    public function setImageSupplierName(string $imageSupplierName): self
    {
        $this->imageSupplierName = $imageSupplierName;

        return $this;
    }

    public function setInstructions(string $instructions): self
    {
        $this->instructions = $instructions;

        return $this;
    }

    public function setIntellectualGenre(string $intellectualGenre): self
    {
        $this->intellectualGenre = $intellectualGenre;

        return $this;
    }

    /**
     * @param list<string> $keywords
     */
    public function setKeywords(array $keywords): self
    {
        $this->keywords = $keywords;

        return $this;
    }

    /**
     * @param list<string> $licensorCity
     */
    public function setLicensorCity(array $licensorCity): self
    {
        $this->licensorCity = $licensorCity;

        return $this;
    }

    /**
     * @param list<string> $licensorCountry
     */
    public function setLicensorCountry(array $licensorCountry): self
    {
        $this->licensorCountry = $licensorCountry;

        return $this;
    }

    /**
     * @param list<string> $licensorEmail
     */
    public function setLicensorEmail(array $licensorEmail): self
    {
        $this->licensorEmail = $licensorEmail;

        return $this;
    }

    /**
     * @param list<string> $licensorExtendedAddress
     */
    public function setLicensorExtendedAddress(
        array $licensorExtendedAddress
    ): self {
        $this->licensorExtendedAddress = $licensorExtendedAddress;

        return $this;
    }

    /**
     * @param list<string> $licensorID
     */
    public function setLicensorID(array $licensorID): self
    {
        $this->licensorID = $licensorID;

        return $this;
    }

    /**
     * @param list<string> $licensorName
     */
    public function setLicensorName(array $licensorName): self
    {
        $this->licensorName = $licensorName;

        return $this;
    }

    /**
     * @param list<string> $licensorPostalCode
     */
    public function setLicensorPostalCode(array $licensorPostalCode): self
    {
        $this->licensorPostalCode = $licensorPostalCode;

        return $this;
    }

    /**
     * @param list<string> $licensorRegion
     */
    public function setLicensorRegion(array $licensorRegion): self
    {
        $this->licensorRegion = $licensorRegion;

        return $this;
    }

    /**
     * @param list<string> $licensorStreetAddress
     */
    public function setLicensorStreetAddress(array $licensorStreetAddress): self
    {
        $this->licensorStreetAddress = $licensorStreetAddress;

        return $this;
    }

    /**
     * @param list<string> $licensorTelephone1
     */
    public function setLicensorTelephone1(array $licensorTelephone1): self
    {
        $this->licensorTelephone1 = $licensorTelephone1;

        return $this;
    }

    /**
     * @param list<string> $licensorTelephone2
     */
    public function setLicensorTelephone2(array $licensorTelephone2): self
    {
        $this->licensorTelephone2 = $licensorTelephone2;

        return $this;
    }

    /**
     * @param list<string> $licensorURL
     */
    public function setLicensorURL(array $licensorURL): self
    {
        $this->licensorURL = $licensorURL;

        return $this;
    }

    public function setLinkedEncodedRightsExpr(
        string $linkedEncodedRightsExpr
    ): self {
        $this->linkedEncodedRightsExpr = $linkedEncodedRightsExpr;

        return $this;
    }

    public function setLinkedEncodedRightsExprLangID(
        string $linkedEncodedRightsExprLangID
    ): self {
        $this->linkedEncodedRightsExprLangID = $linkedEncodedRightsExprLangID;

        return $this;
    }

    public function setLinkedEncodedRightsExprType(
        string $linkedEncodedRightsExprType
    ): self {
        $this->linkedEncodedRightsExprType = $linkedEncodedRightsExprType;

        return $this;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function setLocationCreatedCity(string $locationCreatedCity): self
    {
        $this->locationCreatedCity = $locationCreatedCity;

        return $this;
    }

    public function setLocationCreatedCountryCode(
        string $locationCreatedCountryCode
    ): self {
        $this->locationCreatedCountryCode = $locationCreatedCountryCode;

        return $this;
    }

    public function setLocationCreatedCountryName(
        string $locationCreatedCountryName
    ): self {
        $this->locationCreatedCountryName = $locationCreatedCountryName;

        return $this;
    }

    public function setLocationCreatedGpsAltitude(
        string $locationCreatedGpsAltitude
    ): self {
        $this->locationCreatedGpsAltitude = $locationCreatedGpsAltitude;

        return $this;
    }

    public function setLocationCreatedGpsLatitude(
        string $locationCreatedGpsLatitude
    ): self {
        $this->locationCreatedGpsLatitude = $locationCreatedGpsLatitude;

        return $this;
    }

    public function setLocationCreatedGpsLongitude(
        string $locationCreatedGpsLongitude
    ): self {
        $this->locationCreatedGpsLongitude = $locationCreatedGpsLongitude;

        return $this;
    }

    public function setLocationCreatedLocationID(
        string $locationCreatedLocationID
    ): self {
        $this->locationCreatedLocationID = $locationCreatedLocationID;

        return $this;
    }

    public function setLocationCreatedLocationName(
        string $locationCreatedLocationName
    ): self {
        $this->locationCreatedLocationName = $locationCreatedLocationName;

        return $this;
    }

    public function setLocationCreatedProvinceState(
        string $locationCreatedProvinceState
    ): self {
        $this->locationCreatedProvinceState = $locationCreatedProvinceState;

        return $this;
    }

    public function setLocationCreatedSublocation(
        string $locationCreatedSublocation
    ): self {
        $this->locationCreatedSublocation = $locationCreatedSublocation;

        return $this;
    }

    public function setLocationCreatedWorldRegion(
        string $locationCreatedWorldRegion
    ): self {
        $this->locationCreatedWorldRegion = $locationCreatedWorldRegion;

        return $this;
    }

    /**
     * @param list<string> $locationShownCity
     */
    public function setLocationShownCity(array $locationShownCity): self
    {
        $this->locationShownCity = $locationShownCity;

        return $this;
    }

    /**
     * @param list<string> $locationShownCountryCode
     */
    public function setLocationShownCountryCode(
        array $locationShownCountryCode
    ): self {
        $this->locationShownCountryCode = $locationShownCountryCode;

        return $this;
    }

    /**
     * @param list<string> $locationShownCountryName
     */
    public function setLocationShownCountryName(
        array $locationShownCountryName
    ): self {
        $this->locationShownCountryName = $locationShownCountryName;

        return $this;
    }

    /**
     * @param list<string> $locationShownGpsAltitude
     */
    public function setLocationShownGpsAltitude(
        array $locationShownGpsAltitude
    ): self {
        $this->locationShownGpsAltitude = $locationShownGpsAltitude;

        return $this;
    }

    /**
     * @param list<string> $locationShownGpsLatitude
     */
    public function setLocationShownGpsLatitude(
        array $locationShownGpsLatitude
    ): self {
        $this->locationShownGpsLatitude = $locationShownGpsLatitude;

        return $this;
    }

    /**
     * @param list<string> $locationShownGpsLongitude
     */
    public function setLocationShownGpsLongitude(
        array $locationShownGpsLongitude
    ): self {
        $this->locationShownGpsLongitude = $locationShownGpsLongitude;

        return $this;
    }

    /**
     * @param list<string> $locationShownLocationID
     */
    public function setLocationShownLocationID(
        array $locationShownLocationID
    ): self {
        $this->locationShownLocationID = $locationShownLocationID;

        return $this;
    }

    /**
     * @param list<string> $locationShownLocationName
     */
    public function setLocationShownLocationName(
        array $locationShownLocationName
    ): self {
        $this->locationShownLocationName = $locationShownLocationName;

        return $this;
    }

    /**
     * @param list<string> $locationShownProvinceState
     */
    public function setLocationShownProvinceState(
        array $locationShownProvinceState
    ): self {
        $this->locationShownProvinceState = $locationShownProvinceState;

        return $this;
    }

    /**
     * @param list<string> $locationShownSublocation
     */
    public function setLocationShownSublocation(
        array $locationShownSublocation
    ): self {
        $this->locationShownSublocation = $locationShownSublocation;

        return $this;
    }

    /**
     * @param list<string> $locationShownWorldRegion
     */
    public function setLocationShownWorldRegion(
        array $locationShownWorldRegion
    ): self {
        $this->locationShownWorldRegion = $locationShownWorldRegion;

        return $this;
    }

    public function setMaxAvailHeight(float $maxAvailHeight): self
    {
        $this->maxAvailHeight = $maxAvailHeight;

        return $this;
    }

    public function setMaxAvailWidth(float $maxAvailWidth): self
    {
        $this->maxAvailWidth = $maxAvailWidth;

        return $this;
    }

    /**
     * @param list<float> $modelAge
     */
    public function setModelAge(array $modelAge): self
    {
        $this->modelAge = $modelAge;

        return $this;
    }

    /**
     * @param list<string> $modelReleaseID
     */
    public function setModelReleaseID(array $modelReleaseID): self
    {
        $this->modelReleaseID = $modelReleaseID;

        return $this;
    }

    public function setObjectAttributeReference(
        string $objectAttributeReference
    ): self {
        $this->objectAttributeReference = $objectAttributeReference;

        return $this;
    }

    public function setObjectName(string $objectName): self
    {
        $this->objectName = $objectName;

        return $this;
    }

    public function setOffsetTimeOriginal(string $offsetTimeOriginal): self
    {
        $this->offsetTimeOriginal = $offsetTimeOriginal;

        return $this;
    }

    /**
     * @param list<string> $organisationInImageCode
     */
    public function setOrganisationInImageCode(
        array $organisationInImageCode
    ): self {
        $this->organisationInImageCode = $organisationInImageCode;

        return $this;
    }

    /**
     * @param list<string> $organisationInImageName
     */
    public function setOrganisationInImageName(
        array $organisationInImageName
    ): self {
        $this->organisationInImageName = $organisationInImageName;

        return $this;
    }

    public function setOrientation(string $orientation): self
    {
        $this->orientation = $orientation;

        return $this;
    }

    public function setOriginalTransmissionReference(
        string $originalTransmissionReference
    ): self {
        $this->originalTransmissionReference = $originalTransmissionReference;

        return $this;
    }

    /**
     * @param list<string> $personInImage
     */
    public function setPersonInImage(array $personInImage): self
    {
        $this->personInImage = $personInImage;

        return $this;
    }

    /**
     * @param list<string> $personInImageCvTermCvID
     */
    public function setPersonInImageCvTermCvID(
        array $personInImageCvTermCvID
    ): self {
        $this->personInImageCvTermCvID = $personInImageCvTermCvID;

        return $this;
    }

    /**
     * @param list<string> $personInImageCvTermID
     */
    public function setPersonInImageCvTermID(array $personInImageCvTermID): self
    {
        $this->personInImageCvTermID = $personInImageCvTermID;

        return $this;
    }

    /**
     * @param list<string> $personInImageCvTermName
     */
    public function setPersonInImageCvTermName(
        array $personInImageCvTermName
    ): self {
        $this->personInImageCvTermName = $personInImageCvTermName;

        return $this;
    }

    /**
     * @param list<string> $personInImageCvTermRefinedAbout
     */
    public function setPersonInImageCvTermRefinedAbout(
        array $personInImageCvTermRefinedAbout
    ): self {
        $this->personInImageCvTermRefinedAbout = $personInImageCvTermRefinedAbout;

        return $this;
    }

    /**
     * @param list<string> $personInImageDescription
     */
    public function setPersonInImageDescription(
        array $personInImageDescription
    ): self {
        $this->personInImageDescription = $personInImageDescription;

        return $this;
    }

    /**
     * @param list<string> $personInImageID
     */
    public function setPersonInImageID(array $personInImageID): self
    {
        $this->personInImageID = $personInImageID;

        return $this;
    }

    /**
     * @param list<string> $personInImageName
     */
    public function setPersonInImageName(array $personInImageName): self
    {
        $this->personInImageName = $personInImageName;

        return $this;
    }

    /**
     * @param list<string> $productInImageDescription
     */
    public function setProductInImageDescription(
        array $productInImageDescription
    ): self {
        $this->productInImageDescription = $productInImageDescription;

        return $this;
    }

    /**
     * @param list<float> $productInImageGtin
     */
    public function setProductInImageGtin(array $productInImageGtin): self
    {
        $this->productInImageGtin = $productInImageGtin;

        return $this;
    }

    /**
     * @param list<string> $productInImageName
     */
    public function setProductInImageName(array $productInImageName): self
    {
        $this->productInImageName = $productInImageName;

        return $this;
    }

    /**
     * @param list<string> $propertyReleaseID
     */
    public function setPropertyReleaseID(array $propertyReleaseID): self
    {
        $this->propertyReleaseID = $propertyReleaseID;

        return $this;
    }

    public function setProvinceState(string $provinceState): self
    {
        $this->provinceState = $provinceState;

        return $this;
    }

    public function setRating(int $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * @param list<string> $registryEntryRole
     */
    public function setRegistryEntryRole(array $registryEntryRole): self
    {
        $this->registryEntryRole = $registryEntryRole;

        return $this;
    }

    /**
     * @param list<string> $registryItemID
     */
    public function setRegistryItemID(array $registryItemID): self
    {
        $this->registryItemID = $registryItemID;

        return $this;
    }

    /**
     * @param list<string> $registryOrganisationID
     */
    public function setRegistryOrganisationID(
        array $registryOrganisationID
    ): self {
        $this->registryOrganisationID = $registryOrganisationID;

        return $this;
    }

    public function setResolutionUnit(string $resolutionUnit): self
    {
        $this->resolutionUnit = $resolutionUnit;

        return $this;
    }

    public function setRights(string $rights): self
    {
        $this->rights = $rights;

        return $this;
    }

    /**
     * @param list<string> $scene
     */
    public function setScene(array $scene): self
    {
        $this->scene = $scene;

        return $this;
    }

    public function setSource(string $source): self
    {
        $this->source = $source;

        return $this;
    }

    public function setSpecialInstructions(string $specialInstructions): self
    {
        $this->specialInstructions = $specialInstructions;

        return $this;
    }

    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @param list<string> $subject
     */
    public function setSubject(array $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * @param list<string> $subjectCode
     */
    public function setSubjectCode(array $subjectCode): self
    {
        $this->subjectCode = $subjectCode;

        return $this;
    }

    /**
     * @param list<string> $subjectReference
     */
    public function setSubjectReference(array $subjectReference): self
    {
        $this->subjectReference = $subjectReference;

        return $this;
    }

    public function setSublocation(string $sublocation): self
    {
        $this->sublocation = $sublocation;

        return $this;
    }

    public function setTimeCreated(string $timeCreated): self
    {
        $this->timeCreated = $timeCreated;

        return $this;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function setTransmissionReference(
        string $transmissionReference
    ): self {
        $this->transmissionReference = $transmissionReference;

        return $this;
    }

    public function setUsageTerms(string $usageTerms): self
    {
        $this->usageTerms = $usageTerms;

        return $this;
    }

    public function setWebStatement(string $webStatement): self
    {
        $this->webStatement = $webStatement;

        return $this;
    }

    public function setWriter(string $writer): self
    {
        $this->writer = $writer;

        return $this;
    }

    public function setWriterEditor(string $writerEditor): self
    {
        $this->writerEditor = $writerEditor;

        return $this;
    }

    public function setXResolution(float $xResolution): self
    {
        $this->xResolution = $xResolution;

        return $this;
    }

    public function setYResolution(float $yResolution): self
    {
        $this->yResolution = $yResolution;

        return $this;
    }
}
