<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Bus\Query;

use Exception;
use App\Shared\Domain\Bus\Query\Query;
use App\Shared\Domain\Bus\Query\QueryBus;
use App\Shared\Domain\Bus\Query\Response;
use Override;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;
use ReflectionParameter;
use Symfony\Component\Messenger\Exception\NoHandlerForMessageException;
use Symfony\Component\Messenger\Handler\HandlersLocator;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Messenger\Middleware\HandleMessageMiddleware;
use Symfony\Component\Messenger\Stamp\HandledStamp;

final class InMemorySymfonyQueryBus implements QueryBus
{
    private readonly MessageBus $bus;

    public function __construct(iterable $queryHandlers)
    {
        $this->bus = new MessageBus(
            [new HandleMessageMiddleware(new HandlersLocator($this->getHandlers($queryHandlers))), ]
        );
    }

    #[Override]
    public function ask(Query $query): ?Response
    {
        try {
            /** @var HandledStamp $stamp */
            $stamp = $this->bus->dispatch($query)->last(HandledStamp::class);

            return $stamp->getResult();
        } catch (NoHandlerForMessageException) {
            throw new QueryNotRegisteredError($query);
        } catch (Exception $exception) {
            throw $exception->getPrevious();
        }
    }

    private function getHandlers(iterable $commandHandlers): array
    {
        $handlers = [];
        foreach ($commandHandlers as $commandHandler) {
            $handler  = $this->extract($commandHandler);
            $handlers = array_merge($handlers, $handler);
        }
        return $handlers;
    }

    private function extract($class): ?array
    {
        $reflector = new ReflectionClass($class);
        /**
         * @var ReflectionMethod $method
         */
        try {
            $method = $reflector->getMethod('__invoke');
            if ($method->getNumberOfParameters() === 1) {
                /**
                 * @var ReflectionParameter $reflectionParameter
                 */
                $reflectionParameter = $method->getParameters()[0];
                return [$reflectionParameter->getType()->getName() => [$class]];
            }
        } catch (ReflectionException) {
            return null;
        }
        return null;
    }
}
