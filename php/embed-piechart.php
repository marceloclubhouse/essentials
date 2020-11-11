<?php

/*
 *  Essentials WordPress Plugin
 *  by Marcelo Cubillos
 *  https://marcelocubillos.com/wordpress-essentials/
 *
 *  embed-piechart.php - Embed/generate a pie chart using Google's Pie Chart JS.
 *
 *  Revisions:
 *      - 2020/11/04 : Initial revision
 *
 *  This is provided under the MIT license. See LICENSE.txt
 *  for more information.
 */

function essentialsGeneratePiechartJS($title, $chart_data)
{
    /*
     * Given a title and piechart data, return a Javascript
     * function enclosed in a string that can generate
     * and display a pie chart.
     */

    // Create an HTML-friendly title that can be used to address
    // the generated pie chart.
    $html_friendly_title = str_replace(' ', '', strtolower($title));

    $piechart_js = "
    // Load the Google Charts API, required for any of the generation
    // calls to the API to work properly
    google.charts.load('current', {'packages':['corechart']});
    
    // Link the following function to the Google Charts callback,
    // so once the API is done loading it will generate the pie
    // chart. This has to be done for every pie chart function.
    google.charts.setOnLoadCallback(piechart{$html_friendly_title});
        
    function piechart{$html_friendly_title}()
    {
        // Split the primitive data string into an array
        // (e.g. \"Art:3,Science:3\" -> [\"Art:3\", \"Science:3\"]
        let primitive_data_array = '{$chart_data}'.split(\",\");
    
        // The parsed data array requires a 2-array of strings
        // at index 0 for Google's API to function properly.
        let parsed_data_array = [['', '']];
        // Iterate through the primitive array and create a new
        // array of parsed data
        // (e.g. [\"Art:3\", \"Science:3\"] -> [[Art, 3], [Science, 3]])
        for(let i = 0; i < primitive_data_array.length; i++)
        {
            parsed_data_array.push(primitive_data_array[i].split(\":\"));
            // Convert the value from a string to an int
            parsed_data_array[i + 1][1] = parseInt(parsed_data_array[i + 1][1]);
        }
        
        console.log(parsed_data_array);
    
        // Generate the chart using Google Charts
        let chart_data = google.visualization.arrayToDataTable(parsed_data_array);
        let options = { 'title': '{$title}',
                        'chartArea': {'width': '100%', 'height': '80%'}};
        let chart_name = \"piechart{$html_friendly_title}\";
        let chart = new google.visualization.PieChart(document.getElementById(chart_name));
    
        chart.draw(chart_data, options);
    }
    ";

    return $piechart_js;
}
