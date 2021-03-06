<?php

namespace Folklore\GraphQL\Relay;

use Closure;
use GraphQL\Type\Definition\ObjectType;

class EdgeObjectType extends ObjectType
{
    /**
     * @param $type
     * @return mixed
     */
    public function setEdgeType($type)
    {
        $this->_fields  = null;
        $currentFields  = array_get($this->config, 'fields');
        $fieldsResolver = function () use ($currentFields, $type) {
            $fields = $currentFields instanceof Closure ? $currentFields() : $currentFields;
            array_set($fields, 'node.type', $type);
            return $fields;
        };
        array_set($this->config, 'fields', $fieldsResolver);

        return $this;
    }

    public function getEdgeType()
    {
        return array_get($this->getField('node')->config, 'type');
    }
}
