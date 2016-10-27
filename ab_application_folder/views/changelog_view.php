<!--Load the AJAX API-->
 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js" type="text/javascript"></script>
 <script type="text/javascript">
 
// Load the Visualization API and the piechart package.
 google.load('visualization', '1', {'packages':['corechart']});
 
// Set a callback to run when the Google Visualization API is loaded.
 google.setOnLoadCallback(drawChart);
 
function drawChart() {
 var jsonData = $.ajax({
 url:'<?php echo base_url().'index.php/changelog/getData'?>', //another controller function for generating data
 mtype : "post", //Ajax request type. It also could be GET
 dataType:"json",
 async: false
 }).responseText;
 
// Create our data table out of JSON data loaded from server.
 var data = new google.visualization.DataTable(jsonData);
 
// Instantiate and draw our chart, passing in some options.
 var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
 chart.draw(data, {width: 400, height: 240});
 }
 
</script>

	<div id="change_nav">
		<h3><a href="<?php echo base_url();?>home">Home</a></h3>
	</div>
	<div id="change_container">
		<h2 id="change_head">DATE</h2>
		<div id="change_body">
			<ol>
				<li></li>
			</ol>
		</div>
		<h4 id="change_subhead">TO-DO</h4>
		<div id="change_body">
			<ol>
				<li>Something</li>
				<ul>
					<li>Sub-something</li>
				</ul>
			</ol>
		</div>
	</div>

<!--Div that will hold the pie chart-->
 <div id="chart_div"></div>

<!-- 
	<div id="change_container">
		<h2 id="change_head">DATE</h2>
		<div id="change_body">
			<ol>
				<li>Something</li>
				<li>Something</li>
				<li>Something</li>
				<li>Something</li>
			</ol>
		</div>
		<h4 id="change_subhead">TO-DO</h4>
		<div id="change_body">
			<ol>
				<li>Something</li>
				<li>Something</li>
				<li>Something</li>
				<li>Something</li>
				<ul>
					<li>Sub-something</li>
				</ul>
			</ol>
		</div>
	</div>
 -->