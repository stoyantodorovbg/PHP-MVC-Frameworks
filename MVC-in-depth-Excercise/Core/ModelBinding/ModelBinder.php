<?php


namespace Core\ModelBinding;


class ModelBinder implements ModelBinderInterface
{

    public function bind(array $data, $className)
    {
        $bindingModel = new $className();
        $bindingModelInfo = new \ReflectionClass($className);
        foreach($bindingModelInfo->getProperties() as $property){
            $propertyName = $property->getName();
            if (!array_key_exists($propertyName, $data)) {
                continue;
            }
            $value = $_POST[$propertyName];
            $setter = 'set'.ucfirst($propertyName);
            $bindingModel->$setter($value);
        }

        return $bindingModel;
    }
}