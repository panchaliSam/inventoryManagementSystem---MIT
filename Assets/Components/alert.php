<!-- Alert Component -->

<div class='alert-content'>
    <div class="<?php echo $alertClass; ?> alert-white rounded">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <div class="icon"><i class="<?php echo $iconClass; ?>"></i></div>
        <strong><?php echo $alertTitle; ?></strong> <?php echo $alertMessage; ?>
    </div>
</div>