<div class="modal fade" id="confirm-delete" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php echo form_open('itemprofile/del_mobile'); ?>
            <?php echo form_hidden('serial_num', $item_number); ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h2 id="modal-title">Delete Mobile Asset</h2>
            </div>

            <div class="modal-body">
                <p>Confirm the deletion of mobile with serial <b><?php echo $item_number ?></b>?</p>
            </div>
            <div class="modal-footer">

                <?php $data = array('name' => 'submit','class' => 'btn btn-danger btn-lg','type' => 'submit','value' => 'Yes, please delete!');
                echo form_submit($data); ?>
            </div>

            <?php echo form_close(); ?>

        </div>
    </div>
</div>