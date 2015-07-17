<?php /* Template Name: Geo Map1 Template */ ?>
<?php get_header(); ?>
<?php if(is_user_logged_in()){ ?>
<script>
google.load("visualization", "1", {packages:["geochart"]});
google.setOnLoadCallback(drawRegionsMap);
var currentRegion;

function drawRegionsMap() {
    var data = google.visualization.arrayToDataTable([
        ['State', 'Views'],
        ['US-AL', 300],
        ['US-SC', 300],
        ['US-PA', 400]
    ]);
    
    //var view = new google.visualization.DataView(data);
    var options = {
        region: 'US',
        resolution: 'provinces',
        colorAxis: {colors: ['#acb2b9', '#2f3f4f']}
    };
    
    var geochart = new google.visualization.GeoChart(document.getElementById('chart_div'));
    geochart.draw(data, options);
    
    google.visualization.events.addListener(geochart,'select', function (eventData) {
        var selectedData = geochart.getSelection();
        var row = selectedData[0].row;
        var item = data.getValue(row,0);
        //alert("You selected :" + item);
        
        options['region'] = item;
        options['resolution'] = 'provinces';
        
        var data1 = google.visualization.arrayToDataTable([
            ['City', 'Views', 'Impressions'],
            ['AL-Dallas', 200, 100],
            ['Charlotte, NC', 300, 300],
            ['Raleigh, NC', 400, 300],
            ['Monroe, NC', 400, 400],
            ['Rock-Hill, SC', 400, 500]
        ]);
        
        var counties = {};
        // Now let's add a county polygon:
        counties['Alameda'] = new google.maps.Polygon({
          paths: [
            // This is not real data:
            new google.maps.LatLng(-86.91827,32.65322),
            new google.maps.LatLng(-86.9185,32.64452),
            new google.maps.LatLng(-86.9119,32.63178),
            new google.maps.LatLng(-86.91827,32.65322)
            // ...
          ],
          strokeColor: '#FF0000',
          strokeOpacity: 0.8,
          strokeWeight: 2,
          fillColor: '#FF0000",
          fillOpacity: 0.3'
        });
        
        counties['Alameda'].setMap(map);
        
        geochart.draw(data1, options);
    });
}
</script>
<div id="bodymaincontainer">
	<div class="maincontent">
	    <div class="section group">
            <div class="col span_12_of_12">
                <div class="groupbox" style="height: 500px;">
                    <div id="chart_div" style="width: 100%; height: 500px;"></div>
                </div>
            </div>
	    </div>
	</div>
</div>
<?php } else { header('Location: '.get_bloginfo('home').'/log-in'); } ?>
<?php get_footer(); ?>