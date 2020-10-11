# Phpunit

**You may clone and modify it as you wish**.

## How to use
 * extend **AbstractTestCase** or **AbstractKernelTestCase** if you need the symfony kernel
 * **Drjele\Utility\Phpunit\Mock** contains generic mocks

## Example

```php
namespace Acme\Test\Foo\Service;

use Acme\Foo\CreateService;
use Drjele\Utility\Phpunit\Mock\ManagerRegistryMock;
use Drjele\Utility\Phpunit\MockDto;
use Drjele\Utility\Phpunit\TestCase\AbstractTestCase;

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
