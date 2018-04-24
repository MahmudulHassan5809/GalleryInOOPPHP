  </div>
    <!-- /#wrapper -->
   
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
      <script type="text/javascript" src="js/dropzone.js"></script>
    <script type="text/javascript" src="js/scripts.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['views',  <?php echo $session->count; ?>],
          ['Photo',   <?php echo Photo::count_all() ; ?>],
          ['Users', <?php echo User::count_all() ; ?>],
          ['Comments', <?php echo Comment::count_all() ; ?>]
    
        ]);

        var options = {
          pieSliceText : 'label',
          backgroundColor :	'transparent',
          title: 'My Daily Activities'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>


</body>

</html>
