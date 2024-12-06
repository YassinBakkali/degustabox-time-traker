<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Bus\Command;

use Exception;
use App\Shared\Domain\Bus\Command\Command;
use App\Shared\Domain\Bus\Command\CommandBus;
use Override;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;
use Symfony\Component\Messenger\Exception\NoHandlerForMessageException;
use Symfony\Component\Messenger\Handler\HandlersLocator;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Messenger\Middleware\HandleMessageMiddleware;

final class InMemorySymfonyCommandBus implements CommandBus
{
    private readonly MessageBus $bus;

    public function __construct(iterable $commandHandlers)
    {
        $handlers  = $this->getHandlers($commandHandlers);
        $this->bus = new MessageBus([new HandleMessageMiddleware(new HandlersLocator($handlers)), ]);
    }

    /**
     * @throws Exception
     */
    #[Override]
    public function dispatch(Command $command): void
    {
        try {
            $this->bus->dispatch($command);
        } catch (NoHandlerForMessageException) {
            throw new CommandNotRegisteredError($command);
        } catch (Exception $e) {
            throw $e->getPrevious() ?? $e;
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
                $reflectionParameter = $method->getParameters()[0];
                return [$reflectionParameter->getType()->getName() => [$class]];
            }
        } catch (ReflectionException) {
            return null;
        }

        return null;
    }
}
