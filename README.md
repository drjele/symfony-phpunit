# Phpunit

**You may fork and modify it as you wish**.

Any suggestions are welcomed.

## How to use

* Extend **\Drjele\SymfonyPhpunit\TestCase\AbstractTestCase** or **\Drjele\SymfonyPhpunit\TestCase\AbstractKernelTestCase** if you need the symfony kernel.
* **Drjele\SymfonyPhpunit\Mock** contains generic mocks.

## Example

```php
namespace Acme\Test\Foo\Service;

use Acme\Foo\Repository\FooRepository;
use Acme\Foo\Service\CreateService;
use Drjele\SymfonyPhpunit\Mock\ManagerRegistryMock;
use Drjele\SymfonyPhpunit\MockDto;
use Drjele\SymfonyPhpunit\TestCase\AbstractTestCase;

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
