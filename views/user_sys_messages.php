<?php if (!empty($_SESSION["user"]["userMessages"])) { ?>
<div class="user-messages">
	<?php foreach ($_SESSION["user"]["userMessages"] as $key => $msg) { ?>
		<p><?php echo $msg; ?></p>
		<?php unset($_SESSION["user"]["userMessages"][$key]); ?>
	<?php } ?>
</div>
<?php } ?>