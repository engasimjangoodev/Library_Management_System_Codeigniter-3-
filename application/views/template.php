<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php $this->load->view('layouts/header_tags'); ?>
<body>
<div class="wrapper">
	<?php $this->load->view('layouts/side_bar'); ?>

	<!-- Page Content  -->
	<div id="content">
		<?php $this->load->view('layouts/top_nav'); ?>
		<div id="container" class="container-fluid">
			<?= isset($content) ? $content : $content = "" ?>
		</div>

	</div>
</div>
</body>
<?php $this->load->view("layouts/footer"); ?>

</html>


