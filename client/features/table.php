<?php 

  include_once '../server/db/connection.php';

  $result = mysqli_query($conn, "SELECT * FROM sms_success")
  or die (mysqli_error($conn));
?>

<div class='dataTable co-md-12 overflow-auto'>
  <table class='table table-striped table-dark col-lg-6 col-md-8 col-sm-8 mx-auto'>
     <thead>
      <tr>
        <th>#</th>
        <th>From Number</th>
        <th>To Number</th>
        <th>Message</th>
        <th>Time Sent</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
    <?php while($row = $result->fetch_assoc()) { ?>
      <tr>
        <td><?php echo $row['id'] ?></td>
        <td><?php echo $row['fromnum'] ?></td>
        <td><?php echo $row['tonum'] ?></td>
        <td><?php echo $row['message'] ?></td>
        <td><?php echo $row['timestamp'] ?></td>
        <td><?php echo $row['status'] ?></td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
</div>

