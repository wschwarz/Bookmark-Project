<table>
	<tr>
		<th></th>
		<th><a onclick="Sort(this);" href="#">Title</a></th>
		<th><a onclick="Sort(this);" href="#">Date Added</a></th>
		<th><a onclick="Sort(this);" href="#">Last Modified</a></th>
		<th><a onclick="Sort(this);" href="#">Category</a></th>
		<th><a onclick="Sort(this);" href="#">Read</a></th>
	</tr>
	<?php
	foreach($resultArray as $row) {
		$lastModified = $row["last_modified"]=="undefined"?"N/A":date('l, F d, Y', ($row["last_modified"]/1000));
		$addDate = $row["add_date"]=="undefined"?"N/A":date('l, F d, Y', ($row["add_date"]/1000));
		$title = $row["title"];
		if (strlen($title) > 35)
			$title = substr($title, 0, 35) . "...";
		echo "<tr>";
		echo "<td><input type='checkbox' value='" . $row["_id"] . "' /></td>";
		echo "<td><a href='" .$row["link"] . "'>" . $title . "</a></td>";
		echo "<td>".$addDate."</td>";
		echo "<td>".$lastModified."</td>";
		echo "<td>".$row["category"]."</td>";
		echo "<td style='text-align:center; padding-left: 14px; padding-right: 14px;'>";
		if ($row["read"] == "No")
			{
				echo "<div class='ui-widget-header ui-corner-all' onclick='ReadClicked(\"".$row["_id"]."\");'><span class='ui-icon ui-icon-check'></span></div>";
			}
		else
			{
				//echo "<img src='".base_url()."BMApp/system/application/styles/Images/checked_16x16.gif' onclick='ReadClicked(\"".$row["_id"]."\");' />";
				echo "<div class='ui-state-default ui-corner-all' onclick='ReadClicked(\"".$row["_id"]."\");'><span class='ui-icon ui-icon-check'></span></div>";
			}
		echo "</td>";
		echo "</tr>";
	}
	?>

</table>
<br />
<div class="PagerLinks">
	<a href="#" onclick="Link('back');"><</a>
	<?php echo " Page: ". $this->session->userdata('page'). " "; ?>
	<a href="#" onclick="Link('forward');">></a>
</div>