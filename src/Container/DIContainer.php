<?php

namespace Kestutisbilotas\Container;

use Kestutisbilotas\Controllers\CalcController;
use Kestutisbilotas\Models\CalcAll;
use Kestutisbilotas\Models\ValidateData;
use Kestutisbilotas\Framework\Router;
use RuntimeException;


class DIContainer
{
    private array $entries = [];

    public function get(string $id)
    {
        if (!$this->has($id)) {
            throw new RuntimeException('Class ' . $id . 'not found in container.');
        }
        $entry = $this->entries[$id];

        return $entry($this);
    }

    public function has(string $id): bool
    {
        return isset($this->entries[$id]);
    }

    public function set(string $id, callable $callable): void
    {
        $this->entries[$id] = $callable;
    }

    public function loadDependencies()
    {
        $this->set(
            CalcController::class,
            function (DIContainer $container) {
                return new CalcController(
                    $container->get(CalcAll::class)
                );
            }
        );

        $this->set(
            Router::class,
            function (DIContainer $container) {
                return new Router(
                    $container->get(CalcController::class),

                );
            }
        );

        $this->set(
            CalcAll::class,
            function (DIContainer $container) {
                return new CalcAll();
            }
        );

        $this->set(
            CalcController::class,
            function (DIContainer $container) {
                return new CalcController();
            }
        );
    }
}