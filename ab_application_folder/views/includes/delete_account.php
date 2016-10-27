<div class="modal fade" id="delete-account" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php echo form_open('dashboard/del_account'); ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h2 id="modal-title">Delete Account</h2>
            </div>

            <div class="modal-body">
                <p>We are truly sad to see you go but do understand sometimes things don't work out. <b>Thank you for being a part of Asset Box.</b></p>

                <div class="form-group account-modal">

                    <?php
                    $data = array(
                        'name'        => 'feedback',
                        'class'       => 'feedback',
                        'placeholder' => 'Please tell us why you are leaving and/or any feedback so we make Asset Box better.',
                        'rows'        => '5',
                        'cols'        => '60',
                        'type'        => 'textarea',
                    ); ?>

                    <p><?php echo form_label('Feedback:', 'feedback'); ?>
                    <?php echo form_textarea($data); ?></p>

                </div>
                <div>Please allow up to 24 hours for your subscription to cancel. Thank you.</div>
                <div>If you want to change your subscription, please email support@assetbox.io.</div>
            </div>
            <div class="modal-footer">
                <?php $data = array('name' => 'submit','class' => 'btn btn-danger btn-lg','type' => 'submit','value' => 'Confirm');
                echo form_submit($data); ?>
            </div>

            <?php echo form_close(); ?>

        </div>
    </div>
</div>