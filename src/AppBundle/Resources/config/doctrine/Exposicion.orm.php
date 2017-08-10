<?php

use Doctrine\ORM\Mapping\ClassMetadataInfo;

$metadata->setInheritanceType(ClassMetadataInfo::INHERITANCE_TYPE_NONE);
$metadata->customRepositoryClassName = 'AppBundle\Repository\ExposicionRepository';
$metadata->setChangeTrackingPolicy(ClassMetadataInfo::CHANGETRACKING_DEFERRED_IMPLICIT);
$metadata->mapField(array(
   'fieldName' => 'id',
   'type' => 'integer',
   'id' => true,
   'columnName' => 'id',
  ));
$metadata->mapField(array(
   'columnName' => 'artistaId',
   'fieldName' => 'artistaId',
   'type' => 'integer',
  ));
$metadata->mapField(array(
   'columnName' => 'fecha',
   'fieldName' => 'fecha',
   'type' => 'datetime',
  ));
$metadata->mapField(array(
   'columnName' => 'titulo',
   'fieldName' => 'titulo',
   'type' => 'string',
   'length' => 255,
  ));
$metadata->mapField(array(
   'columnName' => 'lugar',
   'fieldName' => 'lugar',
   'type' => 'string',
   'length' => 255,
  ));
$metadata->mapField(array(
   'columnName' => 'individual',
   'fieldName' => 'individual',
   'type' => 'boolean',
  ));
$metadata->setIdGeneratorType(ClassMetadataInfo::GENERATOR_TYPE_AUTO);