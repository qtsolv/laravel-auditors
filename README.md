# quarks/laravel-auditors

Record created by, updated by and deleted by on [Eloquent](https://laravel.com/docs/6.x/eloquent) models automatically.

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

From now onwards, `createdBy`, `updatedBy` and `deletedBy` on this model will be saved automatically on `created`,
`updated` and `deleted` model events respectively.

### License

See [LICENSE](LICENSE) file.
