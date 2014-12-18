<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

<div id="validator"></div>

<script>

  $(document).ready(function() {
    // Hide the validator form label
    $("#validator").closest('.control-group').hide();

    $('input[type=submit]').click(function() {
      return validateForm($("#validator").closest('form'));
    })
  });

  function validateForm(form) {
    var valid = true,
      error = '';

    <?php echo "var customAttributes = ". json_encode($customAttributes) . ";\n"; ?>

    for(var i = 0; i < customAttributes.length; i++) {
      var elementError = validateElement(customAttributes[i].id, customAttributes[i].type, customAttributes[i].label);
      if (elementError != '') {
        error += elementError + "\n";
        valid = false;
      }
    }

    if (!valid) {
      alert(error);
    }

    return valid;
  }

  function validateElement(id, type, label) {
    var value;
    if (type == 'text' || type == 'textarea') {
      value = $('#akID\\[' + id + '\\]\\[value\\]').val();
      if (value == '') {
        return 'Please enter a value for ' + label;
      }
      else {
        return '';
      }
    }

    if (type == 'image_file') {
      value = $('#ccm-file-akID-' + id + '-fm-value').val();
      if (value == 0) {
        return 'Please choose a file for ' + label;
      }
      else {
        return '';
      }
    }

    if (type == 'select') {
      // We need to distinguish between single select (drop-down) and multiple select (checkboxes).
      value = $('#akID\\[' + id + '\\]\\[atSelectOptionID\\]1').val();
      if (value != undefined) {
        if (value == 0) {
          return 'Please select a value for ' + label;
        }
        else {
          return '';
        }
      }
      else {
        // It's a checkbox array
        value = $("input[name='akID[" + id + "][atSelectOptionID][]']:checked").length;
        if (value == 0) {
          return 'Please choose at least one option for ' + label;
        }
        else {
          return '';
        }
      }
    }

    // If it's not one of our valid element types, assume it's OK
    return '';
  }
</script>