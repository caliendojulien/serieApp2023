<?php

namespace App\Factory;

use App\Entity\Serie;
use App\Repository\SerieRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Serie>
 *
 * @method        Serie|Proxy create(array|callable $attributes = [])
 * @method static Serie|Proxy createOne(array $attributes = [])
 * @method static Serie|Proxy find(object|array|mixed $criteria)
 * @method static Serie|Proxy findOrCreate(array $attributes)
 * @method static Serie|Proxy first(string $sortedField = 'id')
 * @method static Serie|Proxy last(string $sortedField = 'id')
 * @method static Serie|Proxy random(array $attributes = [])
 * @method static Serie|Proxy randomOrCreate(array $attributes = [])
 * @method static SerieRepository|RepositoryProxy repository()
 * @method static Serie[]|Proxy[] all()
 * @method static Serie[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Serie[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Serie[]|Proxy[] findBy(array $attributes)
 * @method static Serie[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Serie[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class SerieFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    protected static function getClass(): string
    {
        return Serie::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'name' => self::faker()->word(),
            'first_air_date' => self::faker()->dateTimeBetween('-15 years', 'now'),
            'date_created' => self::faker()->dateTimeThisMonth(),
            'overview' => self::faker()->sentence(),
            'tmdbId' => self::faker()->randomNumber()
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this// ->afterInstantiate(function(Serie $serie): void {})
            ;
    }
}
