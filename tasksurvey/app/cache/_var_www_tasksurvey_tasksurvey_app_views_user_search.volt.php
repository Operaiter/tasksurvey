
<?php echo $this->getContent(); ?>

<table width="100%">
    <tr>
        <td align="left">
            <?php echo $this->tag->linkTo(array('user/index', 'Go Back')); ?>
        </td>
        <td align="right">
            <?php echo $this->tag->linkTo(array('user/new', 'Create ')); ?>
        </td>
    </tr>
</table>

<table class="browse" align="center">
    <thead>
        <tr>
            <th>User</th>
            <th>Unit</th>
            <th>Rank</th>
            <th>Prename</th>
            <th>Lastname</th>
         </tr>
    </thead>
    <tbody>
    <?php if (isset($page->items)) { ?>
    <?php foreach ($page->items as $user) { ?>
        <tr>
            <td><?php echo $user->user_id; ?></td>
            <td><?php echo $user->unit_id; ?></td>
            <td><?php echo $user->rank; ?></td>
            <td><?php echo $user->prename; ?></td>
            <td><?php echo $user->lastname; ?></td>
            <td><?php echo $this->tag->linkTo(array('user/edit/' . $user->user_id, 'Edit')); ?></td>
            <td><?php echo $this->tag->linkTo(array('user/delete/' . $user->user_id, 'Delete')); ?></td>
        </tr>
    <?php } ?>
    <?php } ?>
    </tbody>
    <tbody>
        <tr>
            <td colspan="2" align="right">
                <table align="center">
                    <tr>
                        <td><?php echo $this->tag->linkTo(array('user/search', 'First')); ?></td>
                        <td><?php echo $this->tag->linkTo(array('user/search?page=' . $page->before, 'Previous')); ?></td>
                        <td><?php echo $this->tag->linkTo(array('user/search?page=' . $page->next, 'Next')); ?></td>
                        <td><?php echo $this->tag->linkTo(array('user/search?page=' . $page->last, 'Last')); ?></td>
                        <td><?php echo $page->current . '/' . $page->total_pages; ?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </tbody>
</table>
