<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Created By</th>
                <th>Title</th>
                <th>Description</th>
                <th>Agency</th>
                <th>Created</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($stories as $row) { ?>
        <tr>
            <td><?php echo $row['id'];?></td>
            <td><?php echo $row['user']['first_name'] . ' ' . $row['user']['last_name'];?></td>
            <td><?php echo $row['title'];?></td>
            <td><?php echo $row['description'];?></td>
            <td><?php echo $row['agency']['name'];?></td>
            <td><?php echo date_format($row['created'], 'd/m/y');?></td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
</div>