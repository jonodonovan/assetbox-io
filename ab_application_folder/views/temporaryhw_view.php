<h3>Temp Equipment for <?php if ($this->session->userdata('company_name') == "") { echo $this->session->userdata('email'); } else { echo $this->session->userdata('company_name'); } ?></h3>
<table id="stocktable">
    <thead></thead>
    <tbody>
        <tr id="stocktable_row_head">
            <td class="stock_head"><a href="#">Notebooks</a></td>
        </tr>
        <tr>
        	<td>
                <?php echo form_open('temporaryhw/updatestatus'); ?>
        		<?php $this->table->set_heading('Serial', 'Current Status', 'User', 'Date', 'RACFID', 'Change Action');
				echo $this->table->generate($notebook_query); ?>
                <?php echo form_close(); ?>
				<?php $this->table->clear(); ?>
        	</td>
		</tr>
        <tr id="stocktable_row_head">
            <td class="stock_head"><a href="#">Aircards</a></td>
        </tr>
        <tr>
            <td>
                <?php $this->table->set_heading('Serial', 'Current Status', 'User', 'Date'); ?>
                <?php echo $this->table->generate($aircard_query); ?>
                <?php $this->table->clear(); ?>
            </td>
        </tr>
        <tr id="stocktable_row_head">
            <td class="stock_head"><a href="#">Projectors</a></td>
        </tr>
        <tr>
            <td>
                <?php $this->table->set_heading('Serial', 'Current Status', 'User', 'Date'); ?>
                <?php echo $this->table->generate($projector_query); ?>
                <?php $this->table->clear(); ?>
            </td>
        </tr>
	</tbody>
</table>