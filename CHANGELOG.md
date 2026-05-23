# Changelog

## 0.1.0 (2026-05-23)

Full Changelog: [v0.0.1...v0.1.0](https://github.com/imagekit-developer/imagekit-php/compare/v0.0.1...v0.1.0)

### ⚠ BREAKING CHANGES

* remove unused webhook params
* replace special flag type `omittable` with just `null`
* use aliases for phpstan types
* improve identifier renaming for names that clash with builtins
* use camel casing for all class properties
* **client:** redesign methods
* remove confusing `toArray()` alias to `__serialize()` in favour of `toProperties()`
* expose services and service contracts

### Features

* add `BaseResponse` class for accessing raw responses ([f7102f9](https://github.com/imagekit-developer/imagekit-php/commit/f7102f9b0eb254f51e210ee9a5106cdbff98b3a6))
* add idempotency header support ([aabdd47](https://github.com/imagekit-developer/imagekit-php/commit/aabdd475e597cf8a33699651aeaa7fc6d8681b52))
* add setters to constant parameters ([2a1cdf8](https://github.com/imagekit-developer/imagekit-php/commit/2a1cdf802ce25941729d92632ac88ec11d708fda))
* allow both model class instances and arrays in setters ([eee2c6e](https://github.com/imagekit-developer/imagekit-php/commit/eee2c6ec19c56a1635840341ee047f6e3b790142))
* **api:** add BaseWebhookEvent ([84f5b7c](https://github.com/imagekit-developer/imagekit-php/commit/84f5b7c65eb1b7b23fdda823aca71c51b73023e3))
* **api:** add customMetadata property to folder schema ([2b8763e](https://github.com/imagekit-developer/imagekit-php/commit/2b8763e03a721ac880ff51dc41a0b5a075916bf2))
* **api:** add GetImageAttributesOptions and ResponsiveImageAttributes schemas; update resource references in main.yaml; remove dummy endpoint ([f2b5264](https://github.com/imagekit-developer/imagekit-php/commit/f2b52643c14ced1fe4264ddc4517c3394b0cc507))
* **api:** add no-enlarge crop modes and colorize transformation ([ffebb94](https://github.com/imagekit-developer/imagekit-php/commit/ffebb946ee7e6ceca5824d9fb0ded368ba439431))
* **api:** add path policy related non-breaking changes ([b961183](https://github.com/imagekit-developer/imagekit-php/commit/b961183d52e6374915bb9d1d403c89f561ed53a2))
* **api:** Add saved extensions API and enhance transformation options ([2299402](https://github.com/imagekit-developer/imagekit-php/commit/229940265d3a5e7ba42bf3fd5ecaec92d67c1e6d))
* **api:** add selectedFieldsSchema in upload and list API response ([24b3de1](https://github.com/imagekit-developer/imagekit-php/commit/24b3de13174ce310577db618727add52833b00ef))
* **api:** add webhook verification ([f229b60](https://github.com/imagekit-developer/imagekit-php/commit/f229b603c92e55e54ebf745b07bc97a86ec04358))
* **api:** dam related webhook events ([a9623d9](https://github.com/imagekit-developer/imagekit-php/commit/a9623d953b519a3b526dc98993a8e762459a0eae))
* **api:** dpr type update ([ee5e13b](https://github.com/imagekit-developer/imagekit-php/commit/ee5e13b4b0776354070b0fb51a6acd56743bb680))
* **api:** extract UpdateFileDetailsRequest to model ([8628e12](https://github.com/imagekit-developer/imagekit-php/commit/8628e12e2bdb99f3755bb1ea960547876fcccf00))
* **api:** fix spec indentation ([c98a0fb](https://github.com/imagekit-developer/imagekit-php/commit/c98a0fbfa6db3824d263d51e1b50446fb6344877))
* **api:** fix upload API request params ([d79cd68](https://github.com/imagekit-developer/imagekit-php/commit/d79cd6841ecb59fd1360663036af57b27c00f8fa))
* **api:** indentation fix ([8190166](https://github.com/imagekit-developer/imagekit-php/commit/8190166ab4aeef88bc35fec0140ea7bbedbc3d77))
* **api:** Introduce lxc, lyc, lap parameters in overlays. ([0f57760](https://github.com/imagekit-developer/imagekit-php/commit/0f5776049a1c25d6d957d1f93d919db41ea3de33))
* **api:** manual updates ([9c45ffa](https://github.com/imagekit-developer/imagekit-php/commit/9c45ffaa1995b69c467d307238b2882944b3c7ad))
* **api:** manual updates ([333c06b](https://github.com/imagekit-developer/imagekit-php/commit/333c06bedfbe8d5a91d1549ad5d67f05e794d159))
* **api:** manual updates ([2d65a57](https://github.com/imagekit-developer/imagekit-php/commit/2d65a573684fed507cfb7397f73ef22b9d9e8f94))
* **api:** manual updates ([bfc46ad](https://github.com/imagekit-developer/imagekit-php/commit/bfc46add70562512b60928554638368443b6e38c))
* **api:** manual updates ([46dbc22](https://github.com/imagekit-developer/imagekit-php/commit/46dbc22461339a6be4f275f57b4f74a6fc2e4625))
* **api:** manual updates ([e5c1428](https://github.com/imagekit-developer/imagekit-php/commit/e5c142868fae36f9f88f4142b98b47a1abbbaa1c))
* **api:** manual updates ([2361086](https://github.com/imagekit-developer/imagekit-php/commit/2361086b4a3578fc04ac20da138d1ebcf3f92852))
* **api:** manual updates ([de13f68](https://github.com/imagekit-developer/imagekit-php/commit/de13f687044f442b41ec1de7a72c2fd3ad27f1e1))
* **api:** manual updates ([79f9906](https://github.com/imagekit-developer/imagekit-php/commit/79f9906770fee9602f9b1ed6397b5b00f015bcd2))
* **api:** manual updates ([0daa175](https://github.com/imagekit-developer/imagekit-php/commit/0daa17580a73ebd447e344f01fa36f1fb593dd4d))
* **api:** manual updates ([6ec4a94](https://github.com/imagekit-developer/imagekit-php/commit/6ec4a94508922f91f34d9b58226e047de6c40399))
* **api:** manual updates ([2ebe4bf](https://github.com/imagekit-developer/imagekit-php/commit/2ebe4bffb958f8cd8c923b285bdb79b4d93ea755))
* **api:** manual updates ([8aecc6e](https://github.com/imagekit-developer/imagekit-php/commit/8aecc6ee1d42589a554687c3a8138ff764ba223f))
* **api:** manual updates ([3ac5bb6](https://github.com/imagekit-developer/imagekit-php/commit/3ac5bb60ab1b828c27a17e8d499309c1ac077dd9))
* **api:** manual updates ([864a1aa](https://github.com/imagekit-developer/imagekit-php/commit/864a1aa121d394cbc89a9b305d03177777fe173e))
* **api:** merge with main to bring back missing parameters ([313dcf4](https://github.com/imagekit-developer/imagekit-php/commit/313dcf40608dae77f12045de3e77878b33edd638))
* **api:** remove Stainless attribution from readme ([a6f01f0](https://github.com/imagekit-developer/imagekit-php/commit/a6f01f0756a28bb4deafc5f65480aad544c12947))
* **api:** revert dpr breaking change ([b97b7d6](https://github.com/imagekit-developer/imagekit-php/commit/b97b7d6717de6ffcd76dff3d159081f7bfd31360))
* **api:** update api docs link ([aff2c75](https://github.com/imagekit-developer/imagekit-php/commit/aff2c753975007fed90c0400fef40c50a42d5587))
* **api:** Update env var name ([a3edfdd](https://github.com/imagekit-developer/imagekit-php/commit/a3edfdd78c4a8aa37d18c74d0adade953a63d834))
* **api:** update package names for Python and PHP targets in configuration ([264d6cf](https://github.com/imagekit-developer/imagekit-php/commit/264d6cf84f2853f08a2457d22b9aade5e7c6d375))
* **api:** update webhook event names and remove DAM prefix ([e53bd51](https://github.com/imagekit-developer/imagekit-php/commit/e53bd5165e47bbe6d15413fa34120947afa3b28c))
* **api:** updated docs ([8970696](https://github.com/imagekit-developer/imagekit-php/commit/8970696de6da93147e3e9cacc7e80a59dadaa5f3))
* **client:** add raw methods ([049e837](https://github.com/imagekit-developer/imagekit-php/commit/049e837e2827e68c6cada81e7e35e3ddef23beb9))
* **client:** redesign methods ([bf6c4d6](https://github.com/imagekit-developer/imagekit-php/commit/bf6c4d658f92eb53b032dafe0c3569cb4e8a0c2a))
* **client:** support raw responses ([cc5397d](https://github.com/imagekit-developer/imagekit-php/commit/cc5397ddbb7a5a58b22f25037a76cc502a972692))
* **client:** use real enums ([0b65863](https://github.com/imagekit-developer/imagekit-php/commit/0b65863c45d58bf52bca76cfa8f7560e381d7dc9))
* expose services and service contracts ([1329184](https://github.com/imagekit-developer/imagekit-php/commit/13291847d68a49a7468bf64dac797124ad8b2178))
* improve identifier renaming for names that clash with builtins ([629e73b](https://github.com/imagekit-developer/imagekit-php/commit/629e73bd717a76d55f745a1b25dcec1e38d692d6))
* improved phpstan type annotations ([29c5644](https://github.com/imagekit-developer/imagekit-php/commit/29c564459ff158230f1efcfd80115ff911022c86))
* remove confusing `toArray()` alias to `__serialize()` in favour of `toProperties()` ([6b0dfb3](https://github.com/imagekit-developer/imagekit-php/commit/6b0dfb31fc142c9c34f061ba48f469973ade55a3))
* replace special flag type `omittable` with just `null` ([37f7fda](https://github.com/imagekit-developer/imagekit-php/commit/37f7fdabd844ff3bef85aae719b02ded1da5aadf))
* simplify and make the phpstan types more consistent ([a48eabf](https://github.com/imagekit-developer/imagekit-php/commit/a48eabf27bc0717621987efcace7886a9611e10b))
* split out services into normal & raw types ([72581b3](https://github.com/imagekit-developer/imagekit-php/commit/72581b38ac28d0bc43aa76e0df66a66a53c744e5))
* support setting headers via env ([ca265ee](https://github.com/imagekit-developer/imagekit-php/commit/ca265eedd4fdf0c13f8dc90525ff1c28845fcc5e))
* support unwrapping envelopes ([387f46c](https://github.com/imagekit-developer/imagekit-php/commit/387f46c0d4956e0df99308f0c407c17bc23970ae))
* use `$_ENV` aware getenv helper ([ad42299](https://github.com/imagekit-developer/imagekit-php/commit/ad42299eeecb6784d17adf834fa522d03a62d801))
* use aliases for phpstan types ([b7e0d88](https://github.com/imagekit-developer/imagekit-php/commit/b7e0d887e721da064ebce2d8f4319af258170d5e))
* use camel casing for all class properties ([64f685c](https://github.com/imagekit-developer/imagekit-php/commit/64f685c64536578e988e610150d2b85a7d28529d))


### Bug Fixes

* a number of serialization errors ([328063f](https://github.com/imagekit-developer/imagekit-php/commit/328063f0ab0c9604527c9adb1dc5015778e52de1))
* add ai-tasks property to response schemas with enum values ([4694d71](https://github.com/imagekit-developer/imagekit-php/commit/4694d7135602bdbac9d7ad210f4bba10fa5a3693))
* **api:** add missing embeddedMetadata and video properties to FileDetails ([d42768b](https://github.com/imagekit-developer/imagekit-php/commit/d42768bef461fd55c7e45213518caadadbc77c4c))
* **api:** extract shared schemas to prevent Go webhook union breaking changes ([68c5081](https://github.com/imagekit-developer/imagekit-php/commit/68c5081d55cfcfe59a960e12e8c2c5fec62d3183))
* **api:** rename DamFile events to File for consistency ([3841282](https://github.com/imagekit-developer/imagekit-php/commit/3841282a5cfb0001a4674247a54cfd6fea359f9b))
* **ci:** release doctor workflow ([5a4ecfc](https://github.com/imagekit-developer/imagekit-php/commit/5a4ecfc9579954ed381c99fe5cba7d1cca3e8520))
* **client:** elide client methods in docs ([d3e94af](https://github.com/imagekit-developer/imagekit-php/commit/d3e94af126fa9bf00a0a704aa9fbc8e37125447a))
* **client:** handle C-style escaped characters ([497b114](https://github.com/imagekit-developer/imagekit-php/commit/497b114e1861becb85e3e6682ae6421a1a607857))
* **client:** properly generate file params ([60d37dc](https://github.com/imagekit-developer/imagekit-php/commit/60d37dc437cbdf8cead0be7cc62072975400605b))
* **client:** properly import fully qualified names ([2da9342](https://github.com/imagekit-developer/imagekit-php/commit/2da9342a698593e82e15db1b8966b888684a862e))
* **client:** resolve serialization issue with unions and enums ([ab78911](https://github.com/imagekit-developer/imagekit-php/commit/ab78911fb20ccaedcf28d7facf05a93d8633d624))
* correctly serialize dates ([cfc1686](https://github.com/imagekit-developer/imagekit-php/commit/cfc16863ed169c087bd75f0b9a66715aab8aa80f))
* decorate with enum label for all enum classes ([c3ea060](https://github.com/imagekit-developer/imagekit-php/commit/c3ea060ee47054167b8db064d3b423065fb106c1))
* guzzle requires special handling to enable streaming ([b0f95d6](https://github.com/imagekit-developer/imagekit-php/commit/b0f95d62d3af6efd2f78e2a63f52a2f4df65c36b))
* inverted retry condition ([493710d](https://github.com/imagekit-developer/imagekit-php/commit/493710dc24182fc6c2162a9554e45402ab43a2f7))
* **php:** fix typo in options parsing ([2809bb4](https://github.com/imagekit-developer/imagekit-php/commit/2809bb451cd619af703ec50d29eba0b1a19371cf))
* phpStan linter errors ([4cb4ba0](https://github.com/imagekit-developer/imagekit-php/commit/4cb4ba01a9054a10d74cad43d64228f685bfde2e))
* populate enum-typed properties with enum instances ([9c715d0](https://github.com/imagekit-developer/imagekit-php/commit/9c715d0280fbb44b77db3fc1338ab13959c57378))
* remove unused webhook params ([0aea279](https://github.com/imagekit-developer/imagekit-php/commit/0aea279726fe6954cfdfc84c121e45ce9342f7b4))
* rename invalid types ([59bcbf0](https://github.com/imagekit-developer/imagekit-php/commit/59bcbf0d82436725efb8f63c405a088ab92b10c2))
* revert accidental code deletion ([7649278](https://github.com/imagekit-developer/imagekit-php/commit/7649278a7a6c5e74a7f58e1743c1843f3f1f1f47))
* revert enum parsing change that lead to unconditional failure ([cc2e7bd](https://github.com/imagekit-developer/imagekit-php/commit/cc2e7bd5a1919234353281c80c75e4049ab4b894))
* support arrays in query param construction ([6f1f9dd](https://github.com/imagekit-developer/imagekit-php/commit/6f1f9dd3d46c7122dd103a6d721e51c20066a142))
* typos in README.md ([d731ff1](https://github.com/imagekit-developer/imagekit-php/commit/d731ff1d6f21a3ac47c758e87e8219664962f1fb))
* used redirect count instead of retry count in base client ([c8864b8](https://github.com/imagekit-developer/imagekit-php/commit/c8864b87a493e4d51647f4efc6ae5320102d955d))
* vocab field is required ([a1f0a2c](https://github.com/imagekit-developer/imagekit-php/commit/a1f0a2c5c1867b9b6101d39eea7e8b70d32e34b9))


### Chores

* add git attributes and composer lock file ([40f7b97](https://github.com/imagekit-developer/imagekit-php/commit/40f7b97fa95c8c82feb267e006872c5107a0a26c))
* add license ([c0f6216](https://github.com/imagekit-developer/imagekit-php/commit/c0f621686ed7fc92fd4618393bbdc4ad7bea8a91))
* be more targeted in suppressing superfluous linter warnings ([577f528](https://github.com/imagekit-developer/imagekit-php/commit/577f5285b139a39f605dc3e38773eb0ecf5bbef5))
* better support for phpstan ([574a0bb](https://github.com/imagekit-developer/imagekit-php/commit/574a0bbda02bdae57ec2a5655aee2f1264d8a1c3))
* client instantiation refactor ([8341019](https://github.com/imagekit-developer/imagekit-php/commit/834101926d2a3ad566a8c3880e1a5a0dffde9f63))
* **client:** refactor error type constructors ([cecffe1](https://github.com/imagekit-developer/imagekit-php/commit/cecffe1980bb81dedee05968b8046c95c4db02d1))
* **client:** send metadata headers ([130ede9](https://github.com/imagekit-developer/imagekit-php/commit/130ede91a7873981a7696eb90b70c1e1780c8215))
* **docs:** update readme formatting ([2831746](https://github.com/imagekit-developer/imagekit-php/commit/283174604767a8fe614ca521462f691572a695a4))
* document parameter object usage ([c959bcf](https://github.com/imagekit-developer/imagekit-php/commit/c959bcf6d18e0f078fbed9d50c05d6feb1d81a42))
* ensure constant values are marked as optional in array types ([59bab21](https://github.com/imagekit-developer/imagekit-php/commit/59bab215c6165b2290ca08bb3aee44d16721a308))
* fix lints in UnionOf ([a57c7cc](https://github.com/imagekit-developer/imagekit-php/commit/a57c7cc9f5131daea2a45d261b414a3deed3adba))
* formatting ([a11b751](https://github.com/imagekit-developer/imagekit-php/commit/a11b7519be814fe8955f2a3d564b342572883cf2))
* **internal:** add a basic client test ([2994f2d](https://github.com/imagekit-developer/imagekit-php/commit/2994f2d6f65889a67ceccfb274944b517f86793f))
* **internal:** codegen related update ([32cccc6](https://github.com/imagekit-developer/imagekit-php/commit/32cccc6bf639fb685938afb689b46f5b65106c12))
* **internal:** codegen related update ([65b995a](https://github.com/imagekit-developer/imagekit-php/commit/65b995aa83c6cf09fa55f784cf06fd3c8f95c0ff))
* **internal:** codegen related update ([cc9408e](https://github.com/imagekit-developer/imagekit-php/commit/cc9408e49527807fd3a91d07c226d380b52247de))
* **internal:** codegen related update ([87b1637](https://github.com/imagekit-developer/imagekit-php/commit/87b1637ba7e0943ebd19f65cbadd9857cc6deb80))
* **internal:** codegen related update ([0215531](https://github.com/imagekit-developer/imagekit-php/commit/0215531088e798a7ffbb41fc92afdba93e615305))
* **internal:** codegen related update ([c91e314](https://github.com/imagekit-developer/imagekit-php/commit/c91e31405811b0ec13c47d6640c80e4ac988bca4))
* **internal:** codegen related update ([ce694ee](https://github.com/imagekit-developer/imagekit-php/commit/ce694eea2c03e9b50fb0055980a7789fd2fdaf63))
* **internal:** codegen related update ([10d85fa](https://github.com/imagekit-developer/imagekit-php/commit/10d85fa72d5cf2e3025f7fafd495f651372ccaa0))
* **internal:** codegen related update ([e896f2b](https://github.com/imagekit-developer/imagekit-php/commit/e896f2bf3e12423cec0f242ab9c19eb268fd3b87))
* **internal:** codegen related update ([7d97124](https://github.com/imagekit-developer/imagekit-php/commit/7d97124eff55d2d54e6b1877174bc2eb7206665c))
* **internal:** codegen related update ([65e8d5f](https://github.com/imagekit-developer/imagekit-php/commit/65e8d5ff7c465323eb396caaab93870c09f94e84))
* **internal:** codegen related update ([8cce69f](https://github.com/imagekit-developer/imagekit-php/commit/8cce69f9353760cd01788b3ae56718dbdbddc540))
* **internal:** codegen related update ([cd71972](https://github.com/imagekit-developer/imagekit-php/commit/cd71972213770889ed4417a69849a9c4504b5d00))
* **internal:** codegen related update ([cf2eb10](https://github.com/imagekit-developer/imagekit-php/commit/cf2eb10b550e628dcd50528ea1ba6d18aba812f3))
* **internal:** codegen related update ([bde112f](https://github.com/imagekit-developer/imagekit-php/commit/bde112f4d3a020051e13c581c3ff7bc89f7b27a9))
* **internal:** codegen related update ([76b7d1a](https://github.com/imagekit-developer/imagekit-php/commit/76b7d1a3bec0ff36b996eceb7af07a54f4a8439a))
* **internal:** ignore stainless-internal artifacts ([8e06db7](https://github.com/imagekit-developer/imagekit-php/commit/8e06db7959b044ab844db8eb2ca530740f01b084))
* **internal:** minor test script reformatting ([4572ac9](https://github.com/imagekit-developer/imagekit-php/commit/4572ac94b4784db86b2fe41e4458e73d1c6e98e8))
* **internal:** php cs fixer should not be memory limited ([ffce92f](https://github.com/imagekit-developer/imagekit-php/commit/ffce92feb7a761600be48db66c357ac4be6a27b4))
* **internal:** refactor auth by moving concern from base client into client ([a29d53f](https://github.com/imagekit-developer/imagekit-php/commit/a29d53f233f62dfccfa69e7487fdf8bc79f19d57))
* **internal:** refactor base client internals ([aba7242](https://github.com/imagekit-developer/imagekit-php/commit/aba7242684bdef5c8926ef4f1e7b0909650cbf17))
* **internal:** remove mock server code ([bc5a3ed](https://github.com/imagekit-developer/imagekit-php/commit/bc5a3ed131b03c042fa8020f0b85d8d0ab70546a))
* **internal:** restructure some imports ([9a9fe93](https://github.com/imagekit-developer/imagekit-php/commit/9a9fe9357a5a0a614bd2f546a4606698cb289a8f))
* **internal:** tweak CI branches ([df01794](https://github.com/imagekit-developer/imagekit-php/commit/df01794af8a40d7154495cdc1c33cb51c3875cf2))
* **internal:** update `actions/checkout` version ([a086098](https://github.com/imagekit-developer/imagekit-php/commit/a08609804375fcbb528ca08b82cf935d7f6dddf5))
* **internal:** update phpstan comments ([5b9a607](https://github.com/imagekit-developer/imagekit-php/commit/5b9a60764c121078ddebc742a9f1787b8d5dac1a))
* **internal:** upgrade phpunit ([ac20448](https://github.com/imagekit-developer/imagekit-php/commit/ac20448a0f856ea1afa12b120dd59d3d33384cfc))
* none ([a29b310](https://github.com/imagekit-developer/imagekit-php/commit/a29b310c8c6d916ecb9098e81ab4c1f29034e506))
* **readme:** remove beta warning now that we're in ga ([1c52ed5](https://github.com/imagekit-developer/imagekit-php/commit/1c52ed5f2b1cadca880e71230a475077e9fc749a))
* refactor methods ([759837c](https://github.com/imagekit-developer/imagekit-php/commit/759837c405f3861d56b463b84e2344cf0a3a82f7))
* switch from `#[Api(optional: true|false)]` to `#[Required]|#[Optional]` for annotations ([229f706](https://github.com/imagekit-developer/imagekit-php/commit/229f706c0368dbbd51cf56a683eba73c301c1b89))
* sync repo ([bb14ef3](https://github.com/imagekit-developer/imagekit-php/commit/bb14ef396deb2b1bccc1e8d80da4bd47e3a04427))
* typing updates ([4208922](https://github.com/imagekit-developer/imagekit-php/commit/420892242261f1a4e5099a1dbfe7bd2705ce88c5))
* update mock server docs ([d02f1aa](https://github.com/imagekit-developer/imagekit-php/commit/d02f1aa5f9b7dbe551ae0822943ea38c0622a825))
* update SDK settings ([6913a6d](https://github.com/imagekit-developer/imagekit-php/commit/6913a6de33f625b50dc0aa5881e1208e136c8b2a))
* use `$self = clone $this;` instead of `$obj = clone $this;` ([1baa8c0](https://github.com/imagekit-developer/imagekit-php/commit/1baa8c086edb663887b7a8ffe7975e5c1e96b203))
* use non-trivial test assertions ([bcbfa80](https://github.com/imagekit-developer/imagekit-php/commit/bcbfa809e6b7e3f995cd8cddf8b55da68a89bedf))
* use pascal case for phpstan typedefs ([8d8f4fc](https://github.com/imagekit-developer/imagekit-php/commit/8d8f4fcc8d20dd6ccdb4825f438e14ec71bb4600))
* use single quote strings ([2a67006](https://github.com/imagekit-developer/imagekit-php/commit/2a67006f8a94fec12ca7d862cd6340d6a1b39f4e))


### Documentation

* correct typo in default value description for custom metadata field ([d0d0590](https://github.com/imagekit-developer/imagekit-php/commit/d0d0590988600c967eb2d54f0bf3c06868dc6942))
* improve examples ([333a5f5](https://github.com/imagekit-developer/imagekit-php/commit/333a5f51772b14a4e82ee4504f32f21fec6c4863))


### Refactors

* AITags to singular AITag schema with array items pattern ([15d5ae5](https://github.com/imagekit-developer/imagekit-php/commit/15d5ae51731a0f47527aeb3643b2cf75cc69151c))


### Build System

* **php:** set production target ([04e6535](https://github.com/imagekit-developer/imagekit-php/commit/04e65354ac22903e38ca02a0e4d95207bdaf9ce0))
