<?php

namespace App\DependencyInjection\Compiler;

use App\Strategy\BuildingStrategyInterface;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class BuildingCompilerPass implements CompilerPassInterface
{
    /**
     * @inheritDoc
     */
    public function process(ContainerBuilder $container)
    {
        $buildingStrategy = $container->getDefinition('App\Strategy\BuildingStrategy');
        foreach ($container->getDefinitions() as $definition){
            try {
                $class = new \ReflectionClass($definition->getClass());
            } catch (\ReflectionException $e) {
                return false;
            }

            if (!$class->implementsInterface(BuildingStrategyInterface::class)){
                continue;
            }

            $buildingStrategy->addMethodCall('addBuildingStrategy', [$definition]);
        }
    }
}