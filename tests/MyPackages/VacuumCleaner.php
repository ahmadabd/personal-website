<?php

namespace Tests\MyPackages;

trait VacuumCleaner
{
    /**
     * Unset each property declared in this test class and its traits.
     *
     * @return void
     */
    protected function clearProperties(): void
    {
        foreach ((new \ReflectionObject($this))->getProperties() as $property) {
            if (!$property->isStatic() && __CLASS__ === $property->getDeclaringClass()->getName()) {
                unset($this->{$property->getName()});
            }
        }

        \Illuminate\Container\Container::setInstance();
        gc_collect_cycles();
    }
}
