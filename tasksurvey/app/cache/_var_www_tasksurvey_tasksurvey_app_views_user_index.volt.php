
<?php echo $this->getContent(); ?>

<div align="right">
    <?php echo $this->tag->linkTo(array('user/new', 'Create user')); ?>
</div>

<?php echo $this->tag->form(array('user/search', 'method' => 'post', 'autocomplete' => 'off')); ?>

<div align="center">
    <h1>Search user</h1>
</div>

<table>
    <tr>
        <td align="right">
            <label for="user_id">User</label>
        </td>
        <td align="left">
            <?php echo $this->tag->textField(array('user_id', 'type' => 'numeric')); ?>
        </td>
    </tr>
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
        <td></td>
        <td><?php echo $this->tag->submitButton(array('Search')); ?></td>
    </tr>
</table>

</form>
