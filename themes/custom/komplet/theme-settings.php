<?php
use Drupal\Component\Utility\Html;
use Drupal\Core\Form\FormStateInterface;
use Drupal\system\Form\ThemeSettingsForm;
use Drupal\file\Entity\File;
use Drupal\Core\Url;

function komplet_form_system_theme_settings_alter(&$form, \Drupal\Core\Form\FormStateInterface &$form_state) {
  //header  
  $form['settings'] = array(
    '#type' => 'details',
    '#title' => t('Theme settings'),
    '#open' => TRUE,
  );

  $form['settings']['header'] = array(
    '#type' => 'details',
    '#title' => t('Header settings'),
    '#open' => FALSE,
  );

  $form['settings']['header']['header_style'] = array(
    '#type' => 'select',
    '#options' => array(
      'style1' => t('Style 1 (Default)'),
      'style2' => t('Style 2'),
      'style3' => t('Style 3'),
      'style4' => t('Style 4'),
      'style5' => t('Style 5'),
      'style6' => t('Style 6'),
    ),
    '#required' => FALSE,
    '#title' => t('Header style'),
    '#default_value' => theme_get_setting('header_style', 'komplet'),
  );
  $form['settings']['header']['logo_image'] = array(
    '#type' => 'details',
    '#title' => t('Logo'),
    '#default_value' => theme_get_setting('logo_image', 'komplet'),
  );
  $form['settings']['header']['logo_image']['logo_image_header_bg'] = array(
    '#type' => 'textfield',
    '#title' => t('URL of the logo image'),
    '#default_value' => theme_get_setting('logo_image_header_bg'),
    '#description' => t('Enter a URL logo image.'),
    '#size' => 40,
    '#maxlength' => 512,
    '#attributes' => array('disabled' => 'disabled'),
  );
  $form['settings']['header']['logo_image']['logo_image_header_bg_upload'] = array(
    '#type' => 'file',
    '#title' => t('Upload logo image'),
    '#size' => 40,
    '#attributes' => array('enctype' => 'multipart/form-data'),
    '#description' => t('If you don\'t jave direct access to the server, use this field to upload your background image. Uploads limited to .png .gif .jpg .jpeg .apng .svg extensions'),
    '#element_validate' => array('logo_image_header_bg_validate')

  );
  $form['settings']['header']['header_social_networks'] = array(
    '#type' => 'textarea',
    '#title' => t('Social networks'),
    '#default_value' => theme_get_setting('header_social_networks', 'komplet'),
  );
  $form['settings']['header']['header_phone_contact'] = array(
    '#type' => 'textfield',
    '#title' => t('Phone contact'),
    '#default_value' => theme_get_setting('header_phone_contact', 'komplet'),
  );
  $form['settings']['header']['header_email_contact'] = array(
    '#type' => 'textfield',
    '#title' => t('Email contact'),
    '#default_value' => theme_get_setting('header_email_contact', 'komplet'),
  );
  //print_r($form['settings']['header']['second_logo']);
  $form['settings']['general_setting'] = array(
    '#type' => 'details',
    '#title' => t('General Settings'),
    '#open' => FALSE,
  );

  $form['settings']['general_setting']['general_setting_tracking_code'] = array(
    '#type' => 'textarea',
    '#title' => t('Tracking Code'),
    '#default_value' => theme_get_setting('general_setting_tracking_code', 'komplet'),
  );

  // Blog settings
  $form['settings']['blog'] = array(
    '#type' => 'details',
    '#title' => t('Blog settings'),
    '#open' => FALSE,
  );
  $form['settings']['blog']['blog_listing'] = array(
    '#type' => 'details',
    '#title' => t('Blog listing'),
    '#open' => FALSE,
  );
  $form['settings']['blog']['blog_listing']['blog_layout'] = array(
    '#type' => 'select',
    '#title' => t('Default layout'),
    '#options' => array(
      'grid_2_column' => t('Grid 2 columns'),
      'grid_3_column' => t('Grid 3 columns'),
      'traditional' => t('Traditional')
    ),
    '#default_value' => theme_get_setting('blog_layout', 'komplet'),
  );
  $form['settings']['blog']['blog_listing']['blog_sidebar'] = array(
    '#type' => 'select',
    '#title' => t('Default sidebar'),
    '#options' => array(
      'none' => t('None'),
      'left' => t('Left'),
      'right' => t('Right'),
    ),
    '#default_value' => theme_get_setting('blog_sidebar', 'komplet'),
  );
  $form['settings']['blog']['blog_listing']['bg_wp'] = array(
    '#type' => 'details',
    '#title' => t('Header background'),
    '#open' => FALSE,
  );
  $form['settings']['blog']['blog_listing']['bg_wp']['blog_page_header_bg'] = array(
    '#type' => 'textfield',
    '#title' => t('URL of the header background image'),
    '#default_value' => theme_get_setting('blog_page_header_bg'),
    '#description' => t('Enter a URL background image.'),
    '#size' => 40,
    '#maxlength' => 512,
    '#attributes' => array('disabled' => 'disabled'),
  );
  $form['settings']['blog']['blog_listing']['bg_wp']['blog_page_header_bg_upload'] = array(
    '#type' => 'file',
    '#title' => t('Upload header background image'),
    '#size' => 40,
    '#attributes' => array('enctype' => 'multipart/form-data'),
    '#description' => t('If you don\'t jave direct access to the server, use this field to upload your background image. Uploads limited to .png .gif .jpg .jpeg .apng .svg extensions'),
    '#element_validate' => array('blog_page_header_bg_validate'),
  );
  $form['settings']['blog']['blog_tags'] = array(
    '#type' => 'details',
    '#title' => t('Blog tags'),
    '#open' => FALSE,
  );
  $form['settings']['blog']['blog_tags']['tag_bg_wp'] = array(
    '#type' => 'details',
    '#title' => t('Header background'),
    '#open' => FALSE,
  );
  $form['settings']['blog']['blog_tags']['tag_bg_wp']['blog_tags_page_header_bg'] = array(
    '#type' => 'textfield',
    '#title' => t('URL of the header background image'),
    '#default_value' => theme_get_setting('blog_tags_page_header_bg'),
    '#description' => t('Enter a URL background image.'),
    '#size' => 40,
    '#maxlength' => 512,
    '#attributes' => array('disabled' => 'disabled'),
  );
  $form['settings']['blog']['blog_tags']['tag_bg_wp']['blog_tags_page_header_bg_upload'] = array(
    '#type' => 'file',
    '#title' => t('Upload header background image'),
    '#size' => 40,
    '#attributes' => array('enctype' => 'multipart/form-data'),
    '#description' => t('If you don\'t jave direct access to the server, use this field to upload your background image. Uploads limited to .png .gif .jpg .jpeg .apng .svg extensions'),
    '#element_validate' => array('blog_tags_page_header_bg_validate'),
  );
  //shop
  $form['settings']['shop'] = array(
    '#type' => 'details',
    '#title' => t('Shop settings'),
    '#open' => FALSE,
  );
  //cart
  $form['settings']['shop']['shop_cart'] = array(
    '#type' => 'details',
    '#title' => t('Cart page'),
    '#open' => FALSE,
  );
  $form['settings']['shop']['shop_cart']['cart_page_header_bg'] = array(
    '#type' => 'textfield',
    '#title' => t('URL of the header background image'),
    '#default_value' => theme_get_setting('cart_page_header_bg'),
    '#description' => t('Enter a URL background image.'),
    '#size' => 40,
    '#maxlength' => 512,
    '#attributes' => array('disabled' => 'disabled'),
  );
  $form['settings']['shop']['shop_cart']['cart_page_header_bg_upload'] = array(
    '#type' => 'file',
    '#title' => t('Upload header background image'),
    '#size' => 40,
    '#attributes' => array('enctype' => 'multipart/form-data'),
    '#description' => t('If you don\'t jave direct access to the server, use this field to upload your background image. Uploads limited to .png .gif .jpg .jpeg .apng .svg extensions'),
    '#element_validate' => array('cart_page_header_bg_validate'),
  );
  //checkout
  $form['settings']['shop']['shop_checkout'] = array(
    '#type' => 'details',
    '#title' => t('Checkout page'),
    '#open' => FALSE,
  );
  $form['settings']['shop']['shop_checkout']['checkout_page_header_bg'] = array(
    '#type' => 'textfield',
    '#title' => t('URL of the header background image'),
    '#default_value' => theme_get_setting('checkout_page_header_bg'),
    '#description' => t('Enter a URL background image.'),
    '#size' => 40,
    '#maxlength' => 512,
    '#attributes' => array('disabled' => 'disabled'),
  );
  $form['settings']['shop']['shop_checkout']['checkout_page_header_bg_upload'] = array(
    '#type' => 'file',
    '#title' => t('Upload header background image'),
    '#size' => 40,
    '#attributes' => array('enctype' => 'multipart/form-data'),
    '#description' => t('If you don\'t jave direct access to the server, use this field to upload your background image. Uploads limited to .png .gif .jpg .jpeg .apng .svg extensions'),
    '#element_validate' => array('checkout_page_header_bg_validate'),
  );
  //review order
  $form['settings']['shop']['shop_review'] = array(
    '#type' => 'details',
    '#title' => t('Review order page'),
    '#open' => FALSE,
  );
  $form['settings']['shop']['shop_review']['review_page_header_bg'] = array(
    '#type' => 'textfield',
    '#title' => t('URL of the header background image'),
    '#default_value' => theme_get_setting('review_page_header_bg'),
    '#description' => t('Enter a URL background image.'),
    '#size' => 40,
    '#maxlength' => 512,
    '#attributes' => array('disabled' => 'disabled'),
  );
  $form['settings']['shop']['shop_review']['review_page_header_bg_upload'] = array(
    '#type' => 'file',
    '#title' => t('Upload header background image'),
    '#size' => 40,
    '#attributes' => array('enctype' => 'multipart/form-data'),
    '#description' => t('If you don\'t jave direct access to the server, use this field to upload your background image. Uploads limited to .png .gif .jpg .jpeg .apng .svg extensions'),
    '#element_validate' => array('review_page_header_bg_validate'),
  );
  //complete
  $form['settings']['shop']['shop_complete'] = array(
    '#type' => 'details',
    '#title' => t('Complete order page'),
    '#open' => FALSE,
  );
  $form['settings']['shop']['shop_complete']['complete_page_header_bg'] = array(
    '#type' => 'textfield',
    '#title' => t('URL of the header background image'),
    '#default_value' => theme_get_setting('complete_page_header_bg'),
    '#description' => t('Enter a URL background image.'),
    '#size' => 40,
    '#maxlength' => 512,
    '#attributes' => array('disabled' => 'disabled'),
  );
  $form['settings']['shop']['shop_complete']['complete_page_header_bg_upload'] = array(
    '#type' => 'file',
    '#title' => t('Upload header background image'),
    '#size' => 40,
    '#attributes' => array('enctype' => 'multipart/form-data'),
    '#description' => t('If you don\'t jave direct access to the server, use this field to upload your background image. Uploads limited to .png .gif .jpg .jpeg .apng .svg extensions'),
    '#element_validate' => array('complete_page_header_bg_validate'),
  );
  //page contact
  $form['settings']['contact_page'] = array(
    '#type' => 'details',
    '#title' => t('Contact page'),
    '#open' => FALSE,
  );
  $form['settings']['contact_page']['contact_style'] = array(
    '#type' => 'select',
    '#options' => array(
      'style1' => t('Style 1 (Default)'),
      'style2' => t('Style 2'),
    ),
    '#required' => FALSE,
    '#title' => t('Contact style'),
    '#default_value' => theme_get_setting('contact_style', 'komplet'),
  );
  $form['settings']['contact_page']['contact_content'] = array(
    '#type' => 'textarea',
    '#title' => t('Body'),
    '#default_value' => theme_get_setting('contact_content', 'komplet'),
  );
  $form['settings']['contact_page']['contact_page_header_bg'] = array(
    '#type' => 'textfield',
    '#title' => t('URL of the header background image'),
    '#default_value' => theme_get_setting('contact_page_header_bg'),
    '#description' => t('Enter a URL background image.'),
    '#size' => 40,
    '#maxlength' => 512,
    '#attributes' => array('disabled' => 'disabled'),
  );
  $form['settings']['contact_page']['contact_page_header_bg_upload'] = array(
    '#type' => 'file',
    '#title' => t('Upload header background image'),
    '#size' => 40,
    '#attributes' => array('enctype' => 'multipart/form-data'),
    '#description' => t('If you don\'t jave direct access to the server, use this field to upload your background image. Uploads limited to .png .gif .jpg .jpeg .apng .svg extensions'),
    '#element_validate' => array('contact_page_header_bg_validate'),
  );
  //other page
  $form['settings']['other_page'] = array(
    '#type' => 'details',
    '#title' => t('Other pages'),
    '#open' => FALSE,
  );
  $form['settings']['other_page']['other_page_header_bg'] = array(
    '#type' => 'textfield',
    '#title' => t('URL of the header background image'),
    '#default_value' => theme_get_setting('other_page_header_bg'),
    '#description' => t('Enter a URL background image.'),
    '#size' => 40,
    '#maxlength' => 512,
    '#attributes' => array('disabled' => 'disabled'),
  );
  $form['settings']['other_page']['other_page_header_bg_upload'] = array(
    '#type' => 'file',
    '#title' => t('Upload header background image'),
    '#size' => 40,
    '#attributes' => array('enctype' => 'multipart/form-data'),
    '#description' => t('If you don\'t jave direct access to the server, use this field to upload your background image. Uploads limited to .png .gif .jpg .jpeg .apng .svg extensions'),
    '#element_validate' => array('other_page_header_bg_validate'),
  );
  // custom css
  $form['settings']['custom_css'] = array(
    '#type' => 'details',
    '#title' => t('Custom CSS'),
    '#open' => FALSE,
  );


  $form['settings']['custom_css']['custom_css'] = array(
    '#type' => 'textarea',
    '#title' => t('Custom CSS'),
    '#default_value' => theme_get_setting('custom_css', 'komplet'),
    '#description' => t('<strong>Example:</strong><br/>h1 { font-family: \'Metrophobic\', Arial, serif; font-weight: 400; }')
  );
  //footer settings
  $form['settings']['footer'] = array(
    '#type' => 'details',
    '#title' => t('Footer settings'),
    '#open' => FALSE,
  );
  $form['settings']['footer']['footer_style'] = array(
    '#type' => 'select',
    '#options' => array(
      'style1' => t('Style 1 (Default)'),
      'style2' => t('Style 2'),
      'style3' => t('Style 3'),
      'style4' => t('Style 4'),
      'style5' => t('Style 5'),
      'style6' => t('Style 6'),
    ),
    '#required' => FALSE,
    '#title' => t('Footer style'),
    '#default_value' => theme_get_setting('footer_style', 'komplet'),
  );
  $form['settings']['footer']['footer_image'] = array(
    '#type' => 'details',
    '#title' => t('Footer image style 2'),
    '#open' => FALSE,
  );
  $form['settings']['footer']['footer_image']['footer_image_bg'] = array(
    '#type' => 'textfield',
    '#title' => t('URL of the footer background image'),
    '#default_value' => theme_get_setting('footer_image_bg'),
    '#description' => t('Enter a URL footer background image.'),
    '#size' => 40,
    '#maxlength' => 512,
    '#attributes' => array('disabled' => 'disabled'),
  );
  $form['settings']['footer']['footer_image']['footer_image_bg_upload'] = array(
    '#type' => 'file',
    '#title' => t('Upload footer background image'),
    '#size' => 40,
    '#attributes' => array('enctype' => 'multipart/form-data'),
    '#description' => t('If you don\'t jave direct access to the server, use this field to upload your background image. Uploads limited to .png .gif .jpg .jpeg .apng .svg extensions'),
    '#element_validate' => array('footer_image_bg_validate')
  );
  $form['settings']['footer']['footer_image_2'] = array(
    '#type' => 'details',
    '#title' => t('Footer image style 3'),
    '#open' => FALSE,
  );
  $form['settings']['footer']['footer_image_2']['footer_image_bg_2'] = array(
    '#type' => 'textfield',
    '#title' => t('URL of the footer background image'),
    '#default_value' => theme_get_setting('footer_image_bg_2'),
    '#description' => t('Enter a URL footer background image.'),
    '#size' => 40,
    '#maxlength' => 512,
    '#attributes' => array('disabled' => 'disabled'),
  );
  $form['settings']['footer']['footer_image_2']['footer_image_bg_2_upload'] = array(
    '#type' => 'file',
    '#title' => t('Upload footer background image'),
    '#size' => 40,
    '#attributes' => array('enctype' => 'multipart/form-data'),
    '#description' => t('If you don\'t jave direct access to the server, use this field to upload your background image. Uploads limited to .png .gif .jpg .jpeg .apng .svg extensions'),
    '#element_validate' => array('footer_image_bg_2_validate')
  );
  $form['settings']['footer']['copyright_text'] = array(
    '#type' => 'textarea',
    '#title' => t('Copyright text'),
    '#default_value' => theme_get_setting('copyright_text', 'komplet'),
  );
  //page setting     
  $form['settings']['page'] = array(
    '#type' => 'details',
    '#title' => t('page settings'),
    '#open' => FALSE,
  );
  $form['settings']['page']['page_image_header_bg'] = array(
    '#type' => 'textfield',
    '#title' => t('URL of the header background image'),
    '#default_value' => theme_get_setting('page_image_header_bg'),
    '#description' => t('Enter a URL background image.'),
    '#size' => 40,
    '#maxlength' => 512,
    '#attributes' => array('disabled' => 'disabled'),

  );
  $form['settings']['page']['page_image_header_bg_upload'] = array(
    '#type' => 'file',
    '#title' => t('Upload header background image'),
    '#size' => 40,
    '#attributes' => array('enctype' => 'multipart/form-data'),
    '#description' => t('If you don\'t jave direct access to the server, use this field to upload your background image. Uploads limited to .png .gif .jpg .jpeg .apng .svg extensions'),
    '#element_validate' => array('page_image_header_bg_validate')
  );
}

function page_image_header_bg_validate($element, FormStateInterface $form_state) {
  global $base_url;

  $validators = array('file_validate_extensions' => array('png gif jpg jpeg apng svg'));
  $file = file_save_upload('page_image_header_bg_upload', $validators, "public://page_image", NULL, FILE_EXISTS_REPLACE);

  if (!empty($file)) {
    // change file's status from temporary to permanent and update file database
    if ((is_object($file[0]) == 1)) {
      $file[0]->status = FILE_STATUS_PERMANENT;
      $file[0]->save();
      $uri = $file[0]->getFileUri();
      $file_url = file_create_url($uri);
      $file_url = str_ireplace($base_url, '', $file_url);
      $form_state->setValue('page_image_header_bg', $file_url);
    }
  }
}

function blog_page_header_bg_validate($element, FormStateInterface $form_state) {
  global $base_url;

  $validators = array('file_validate_extensions' => array('png gif jpg jpeg apng svg'));
  $file = file_save_upload('blog_page_header_bg_upload', $validators, "public://blog_listing", NULL, FILE_EXISTS_REPLACE);

  if (!empty($file)) {
    // change file's status from temporary to permanent and update file database
    if ((is_object($file[0]) == 1)) {
      $file[0]->status = FILE_STATUS_PERMANENT;
      $file[0]->save();
      $uri = $file[0]->getFileUri();
      $file_url = file_create_url($uri);
      $file_url = str_ireplace($base_url, '', $file_url);
      $form_state->setValue('blog_page_header_bg', $file_url);
    }
  }
}

function blog_tags_page_header_bg_validate($element, FormStateInterface $form_state) {
  global $base_url;

  $validators = array('file_validate_extensions' => array('png gif jpg jpeg apng svg'));
  $file = file_save_upload('blog_tags_page_header_bg_upload', $validators, "public://blog_tags", NULL, FILE_EXISTS_REPLACE);

  if (!empty($file)) {
    // change file's status from temporary to permanent and update file database
    if ((is_object($file[0]) == 1)) {
      $file[0]->status = FILE_STATUS_PERMANENT;
      $file[0]->save();
      $uri = $file[0]->getFileUri();
      $file_url = file_create_url($uri);
      $file_url = str_ireplace($base_url, '', $file_url);
      $form_state->setValue('blog_tags_page_header_bg', $file_url);
    }
  }
}

function product_tags_page_header_bg_validate($element, FormStateInterface $form_state) {
  global $base_url;

  $validators = array('file_validate_extensions' => array('png gif jpg jpeg apng svg'));
  $file = file_save_upload('product_tags_page_header_bg_upload', $validators, "public://product_tags", NULL, FILE_EXISTS_REPLACE);

  if (!empty($file)) {
    // change file's status from temporary to permanent and update file database
    if ((is_object($file[0]) == 1)) {
      $file[0]->status = FILE_STATUS_PERMANENT;
      $file[0]->save();
      $uri = $file[0]->getFileUri();
      $file_url = file_create_url($uri);
      $file_url = str_ireplace($base_url, '', $file_url);
      $form_state->setValue('product_tags_page_header_bg', $file_url);
    }
  }
}

function shop_page_header_bg_validate($element, FormStateInterface $form_state) {
  global $base_url;

  $validators = array('file_validate_extensions' => array('png gif jpg jpeg apng svg'));
  $file = file_save_upload('shop_page_header_bg_upload', $validators, "public://shop_listing", NULL, FILE_EXISTS_REPLACE);

  if (!empty($file)) {
    // change file's status from temporary to permanent and update file database
    if ((is_object($file[0]) == 1)) {
      $file[0]->status = FILE_STATUS_PERMANENT;
      $file[0]->save();
      $uri = $file[0]->getFileUri();
      $file_url = file_create_url($uri);
      $file_url = str_ireplace($base_url, '', $file_url);
      $form_state->setValue('shop_page_header_bg', $file_url);
    }
  }
}

function cart_page_header_bg_validate($element, FormStateInterface $form_state) {
  global $base_url;

  $validators = array('file_validate_extensions' => array('png gif jpg jpeg apng svg'));
  $file = file_save_upload('cart_page_header_bg_upload', $validators, "public://cart_page", NULL, FILE_EXISTS_REPLACE);

  if (!empty($file)) {
    // change file's status from temporary to permanent and update file database
    if ((is_object($file[0]) == 1)) {
      $file[0]->status = FILE_STATUS_PERMANENT;
      $file[0]->save();
      $uri = $file[0]->getFileUri();
      $file_url = file_create_url($uri);
      $file_url = str_ireplace($base_url, '', $file_url);
      $form_state->setValue('cart_page_header_bg', $file_url);
    }
  }
}

function checkout_page_header_bg_validate($element, FormStateInterface $form_state) {
  global $base_url;

  $validators = array('file_validate_extensions' => array('png gif jpg jpeg apng svg'));
  $file = file_save_upload('checkout_page_header_bg_upload', $validators, "public://checkout_page", NULL, FILE_EXISTS_REPLACE);

  if (!empty($file)) {
    // change file's status from temporary to permanent and update file database
    if ((is_object($file[0]) == 1)) {
      $file[0]->status = FILE_STATUS_PERMANENT;
      $file[0]->save();
      $uri = $file[0]->getFileUri();
      $file_url = file_create_url($uri);
      $file_url = str_ireplace($base_url, '', $file_url);
      $form_state->setValue('checkout_page_header_bg', $file_url);
    }
  }
}

function review_page_header_bg_validate($element, FormStateInterface $form_state) {
  global $base_url;

  $validators = array('file_validate_extensions' => array('png gif jpg jpeg apng svg'));
  $file = file_save_upload('review_page_header_bg_upload', $validators, "public://review_page", NULL, FILE_EXISTS_REPLACE);

  if (!empty($file)) {
    // change file's status from temporary to permanent and update file database
    if ((is_object($file[0]) == 1)) {
      $file[0]->status = FILE_STATUS_PERMANENT;
      $file[0]->save();
      $uri = $file[0]->getFileUri();
      $file_url = file_create_url($uri);
      $file_url = str_ireplace($base_url, '', $file_url);
      $form_state->setValue('review_page_header_bg', $file_url);
    }
  }
}

function complete_page_header_bg_validate($element, FormStateInterface $form_state) {
  global $base_url;

  $validators = array('file_validate_extensions' => array('png gif jpg jpeg apng svg'));
  $file = file_save_upload('complete_page_header_bg_upload', $validators, "public://complete_page", NULL, FILE_EXISTS_REPLACE);

  if (!empty($file)) {
    // change file's status from temporary to permanent and update file database
    if ((is_object($file[0]) == 1)) {
      $file[0]->status = FILE_STATUS_PERMANENT;
      $file[0]->save();
      $uri = $file[0]->getFileUri();
      $file_url = file_create_url($uri);
      $file_url = str_ireplace($base_url, '', $file_url);
      $form_state->setValue('complete_page_header_bg', $file_url);
    }
  }
}

function contact_page_header_bg_validate($element, FormStateInterface $form_state) {
  global $base_url;

  $validators = array('file_validate_extensions' => array('png gif jpg jpeg apng svg'));
  $file = file_save_upload('contact_page_header_bg_upload', $validators, "public://contact_page", NULL, FILE_EXISTS_REPLACE);

  if (!empty($file)) {
    // change file's status from temporary to permanent and update file database
    if ((is_object($file[0]) == 1)) {
      $file[0]->status = FILE_STATUS_PERMANENT;
      $file[0]->save();
      $uri = $file[0]->getFileUri();
      $file_url = file_create_url($uri);
      $file_url = str_ireplace($base_url, '', $file_url);
      $form_state->setValue('contact_page_header_bg', $file_url);
    }
  }
}

function other_page_header_bg_validate($element, FormStateInterface $form_state) {
  global $base_url;

  $validators = array('file_validate_extensions' => array('png gif jpg jpeg apng svg'));
  $file = file_save_upload('other_page_header_bg_upload', $validators, "public://other_page", NULL, FILE_EXISTS_REPLACE);

  if (!empty($file)) {
    // change file's status from temporary to permanent and update file database
    if ((is_object($file[0]) == 1)) {
      $file[0]->status = FILE_STATUS_PERMANENT;
      $file[0]->save();
      $uri = $file[0]->getFileUri();
      $file_url = file_create_url($uri);
      $file_url = str_ireplace($base_url, '', $file_url);
      $form_state->setValue('other_page_header_bg', $file_url);
    }
  }
}

function logo_image_header_bg_validate($element, FormStateInterface $form_state) {
  global $base_url;

  $validators = array('file_validate_extensions' => array('png gif jpg jpeg apng svg'));
  $file = file_save_upload('logo_image_header_bg_upload', $validators, "public://logo_image", NULL, FILE_EXISTS_REPLACE);

  if (!empty($file)) {
    // change file's status from temporary to permanent and update file database
    if ((is_object($file[0]) == 1)) {
      $file[0]->status = FILE_STATUS_PERMANENT;
      $file[0]->save();
      $uri = $file[0]->getFileUri();
      $file_url = file_create_url($uri);
      $file_url = str_ireplace($base_url, '', $file_url);
      $form_state->setValue('logo_image_header_bg', $file_url);
    }
  }
}

function footer_image_bg_validate($element, FormStateInterface $form_state) {
  global $base_url;

  $validators = array('file_validate_extensions' => array('png gif jpg jpeg apng svg'));
  $file = file_save_upload('footer_image_bg_upload', $validators, "public://footer_image", NULL, FILE_EXISTS_REPLACE);

  if (!empty($file)) {
    // change file's status from temporary to permanent and update file database
    if ((is_object($file[0]) == 1)) {
      $file[0]->status = FILE_STATUS_PERMANENT;
      $file[0]->save();
      $uri = $file[0]->getFileUri();
      $file_url = file_create_url($uri);
      $file_url = str_ireplace($base_url, '', $file_url);
      $form_state->setValue('footer_image_bg', $file_url);
    }
  }
}

function footer_image_bg_2_validate($element, FormStateInterface $form_state) {
  global $base_url;

  $validators = array('file_validate_extensions' => array('png gif jpg jpeg apng svg'));
  $file = file_save_upload('footer_image_bg_2_upload', $validators, "public://footer_image_2", NULL, FILE_EXISTS_REPLACE);

  if (!empty($file)) {
    // change file's status from temporary to permanent and update file database
    if ((is_object($file[0]) == 1)) {
      $file[0]->status = FILE_STATUS_PERMANENT;
      $file[0]->save();
      $uri = $file[0]->getFileUri();
      $file_url = file_create_url($uri);
      $file_url = str_ireplace($base_url, '', $file_url);
      $form_state->setValue('footer_image_bg_2', $file_url);
    }
  }
}


/*function tags_page_header_bg_validate($element, FormStateInterface $form_state) {
  global $base_url;

  $validators = array('file_validate_extensions' => array('png gif jpg jpeg apng svg'));
  $file = file_save_upload('tags_page_header_bg_upload', $validators, "public://product_tags_page", NULL, FILE_EXISTS_REPLACE);

  if (!empty($file)) {
    // change file's status from temporary to permanent and update file database
    if ((is_object($file[0]) == 1)) {
      $file[0]->status = FILE_STATUS_PERMANENT;
      $file[0]->save();
      $uri = $file[0]->getFileUri();
      $file_url = file_create_url($uri);
      $file_url = str_ireplace($base_url, '', $file_url);
      $form_state->setValue('tags_page_header_bg', $file_url);
    }
 }
}
function blog_page_header_bg_validate($element, FormStateInterface $form_state){
  global $base_url;

  $validators = array('file_validate_extensions' => array('png gif jpg jpeg apng svg'));
  $file = file_save_upload('blog_page_header_bg_upload', $validators, "public://blog_listing", NULL, FILE_EXISTS_REPLACE);

  if (!empty($file)) {
    // change file's status from temporary to permanent and update file database
    if ((is_object($file[0]) == 1)) {
      $file[0]->status = FILE_STATUS_PERMANENT;
      $file[0]->save();
      $uri = $file[0]->getFileUri();
      $file_url = file_create_url($uri);
      $file_url = str_ireplace($base_url, '', $file_url);
      $form_state->setValue('blog_page_header_bg', $file_url);
    }
 }
}
function other_page_header_bg_validate($element, FormStateInterface $form_state){
  global $base_url;

  $validators = array('file_validate_extensions' => array('png gif jpg jpeg apng svg'));
  $file = file_save_upload('other_page_header_bg_upload', $validators, "public://other_page", NULL, FILE_EXISTS_REPLACE);

  if (!empty($file)) {
    // change file's status from temporary to permanent and update file database
    if ((is_object($file[0]) == 1)) {
      $file[0]->status = FILE_STATUS_PERMANENT;
      $file[0]->save();
      $uri = $file[0]->getFileUri();
      $file_url = file_create_url($uri);
      $file_url = str_ireplace($base_url, '', $file_url);
      $form_state->setValue('other_page_header_bg', $file_url);
    }
 }
}
function contact_page_header_bg_validate($element, FormStateInterface $form_state){
  global $base_url;

  $validators = array('file_validate_extensions' => array('png gif jpg jpeg apng svg'));
  $file = file_save_upload('contact_page_header_bg_upload', $validators, "public://contact_page", NULL, FILE_EXISTS_REPLACE);

  if (!empty($file)) {
    // change file's status from temporary to permanent and update file database
    if ((is_object($file[0]) == 1)) {
      $file[0]->status = FILE_STATUS_PERMANENT;
      $file[0]->save();
      $uri = $file[0]->getFileUri();
      $file_url = file_create_url($uri);
      $file_url = str_ireplace($base_url, '', $file_url);
      $form_state->setValue('contact_page_header_bg', $file_url);
    }
 }
}
function login_page_header_bg_validate($element, FormStateInterface $form_state){
  global $base_url;

  $validators = array('file_validate_extensions' => array('png gif jpg jpeg apng svg'));
  $file = file_save_upload('login_page_header_bg_upload', $validators, "public://login_page", NULL, FILE_EXISTS_REPLACE);

  if (!empty($file)) {
    // change file's status from temporary to permanent and update file database
    if ((is_object($file[0]) == 1)) {
      $file[0]->status = FILE_STATUS_PERMANENT;
      $file[0]->save();
      $uri = $file[0]->getFileUri();
      $file_url = file_create_url($uri);
      $file_url = str_ireplace($base_url, '', $file_url);
      $form_state->setValue('login_page_header_bg', $file_url);
    }
 }
}
function register_page_header_bg_validate($element, FormStateInterface $form_state){
  global $base_url;

  $validators = array('file_validate_extensions' => array('png gif jpg jpeg apng svg'));
  $file = file_save_upload('register_page_header_bg_upload', $validators, "public://register_page", NULL, FILE_EXISTS_REPLACE);

  if (!empty($file)) {
    // change file's status from temporary to permanent and update file database
    if ((is_object($file[0]) == 1)) {
      $file[0]->status = FILE_STATUS_PERMANENT;
      $file[0]->save();
      $uri = $file[0]->getFileUri();
      $file_url = file_create_url($uri);
      $file_url = str_ireplace($base_url, '', $file_url);
      $form_state->setValue('register_page_header_bg', $file_url);
    }
 }
}*/