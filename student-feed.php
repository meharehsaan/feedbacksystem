<?php include "header.php";
//session check
if ($_SESSION['role'] != '1') {
  header("location: {$hostname}/logout.php");
}

?>
<div id="admin-content">
  <div class="container">
    <div class="row">
      <div class="col-md-10">
        <h1 class="admin-heading">Your Feedback</h1>
      </div>
      <div class="col-md-2">
        <a class="add-new" href="add-feedback.php?id=<?php echo $_SESSION['username'] ?>">add feedback</a>
      </div>
      <div class="col-md-12">
        <?php 

        //retrieving data of particular student
        $sql = "SELECT feedback.q1, feedback.q2, feedback.q3, feedback.comment, faculty.name FROM feedback LEFT JOIN faculty ON feedback.faculty_id = faculty.faculty_id WHERE student_id = '{$_SESSION['username']}'";
        $result = mysqli_query($conn, $sql) or die("Query Failed = ".$sql);
        //showing data on table
        if (mysqli_num_rows($result) > 0) {
          ?>
          <table class="content-table">
            <thead>
              <th>Faculty</th>
              <th>q1</th>
              <th>q2</th>
              <th>q3</th>
            <!-- <th>q4</th>
            <th>q5</th>
            <th>q6</th>
            <th>q7</th>
            <th>q8</th>
            <th>q9</th>
            <th>q10</th>
            <th>Delete</th> -->
            <th>comment</th>
          </thead>
          <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
              ?>
              <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['q1']; ?></td>
                <td><?php echo $row['q2']; ?></td>
                <td><?php echo $row['q3']; ?></td>
                  <!-- <td>q4</td>
                  <td>q5</td>
                  <td>q6</td>
                  <td>q7</td>
                  <td>q8</td>
                  <td>q9</td>
                  <td>q10</td>
                  <td class='delete'><a href='delete-user.php'><i class='fa fa-trash-o'></i></a></td> -->
                  <td><?php echo $row['comment']; ?></td>
                </tr>
                <?php 
              }
            }else{
              echo "<p class='error'>No Record Found.</p>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
