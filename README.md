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
cd phpunit/scripts/docker/

# the next instructions allow to run git from inside the container
cp ~/.ssh/id_* shared/.ssh/
NAME="your-name" &&
  EMAIL="your-email" &&
  CONFIG=('#!/bin/bash' 'if command -v git &> /dev/null; then' "git config --global user.name \"${NAME}\"" "git config --global user.email \"${EMAIL}\"" 'fi') && printf '%s\n' "${CONFIG[@]}" >>shared/.profile/.profile_local

docker-compose build && docker-compose up -d
docker-compose exec php sh

pfull
```

## Todo

* Unit tests.
