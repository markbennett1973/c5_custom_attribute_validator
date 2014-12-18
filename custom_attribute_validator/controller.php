<?php
defined('C5_EXECUTE') or die("Access Denied.");

/**
 * A quite nasty hack of a class to make page type attributes required in Composer.
 * When you add this attribute to a page type, the attribute handle MUST match the page type handle.
 *
 * This will currently force entry of data in any custom fields of these types:
 *   text
 *   textarea
 *   select
 *   checkboxes
 *   image_file
 */
class CustomAttributeValidatorAttributeTypeController extends AttributeTypeController  {
  public function form() {
    $attributes = array();
    $keyHandle = $this->getAttributeKey()->getAttributeKeyHandle();
    $ct = Concrete5_Model_CollectionType::getByHandle($keyHandle);

    if ($ct) {
      /** @var CollectionAttributeKey $attribute */
      foreach ($ct->getComposerContentItems() as $attribute) {
        $attributes[] = array(
          'id' => $attribute->getAttributeKeyID(),
          'label' => $attribute->getAttributeKeyName(),
          'type' => $attribute->getAttributeType()->getAttributeTypeHandle(),
        );
      }
    }

    $this->set('customAttributes', $attributes);
  }

  /**
   * All custom attributes must implement the saveForm data function, even if there's nothing to save.
   * @param $data
   */
  public function saveForm($data) {
    return;
  }

  public function deleteKey() {
    return;
  }
}
