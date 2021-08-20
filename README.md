# quarks/laravel-auditors

Record created by, updated by and deleted by (if [SoftDeletes](https://laravel.com/docs/6.x/eloquent#soft-deleting) added) on [Eloquent](https://laravel.com/docs/6.x/eloquent) models automatically.

[![Latest Version][latest-version-image]][latest-version-url]
[![Downloads][downloads-image]][downloads-url]
[![PHP Version][php-version-image]][php-version-url]
[![License][license-image]](LICENSE)

### Installation

```bash
composer require quarks/laravel-auditors
```

### Usage

In your migration classes, add the auditor columns to your table as below:

```php
/**
 * Run the migrations.
 *
 * @return void
 */
public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->auditors();
    });
}

/**
 * Reverse the migrations.
 *
 * @return void
 */
public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropAuditors();
    });
}
```

Then add the `HasAuditors` trait your model classes as follows:

```php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Quarks\Laravel\Auditors\HasAuditors;

class User extends Authenticatable
{
    use HasAuditors;
}
```

From now onwards, `createdBy`, `updatedBy` and `deletedBy` relations on this model will automatically be saved on
`created`, `updated` and `deleted` model events respectively.

### License

See [LICENSE](LICENSE) file.

[latest-version-image]: https://img.shields.io/github/release/qtsolv/laravel-auditors.svg?style=flat-square
[latest-version-url]: https://github.com/qtsolv/laravel-auditors/releases
[downloads-image]: https://img.shields.io/packagist/dt/quarks/laravel-auditors.svg?style=flat-square
[downloads-url]: https://packagist.org/packages/quarks/laravel-auditors
[php-version-image]: http://img.shields.io/badge/php-7.2+-8892be.svg?style=flat-square
[php-version-url]: https://www.php.net/downloads
[license-image]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
