<div class="modal fade" id="confirm-delete-modal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php echo form_open('itemprofile/del_license'); ?>
            <?php

            $otherinfo = array(
                    'serial_num' => $license,
                    'swcode' => $item_number
                );

            echo form_hidden($otherinfo); ?>

            <?php echo form_hidden('swcode', $item_number); ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h2 id="modal-title">Delete License</h2>
            </div>

            <div class="modal-body">
                <p>Confirm the deletion of software license <b><?php echo $license ?></b>?</p>
            </div>
            <div class="modal-footer">

                <?php $data = array('name' => 'submit','class' => 'btn btn-danger btn-lg','type' => 'submit','value' => 'Yes, please delete!');
                echo form_submit($data); ?>
            </div>

            <?php echo form_close(); ?>

        </div>
    </div>
</div>