<!DOCTYPE HTML>
<html>

<head>

			

			
  <script type="text/javascript">
  window.onload = function () {
  	
    var chart = new CanvasJS.Chart("chartContainer",
    {
      title:{
        text: "Total Statistics"    
      },
      animationEnabled: true,
      axisY: {
        title: ""
      },
      legend: {
        verticalAlign: "bottom",
        horizontalAlign: "center"
      },
      theme: "theme2",
      data: [

      {        
        type: "column",  
        showInLegend: true, 
        legendMarkerColor: "grey",
        legendText: "Total Sales",
        dataPoints: [      
        {y: 5
       , label: "Total Gallons"},
        {y: 10, label: "Total Walkin"},
        {y: 20, label: "Total Delivery"},
        {y: 30, label: "Total Users"},
        ]
      }   
      ]
    });

    chart.render();
  }
  </script>
<script type="text/javascript" src="canvasjs.min.js"></script>
</head>
<body>
<div id="chartContainer" style="height: 300px; width: 100%;"></div>
</body>

</html>