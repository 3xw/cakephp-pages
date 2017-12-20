<?php

namespace Trois\Pages\Model\Traits;

use Cake\Datasource\EntityInterface;

trait CustomTranslateTrait
{

  public function patchEntity(EntityInterface $entity, array $data, array $options = [])
  {
    if (!isset($options['associated']))
    {
        $options['associated'] = $this->_associations->keys();
    }
    $marshaller = $this->marshaller();
    $entity = $marshaller->merge($entity, $data, $options);

    if(!empty($entity['_translations']))
    {
      foreach ($entity['_translations'] as $locale => $fields)
      {

        foreach($fields as $key => $value)
        {

          if(!empty($value)){
            $entity->translation($locale)->set([$key => $value], ['guard' => false]);
          }else{
            $entity->translation($locale)->set([$key => $entity[$key]], ['guard' => false]);
          }

        }
        unset($data['_translations'][$locale]);
      }
    }

    return $entity;
  }

}
