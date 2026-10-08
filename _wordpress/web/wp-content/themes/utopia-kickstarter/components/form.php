<?php
/**
 * Form
 * A complete contact form demonstrating all form component compositions.
 * Adapt field structure and IDs to suit your specific form requirements.
 *
 * No parameters — fields are hardcoded. Replace with your own components as needed.
 *
 * ks_component( 'form' );
 */
?>
<form class="u-form" novalidate>

  <?php
  ks_component( 'text-input', [
    'label_text' => 'Full name',
    'input_type' => 'text',
    'id'         => 'full-name',
  ] );

  ks_component( 'text-input', [
    'label_text' => 'Email address',
    'input_type' => 'email',
    'id'         => 'email',
  ] );

  ks_component( 'text-input', [
    'label_text' => 'Phone number',
    'input_type' => 'tel',
    'hint_text'  => 'Optional',
    'id'         => 'phone',
  ] );

  ks_component( 'select', [
    'label_text' => 'Country',
    'id'         => 'country',
    'items'      => [
      [ 'value' => '', 'label' => 'Select a country…' ],
      [ 'value' => 'gb', 'label' => 'United Kingdom' ],
      [ 'value' => 'us', 'label' => 'United States' ],
      [ 'value' => 'ca', 'label' => 'Canada' ],
      [ 'value' => 'au', 'label' => 'Australia' ],
      [ 'value' => 'de', 'label' => 'Germany' ],
    ],
  ] );

  ks_component( 'field-group', [
    'legend_text' => 'Preferred contact method',
    'options'     => [
      [ 'radio', [ 'value' => 'contact-email', 'label' => 'Email', 'name' => 'contact-method' ] ],
      [ 'radio', [ 'value' => 'contact-phone', 'label' => 'Phone', 'name' => 'contact-method' ] ],
      [ 'radio', [ 'value' => 'contact-post', 'label' => 'Post', 'name' => 'contact-method' ] ],
    ],
  ] );

  ks_component( 'select', [
    'label_text' => 'Category',
    'id'         => 'category',
    'items'      => [
      [ 'value' => '', 'label' => 'Select a category…' ],
      [ 'value' => 'general', 'label' => 'General enquiry' ],
      [ 'value' => 'support', 'label' => 'Technical support' ],
      [ 'value' => 'billing', 'label' => 'Billing' ],
      [ 'value' => 'feedback', 'label' => 'Feedback' ],
    ],
  ] );

  ks_component( 'text-input', [
    'label_text' => 'Subject',
    'input_type' => 'text',
    'id'         => 'subject',
  ] );

  ks_component( 'textarea', [
    'label_text' => 'Message',
    'hint_text'  => 'Maximum 500 characters',
    'id'         => 'message',
  ] );

  ks_component( 'field-group', [
    'legend_text' => 'Consent',
    'options'     => [
      [ 'checkbox', [ 'value' => 'consent-terms', 'label' => 'I agree to the terms and conditions' ] ],
      [ 'checkbox', [ 'value' => 'consent-marketing', 'label' => 'Send me occasional product updates and news' ] ],
    ],
  ] );
  ?>

  <div class="u-form__actions">
    <?php
    ks_component( 'button', [ 'label' => 'Submit', 'variant' => 'primary', 'size' => 'large', 'type' => 'submit' ] );
    ks_component( 'button', [ 'label' => 'Cancel', 'variant' => 'primary', 'ghost' => true, 'size' => 'large' ] );
    ?>
  </div>

</form>
