<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=checkout_success.<br />
 * Displays confirmation details after order has been successfully processed.
 *
 * @package templateSystem
 * @copyright Copyright 2003-2010 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_checkout_success_default.php 16435 2010-05-28 09:34:32Z drbyte $
 */
?>
<div class="centerColumn" id="checkoutSuccess">
<!--bof -gift certificate- send or spend box-->
<?php
// only show when there is a GV balance
  if ($customer_has_gv_balance ) {
?>
<div id="sendSpendWrapper">
<?php require($template->get_template_dir('tpl_modules_send_or_spend.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_send_or_spend.php'); ?>
</div>
<?php
  }
?>
<!--eof -gift certificate- send or spend box-->

<h1 id="checkoutSuccessHeading"><?php echo HEADING_TITLE; ?></h1>
<div id="checkoutSuccessOrderNumber"><?php echo TEXT_YOUR_ORDER_NUMBER . $zv_orders_id; ?></div>
<?php if (DEFINE_CHECKOUT_SUCCESS_STATUS >= 1 and DEFINE_CHECKOUT_SUCCESS_STATUS <= 2) { ?>
<div id="checkoutSuccessMainContent" class="content">
<?php
/**
 * require the html_defined text for checkout success
 */
  require($define_page);
?>
</div>
<?php } ?>
<!-- bof payment-method-alerts -->
<?php
if (isset($_SESSION['payment_method_messages']) && $_SESSION['payment_method_messages'] != '') {
?>
  <div class="content">
  <?php echo $_SESSION['payment_method_messages']; ?>
  </div>
<?php
}
?>
<!-- eof payment-method-alerts -->
<!--bof logoff-->
<div id="checkoutSuccessLogoff">
<?php
  if (isset($_SESSION['customer_guest_id'])) {
    echo TEXT_CHECKOUT_LOGOFF_GUEST;
  } elseif (isset($_SESSION['customer_id'])) {
    echo TEXT_CHECKOUT_LOGOFF_CUSTOMER;
  }
?>
<div class="buttonRow forward"><a href="<?php echo zen_href_link(FILENAME_LOGOFF, '', 'SSL'); ?>"><?php echo zen_image_button(BUTTON_IMAGE_LOG_OFF , BUTTON_LOG_OFF_ALT); ?></a></div>
</div>
<!--eof logoff-->
<br class="clearBoth" />
<!--bof -product notifications box-->
<?php
/**
 * The following creates a list of checkboxes for the customer to select if they wish to be included in product-notification
 * announcements related to products they've just purchased.
 **/
    if ($flag_show_products_notification == true) {
?>
<fieldset id="csNotifications">
<legend><?php echo TEXT_NOTIFY_PRODUCTS; ?></legend>
<?php echo zen_draw_form('order', zen_href_link(FILENAME_CHECKOUT_SUCCESS, 'action=update', 'SSL')); ?>

<?php foreach ($notificationsArray as $notifications) { ?>
<?php echo zen_draw_checkbox_field('notify[]', $notifications['products_id'], true, 'id="notify-' . $notifications['counter'] . '"') ;?>
<label class="checkboxLabel" for="<?php echo 'notify-' . $notifications['counter']; ?>"><?php echo $notifications['products_name']; ?></label>
<br />
<?php } ?>
<div class="buttonRow forward"><?php echo zen_image_submit(BUTTON_IMAGE_UPDATE, BUTTON_UPDATE_ALT); ?></div>
</form>
</fieldset>
<?php
    }
?>
<!--eof -product notifications box-->
<br class="clearBoth" />
<!--Begin Share Your Purchase-->

<!--Social script-->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
<!--Social script-->

<h3>Share Your Purchase</h3>
<br class="clearBoth" />
<ul class="tabs">
	<li><a class="active" href="<?php echo zen_href_link(FILENAME_CHECKOUT_SUCCESS); ?>#facebook">Facebook</a></li>
	<li><a href="<?php echo zen_href_link(FILENAME_CHECKOUT_SUCCESS); ?>#twitter">Twitter</a></li>
	<li><a href="<?php echo zen_href_link(FILENAME_CHECKOUT_SUCCESS); ?>#gplus">Google+</a></li>
</ul>
<ul class="tabs-content">
	<li id="facebook" class="active">
		<?php foreach ($notificationsArray as $notifications) { ?>
			<div class="share-img back">
				<?php echo zen_image($notifications['products_image'], $notifications['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT); ?>
			</div>
			<div class="share-products-name back"><h3><?php echo $notifications['products_name']; ?></h3></div>
			<div class="fb-like forward" data-send="false" data-href="<?php echo zen_href_link(zen_get_info_page($notifications['products_id']), '&products_id='.$notifications['products_id']); ?>" data-layout="button_count" data-width="200" data-show-faces="true" data-action="recommend" data-font="verdana"></div>
			<br class="clearBoth" />
		<?php } ?>
	</li>
	<li id="twitter">
		<?php foreach ($notificationsArray as $notifications) { ?>
			<div class="share-img back">
				<?php echo zen_image($notifications['products_image'], $notifications['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT); ?>
			</div>
			<div class="share-products-name back"><h3><?php echo $notifications['products_name']; ?></h3></div>
			<a href="https://twitter.com/share" class="twitter-share-button forward" data-url="<?php echo zen_href_link(zen_get_info_page($notifications['products_id']), '&products_id='.$notifications['products_id']); ?>" data-text="I just bought <?php echo $notifications['products_name']; ?> from <?php echo STORE_NAME; ?>. <?php echo zen_href_link(zen_get_info_page($notifications['products_id']), '&products_id='.$notifications['products_id']); ?>" data-count="none">Tweet</a>
			<br class="clearBoth" />
		<?php } ?>
	</li>
	<li id="gplus">
		<?php foreach ($notificationsArray as $notifications) { ?>
			<div class="share-img back">
				<?php echo zen_image($notifications['products_image'], $notifications['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT); ?>
			</div>
			<div class="share-products-name back"><h3><?php echo $notifications['products_name']; ?></h3></div>
			<div class="googleplus forward"><g:plusone size="medium" annotation="none" href="<?php echo zen_href_link(zen_get_info_page($notifications['products_id']), '&products_id='.$notifications['products_id']); ?>"></g:plusone></div>
			<br class="clearBoth" />
		<?php } ?>
	</li>
</ul>

<br class="clearBoth" />
<br class="clearBoth" />
<!--End Share Your Purchase-->

<!--bof -product downloads module-->
<?php
  if (DOWNLOAD_ENABLED == 'true') require($template->get_template_dir('tpl_modules_downloads.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_downloads.php');
?>
<!--eof -product downloads module-->

<div id="checkoutSuccessOrderLink"><?php echo TEXT_SEE_ORDERS;?></div>

<div id="checkoutSuccessContactLink"><?php echo TEXT_CONTACT_STORE_OWNER;?></div>

<h3 id="checkoutSuccessThanks" class="centeredContent"><?php echo TEXT_THANKS_FOR_SHOPPING; ?></h3>
</div>