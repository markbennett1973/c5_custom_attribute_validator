Custom attribute validator for Concrete5
=============================

This code provides a custom attribute which you can add to Concrete5 custom page types to make all custom page attributes mandatory. It was designed for Concrete5.6.3, and due to the extensive API changes in Concrete5.7, it probably won't work on that version.

You can read more about why at http://www.sparrowtail.com/concrete5-mandatory-custom-attributes

Limitations
===========

This code currently makes *all* custom  page attributes of the following types mandatory:
* text
* textarea
* select
* checkboxes
* image_file

Other attribute types are not checked at all. It only works on page attributes - not user attributes or file attributes.

Usage
=====

*  Copy the custom_attribute_validator directory into your Concrete5 site under /models/attribute/types
*  Install the custom attribute type at Dashboard > Settings > Attributes: Types
*  Create a custom attribute for each page type you want to add validation to at Dashboard > Pages & Themes: Attributes
    *  Your custom attribute handle *must* match the handle of the page type you are going to validate - this is how the validator knows what custom attributes to check for
* Add the custom attribute to your page type


Now, when you create or edit pages of that type using Composer, it will check that all your custom attributes of the supported types are populated before you can save the content.
