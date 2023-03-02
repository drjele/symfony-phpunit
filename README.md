# Phpunit

**You may fork and modify it as you wish**.

Any suggestions are welcomed.

## How to use

* Extend **\Drjele\Symfony\Phpunit\TestCase\AbstractTestCase** or **\Drjele\Symfony\Phpunit\TestCase\AbstractKernelTestCase** if you need the symfony kernel.
* **Drjele\Symfony\Phpunit\Mock** contains generic mocks.

## Example

```php
namespace Acme\Test\Foo\Service;

use Acme\Foo\Repository\FooRepository;
use Acme\Foo\Service\CreateService;
use Drjele\Symfony\Phpunit\Mock\ManagerRegistryMock;
use Drjele\Symfony\Phpunit\MockDto;
use Drjele\Symfony\Phpunit\TestCase\AbstractTestCase;

final class CreateServiceTest extends AbstractTestCase
{
    public static function getMockDto(): MockDto
    {
        return new MockDto(
            CreateService::class,
            [
                ManagerRegistryMock::class,
                new MockDto(FooRepository::class),
                'staticDependency'
            ],
            true
        );
    }

    public function testCreate(): void
    {
    }
}
```

## Dev

```shell
git clone git@gitlab.com:drjele-symfony/phpunit.git
cd phpunit

rm -rf .git/hooks && ln -s ../dev/git-hooks .git/hooks

./dc build && ./dc up -d
```

## Todo

* Unit tests.
