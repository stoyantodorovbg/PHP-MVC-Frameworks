<?php


namespace Core\DependencyManagement;


class Container implements ContainerInterface
{
    private $dependencies;

    private $cache;


    public function resolve($interfaceName)
    {
        if (array_key_exists($interfaceName, $this->cache)) {
            return $this->cache[$interfaceName];
        }

        if (interface_exists($interfaceName)) {
            $className = $this->dependencies[$interfaceName];
        } else if (class_exists($interfaceName)){
            $className = $interfaceName;
        } else {
            throw new \Exception('The type does not exists.');
        }
        $classInfo = new \ReflectionClass($className);
        $constructorInfo = $classInfo->getConstructor();

        if ($constructorInfo === null) {
            $obj = new $className();
            $this->cache($className, $obj);
            return $obj;
        }

        $resolvedParameters = [];
        foreach ($constructorInfo->getParameters() as $parameter) {
            $resolvedParameters[] = $this->resolve($parameter->getClass()->getName());
        }

        $obj = $classInfo->newInstanceArgs($resolvedParameters);
        $this->cache($interfaceName, $obj);

        return $obj;
    }

    public function addDependency($interfaceName, $implementationName)
    {
        $this->dependencies[$interfaceName] = $implementationName;
    }

    public function cache($interfaceName, $obj)
    {
        $this->cache[$interfaceName] = $obj;
    }

    public function exists($interfaceName): bool
    {
        return array_key_exists($interfaceName, $this->dependencies);
    }


}