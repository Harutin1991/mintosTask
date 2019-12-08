</section>
  </div>
  <!-- End: Main -->


  <!-- BEGIN: PAGE SCRIPTS -->

  <!-- jQuery -->
  <script src="<?php echo URL; ?>public/vendor/jquery/jquery-1.11.1.min.js"></script>
  <script src="<?php echo URL; ?>public/vendor/jquery/jquery_ui/jquery-ui.min.js"></script>
  <?php if(!empty($this->js)):?>
    <?php foreach($this->js as $js):?>
	  <script src="<?=$js?>"></script>
   <?php endforeach;?>
  <?php endif;?>
  <script src="<?php echo URL; ?>public/js/custom.js"></script>
  <?php if(!empty($this->script)):?>
    <?php foreach($this->script as $script):?>
	  <script>
		<?=$script?>
	  </script>
   <?php endforeach;?>
  <?php endif;?>
</body>

</html>