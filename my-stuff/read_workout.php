<?php
include '../mydbfiletest.php';

global $wpdb;
include '../wp-load.php';


$user_now = get_current_user_id();
error_log("current user=" . $user_now);
// error_log("id=".$_GET['id']);

$sql = "SELECT * FROM `workout` WHERE `user_id` = '$user_now'";

$re = $conn->query($sql);

error_log('sql = ' . $sql);
// webpage form starts here
echo "<tbody>";
echo "<thead>";
echo "<th>Date</th><th>Workout</th><th>Time Spent (Mins)</th><th></
td> <th>Delete</td>";
echo "</thead>";
while ($row = $re->fetch_assoc()) {
	if (isset($_GET['id'])) {
		if ($row['id'] == $_GET['id']) {
			echo '<tr><td colspan="5"><form action="/NCKH/my-stuff/update_workout.php" method="POST">';
			echo '<table>';
			echo '<tr><td><input type="date" name="workout_date" value="' . $row['workout_date'] . '"></td>';
			echo '<td><input type="text" name="activity" value="' . $row['activity'] . '"></td>';
			echo '<td><input type="text" name="time_mins" value="' . $row['time_mins'] . '"></td>';
			echo '<td><input type="hidden" name="user_id" value="' . $row['user_id'] . '"><input type="submit" value="Save"></td>';
			echo '<td><input type="hidden" name="id" value="' . $row['id'] . '"></td></tr>';
			echo '</form>';
			echo '</td></td>';
		}
	} else {
		echo "<tr>";
		echo "<td>" . $row['workout_date'] . "</td>";
		echo "<td>" . $row['activity'] . "</td>";
		echo "<td>" . $row['time_mins'] . "</td>";
		echo '<td><a class="btn btn-info" href="/NCKH/workout/?id=' . $row["id"] . '">Sửa</a></td>';
		echo '<td> <a class="btn btn-danger" href="/NCKH/my-stuff/delete_workout.php?id=' . $row['id'] . '">Delete</a></td>';
		echo "</tr>";
		echo "</tbody>";
		
	}
}
$conn->close();