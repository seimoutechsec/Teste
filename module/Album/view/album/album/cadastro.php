<?php
$title = 'My people';
$this->headTitle($title);
?>
<h1><?php echo $this->escapeHtml($title); ?></h1>

<p>
    <a href="<?php echo $this->url('album', array('action'=>'addperson'));?>">Add new person</a>
</p>

<table class="table">
<tr>
    <th>Title</th>
    <th>Artist</th>
    <th>&nbsp;</th>
</tr>
<?php foreach ($albums as $album) : ?>
    <tr>
        <td><?php echo $this->escapeHtml($album->title);?></td>
        <td><?php echo $this->escapeHtml($album->artist);?></td>
        <td><a href="<?php echo $this->url('album', array('action'=>'edit', 'id' => $album->id));?>">Edit</a>
            <a href="<?php echo $this->url('album', array('action'=>'delete', 'id' => $album->id));?>">Delete</a>
        </td>
    </tr>
<?php endforeach; ?>
</table>