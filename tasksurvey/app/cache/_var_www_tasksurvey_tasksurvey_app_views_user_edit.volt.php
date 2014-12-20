<?php echo $this->getContent(); ?>
<?php echo $this->tag->form(array('user/save', 'method' => 'post')); ?>

<table width="100%">
    <tr>
        <td align="left"><?php echo $this->tag->linkTo(array('user', 'Go Back')); ?></td>
        <td align="right"><?php echo $this->tag->submitButton(array('Save')); ?></td>
    </tr>
</table>

<div align="center">
    <h1>Edit user</h1>
</div>

<table>
    <tr>
        <td align="right">
            <label for="unit_id">Unit</label>
        </td>
        <td align="left">
            <?php echo $this->tag->textField(array('unit_id', 'type' => 'numeric')); ?>
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="rank">Rank</label>
        </td>
        <td align="left">
            <?php echo $this->tag->textField(array('rank', 'type' => 'numeric')); ?>
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="prename">Prename</label>
        </td>
        <td align="left">
            <?php echo $this->tag->textField(array('prename', 'size' => 30)); ?>
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="lastname">Lastname</label>
        </td>
        <td align="left">
            <?php echo $this->tag->textField(array('lastname', 'size' => 30)); ?>
        </td>
    </tr>

    <tr>
        <td><?php echo $this->tag->hiddenField(array('id')); ?></td>
        <td><?php echo $this->tag->submitButton(array('Save')); ?></td>
    </tr>
</table>

</form>
