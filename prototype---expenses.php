
<?php
/**
 * Created by PhpStorm.
 * User: nnn
 * Date: 11/19/2016
 * Time: 12:04 PM
 */
//PROTOTYPE for management reports will need to do some modification 
//https://web.stevens.edu/sponapps/Proposals/expenses.php

include_once 'include/conn.php';
include_once 'include/database.php';

$con = mysqli_connect($db_host,$db_user,$db_pass,'w3_sponapps');

if(mysqli_connect_errno()) {

    printf("Connection failed" . mysqli_connect_error());

    exit();
}
//first QUery--------------------------------------------------------/////////////////
$sql = 'Select FY, PERIOD, sum(EXPENSES) as AMTS from expenses group by FY,PERIOD';
$result= mysqli_query($con, $sql);


$Total14 = 0;
$Total15 = 0;
$Total16 = 0;
$Total17 = 0;

$TotalPeriod14 = 0;
$TotalPeriod15 = 0;
$TotalPeriod16 = 0;
$TotalPeriod17 = 0;


if((int)date("m") > 7 ) {
    $month = (int)date("m") - 7;
}
else {
    $month = (int)date("m") +6;
}

while ($rows = mysqli_fetch_array($result)) {

    if($rows['FY']=='2014') {
        $Total14 += doubleval($rows['AMTS']);

        if((int)substr($rows['PERIOD'],4,2) <= $month ) {
            $TotalPeriod14 += doubleval($rows['AMTS']);
        }
    }
    if($rows['FY']=='2015') {
        $Total15 += doubleval($rows['AMTS']);

        if((int)substr($rows['PERIOD'],4,2) <= $month ) {
            $TotalPeriod15 += doubleval($rows['AMTS']);
        }
    }
    if($rows['FY']=='2016') {
        $Total16 += doubleval($rows['AMTS']);

        if((int)substr($rows['PERIOD'],4,2) <= $month ) {
            $TotalPeriod16 += doubleval($rows['AMTS']);
        }
    }
    if($rows['FY']=='2017') {
        $Total17 += doubleval($rows['AMTS']);

        if((int)substr($rows['PERIOD'],4,2) <= $month ) {
            $TotalPeriod17 += doubleval($rows['AMTS']);
        }
    }
}
$totalYear = array($Total14, $Total15, $Total16);

$totalPeriod = array($TotalPeriod14, $TotalPeriod15, $TotalPeriod16, $TotalPeriod17);

?>
<!-------- Next Query ----------------------------------------------------------------------->

<?php
$sql2 = 'Select FY, Object_TYPE, sum(EXPENSES) as AMTS from expenses where FY in ("2014","2015","2016","2017") group by FY,Object_TYPE order by FY';

$result2 = mysqli_query($con,$sql2);

$oh = array();
$sub = array();
$stevensdc= array();

while ($rows = mysqli_fetch_array($result2)) {

    if($rows['Object_TYPE']=='OH')

        $oh[] = doubleval($rows['AMTS']);

    if($rows['Object_TYPE']=='SubAwards')

        $sub[] = doubleval($rows['AMTS']);

    if($rows['Object_TYPE']=='Stevens DC')

        $stevensdc[] = doubleval($rows['AMTS']);


}

?>

<!-------- Next Query ----------------------------------------------------------------------->
<?php
/**
 * Created by PhpStorm.
 * User: nn
 * Date: 11/19/2016
 * Time: 12:04 PM
 */
//connection 1 to get sum


$SERC14 = 0;
$SSE14=0;
$ADM14=0;
$CAL14=0;
$CIESE14=0;
$SB14=0;
$SES14=0;

$SERC15 = 0;
$SSE15=0;
$ADM15=0;
$CAL15=0;
$CIESE15=0;
$SB15=0;
$SES15=0;

$SERC16 = 0;
$SSE16=0;
$ADM16=0;
$CAL16=0;
$CIESE16=0;
$SB16=0;
$SES16=0;

$SERC17 = 0;
$SSE17=0;
$ADM17=0;
$CAL17=0;
$CIESE17=0;
$SB17=0;
$SES17=0;

//Arrays
$ARRAYSERC14 = array();
$ARRAYSSE14=array();
$ARRAYADM14=array();
$ARRAYSB14=array();
$ARRAYSES14=array();
$ARRAYCAL14=array();
$ARRAYCIESE14=array();

$ARRAYSERC15 = array();
$ARRAYSSE15=array();
$ARRAYADM15=array();
$ARRAYSB15=array();
$ARRAYSES15=array();
$ARRAYCAL15=array();
$ARRAYCIESE15=array();

$ARRAYSERC16 = array();
$ARRAYSSE16=array();
$ARRAYADM16=array();
$ARRAYSB16=array();
$ARRAYSES16=array();
$ARRAYCAL16=array();
$ARRAYCIESE16=array();

$ARRAYSERC17 = array();
$ARRAYSSE17=array();
$ARRAYADM17=array();
$ARRAYSB17=array();
$ARRAYSES17=array();
$ARRAYCAL17=array();
$ARRAYCIESE17=array();

$sql2 = 'Select FY, Object_TYPE, SCHOOL, sum(EXPENSES) as AMTS from expenses group by FY, SCHOOL, Object_TYPE order by FY';

$result2 = mysqli_query($con,$sql2);



while ($rows = mysqli_fetch_array($result2)) {

    if($rows['FY']=='2014') {
        if ($rows['SCHOOL']=='SERC') {
            $SERC14 +=  doubleval($rows['AMTS']);
            $ARRAYSERC14[] = array($rows['Object_TYPE'], doubleval($rows['AMTS']));
        }
        if ($rows['SCHOOL']=='SES') {
            $SES14 +=  doubleval($rows['AMTS']);
            $ARRAYSES14[] = array($rows['Object_TYPE'], doubleval($rows['AMTS']));
        }
        if ($rows['SCHOOL']=='CAL') {
            $CAL14 +=  doubleval($rows['AMTS']);
            $ARRAYCAL14[] = array($rows['Object_TYPE'], doubleval($rows['AMTS']));
        }
        if ($rows['SCHOOL']=='ADM') {
            $ADM14 +=  doubleval($rows['AMTS']);
            $ARRAYADM14[] = array($rows['Object_TYPE'], doubleval($rows['AMTS']));
        }
        if ($rows['SCHOOL']=='SSE') {
            $SSE14 +=  doubleval($rows['AMTS']);
            $ARRAYSSE14[] = array($rows['Object_TYPE'], doubleval($rows['AMTS']));
        }
        if ($rows['SCHOOL']=='CIESE') {
            $CIESE14 +=  doubleval($rows['AMTS']);
            $ARRAYCIESE14[] = array($rows['Object_TYPE'], doubleval($rows['AMTS']));
        }
        if ($rows['SCHOOL']=='SB') {
            $SB14 +=  doubleval($rows['AMTS']);
            $ARRAYSB14[] = array($rows['Object_TYPE'], doubleval($rows['AMTS']));
        }
    }
    if($rows['FY']=='2015') {
        if ($rows['SCHOOL']=='SERC') {
            $SERC15 +=  doubleval($rows['AMTS']);
            $ARRAYSERC15[] = array($rows['Object_TYPE'], doubleval($rows['AMTS']));
        }
        if ($rows['SCHOOL']=='SES') {
            $SES15 +=  doubleval($rows['AMTS']);
            $ARRAYSES15[] = array($rows['Object_TYPE'], doubleval($rows['AMTS']));
        }
        if ($rows['SCHOOL']=='CAL') {
            $CAL15 +=  doubleval($rows['AMTS']);
            $ARRAYCAL15[] = array($rows['Object_TYPE'], doubleval($rows['AMTS']));
        }
        if ($rows['SCHOOL']=='ADM') {
            $ADM15 +=  doubleval($rows['AMTS']);
            $ARRAYADM15[] = array($rows['Object_TYPE'], doubleval($rows['AMTS']));
        }
        if ($rows['SCHOOL']=='SSE') {
            $SSE15 +=  doubleval($rows['AMTS']);
            $ARRAYSSE15[] = array($rows['Object_TYPE'], doubleval($rows['AMTS']));
        }
        if ($rows['SCHOOL']=='CIESE') {
            $CIESE15 +=  doubleval($rows['AMTS']);
            $ARRAYCIESE15[] = array($rows['Object_TYPE'], doubleval($rows['AMTS']));
        }
        if ($rows['SCHOOL']=='SB') {
            $SB15 +=  doubleval($rows['AMTS']);
            $ARRAYSB15[] = array($rows['Object_TYPE'], doubleval($rows['AMTS']));
        }
    }

    if($rows['FY']=='2016') {
        if ($rows['SCHOOL']=='SERC') {
            $SERC16 +=  doubleval($rows['AMTS']);
            $ARRAYSERC16[] = array($rows['Object_TYPE'], doubleval($rows['AMTS']));
        }
        if ($rows['SCHOOL']=='SES') {
            $SES16 +=  doubleval($rows['AMTS']);
            $ARRAYSES16[] = array($rows['Object_TYPE'], doubleval($rows['AMTS']));
        }
        if ($rows['SCHOOL']=='CAL') {
            $CAL16 +=  doubleval($rows['AMTS']);
            $ARRAYCAL16[] = array($rows['Object_TYPE'], doubleval($rows['AMTS']));
        }
        if ($rows['SCHOOL']=='ADM') {
            $ADM16 +=  doubleval($rows['AMTS']);
            $ARRAYADM16[] = array($rows['Object_TYPE'], doubleval($rows['AMTS']));
        }
        if ($rows['SCHOOL']=='SSE') {
            $SSE16 +=  doubleval($rows['AMTS']);
            $ARRAYSSE16[] = array($rows['Object_TYPE'], doubleval($rows['AMTS']));
        }
        if ($rows['SCHOOL']=='CIESE') {
            $CIESE16 +=  doubleval($rows['AMTS']);
            $ARRAYCIESE16[] = array($rows['Object_TYPE'], doubleval($rows['AMTS']));
        }
        if ($rows['SCHOOL']=='SB') {
            $SB16 +=  doubleval($rows['AMTS']);
            $ARRAYSB16[] = array($rows['Object_TYPE'], doubleval($rows['AMTS']));
        }
    }
    if($rows['FY']=='2017') {
        if ($rows['SCHOOL']=='SERC') {
            $SERC17 +=  doubleval($rows['AMTS']);
            $ARRAYSERC17[] = array($rows['Object_TYPE'], doubleval($rows['AMTS']));
        }
        if ($rows['SCHOOL']=='SES') {
            $SES17 +=  doubleval($rows['AMTS']);
            $ARRAYSES17[] = array($rows['Object_TYPE'], doubleval($rows['AMTS']));
        }
        if ($rows['SCHOOL']=='CAL') {
            $CAL17 +=  doubleval($rows['AMTS']);
            $ARRAYCAL17[] = array($rows['Object_TYPE'], doubleval($rows['AMTS']));
        }
        if ($rows['SCHOOL']=='ADM') {
            $ADM17 +=  doubleval($rows['AMTS']);
            $ARRAYADM17[] = array($rows['Object_TYPE'], doubleval($rows['AMTS']));
        }
        if ($rows['SCHOOL']=='SSE') {
            $SSE17 +=  doubleval($rows['AMTS']);
            $ARRAYSSE17[] = array($rows['Object_TYPE'], doubleval($rows['AMTS']));
        }
        if ($rows['SCHOOL']=='CIESE') {
            $CIESE17 +=  doubleval($rows['AMTS']);
            $ARRAYCIESE17[] = array($rows['Object_TYPE'], doubleval($rows['AMTS']));
        }
        if ($rows['SCHOOL']=='SB') {
            $SB17 +=  doubleval($rows['AMTS']);
            $ARRAYSB17[] = array($rows['Object_TYPE'], doubleval($rows['AMTS']));
        }
    }

}

?>
<!------------------------------- Next Query --------------------------------------->

<?php 

$T_PROP= array();
$NTT_PROP = array();
$TT_PROP = array();


$T_AWARD= array();
$NTT_AWARD = array();
$TT_AWARD = array();
     

$sql5 = "select sum(PROP) as PROP, sum(awardcount) as award_count, TENURE_STATUS, SCHOOL from FACULTY_ACTIVITY where SCHOOL not in ('Phys') group by SCHOOL, TENURE_STATUS order by
field(SCHOOL, 'SES','SSE','SB','CAL')"; 

$result5= mysqli_query($con, $sql5);


while($row = mysqli_fetch_array($result5)) {
  
    if($row['TENURE_STATUS'] =='T') {
        $T_PROP[] = (int)$row['PROP'];
         $T_AWARD[] = (int)$row['award_count'];
    }
    
     if($row['TENURE_STATUS'] =='TT') {
        $TT_PROP[] = (int)$row['PROP'];
         $TT_AWARD[] = (int)$row['award_count'];
    }
    
    if($row['TENURE_STATUS'] =='NTT') {
        $NTT_PROP[] = (int)$row['PROP'];
         $NTT_AWARD[] = (int)$row['award_count'];
    }
   
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="code/modules/drilldown.js"></script>
    <style>
        
        .totals {
            background: yellow;
            font-weight: bold;
        }
        .header {
            background: lightblue;
        }
    </style>


</head>
<body>


<!--------------------------------First Graph--------------------------------------------------------->
<script>


    $(function () {

        Highcharts.setOptions({
            lang: {
                thousandsSep:','
            }
        });
        Highcharts.chart('container', {
            chart: {
                type: 'column',
            
               
            },
            
   
           
            title: {
                text: ''
            },
            subtitle: {
                text: 'As of October 2016'
            },
            xAxis: {
                categories: [
                    'FY2014',
                    'FY2015',
                    'FY2016',
                    'FY2017'


                ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Expenses'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>${point.y:,.0f}</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'October',
                color:  '#7a1f0b',
                data: <?php echo json_encode($totalPeriod) ?>
              
              
                

            }, {
                name: 'Annual Total',
                color:  '#c13718',
                data: <?php echo json_encode($totalYear) ?>

            }]
        });
    });
</script>

<!------------------- 2nd Graph --------------------------------------------------------------->

<script>
    $(function () {
        Highcharts.chart('container1', {
            title: {
                text: ''

            },
            subtitle: {
                text: 'As of October 2016'

            },
            xAxis: {
                categories: ['2014', '2015', '2016', 'Jul-Oct 2016']
            },
            yAxis: {
                title: {
                    text: 'Expenses'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },

            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [ {
                name: 'Stevens Direct Costs',
                color: "#7a1f0b",
                data: <?php echo json_encode($stevensdc) ?>
            },
            {
                name: 'Indirect Costs',
                color: "navy",
                data: <?php echo json_encode($oh) ?>
            },
            {
                name: 'Subcontracts',
                color: "#a98792",
                data: <?php echo json_encode($sub) ?>
            }


            ]
        });
    });


</script>
<!------------------- 3rd Graph --------------------------------------------------------------->

<script>
    $(function () {

        // Create the chart
        $('#container2').highcharts({
            chart: {
                type: 'column',
                 options3d: {
                    enabled: true,
                    alpha: 45,
                    beta: 0
                },
                events: {
                    drilldown: function (e) {
                        if (!e.seriesOptions) {

                            console.log(e.point.name);
                            console.log(e.point.series.name);

                            var chart = this,
                                drilldowns = {
                                    '2014': [
                                        {
                                            name: 'SERC',
                                            type: 'pie',
                                            data:
                                               <?php echo json_encode($ARRAYSERC14) ?>

                                        },
                                        {
                                            name: 'SSE',
                                            type: 'pie',
                                            data:
                                                <?php echo json_encode($ARRAYSSE14) ?>

                                        },
                                        {
                                            name: 'SES',
                                            type: 'pie',
                                            data: <?php echo json_encode($ARRAYSES14) ?>
                                        },
                                        {
                                            name: 'ADM',
                                            type: 'pie',
                                            data: <?php echo json_encode($ARRAYADM14) ?>

                                        },
                                        {
                                            name: 'CIESE',
                                            type: 'pie',
                                            data: <?php echo json_encode($ARRAYCIESE14) ?>
                                        },
                                        {
                                            name: 'SB',
                                            type: 'pie',
                                            data: <?php echo json_encode($ARRAYSB14) ?>
                                        },
                                        {
                                            name: 'CAL',
                                            type: 'pie',
                                            data: <?php echo json_encode($ARRAYCAL14) ?>
                                        }

                                    ],
                                    '2015': [
                                        {
                                            name: 'SERC',
                                            type: 'pie',
                                            data: <?php echo json_encode($ARRAYSERC15) ?>
                                        },
                                        {
                                            name: 'SSE',
                                            type: 'pie',
                                            data: <?php echo json_encode($ARRAYSSE15) ?>
                                        },
                                        {
                                            name: 'SES',
                                            type: 'pie',
                                            data: <?php echo json_encode($ARRAYSES15) ?>
                                        },
                                        {
                                            name: 'ADM',
                                            type: 'pie',
                                            data: <?php echo json_encode($ARRAYADM15) ?>
                                        },
                                        {
                                            name: 'CIESE',
                                            type: 'pie',
                                            data: <?php echo json_encode($ARRAYCIESE15) ?>
                                        },
                                        {
                                            name: 'SB',
                                            type: 'pie',
                                            data: <?php echo json_encode($ARRAYSB15) ?>
                                        },
                                      
                                        {
                                            name: 'CAL',
                                            type: 'pie',
                                            data: <?php echo json_encode($ARRAYCAL15) ?>
                                        }

                                    ],
                                    '2016': [
                                        {
                                            name: 'SERC',
                                            type: 'pie',
                                            data: <?php echo json_encode($ARRAYSERC16) ?>
                                        },
                                        {
                                            name: 'SSE',
                                            type: 'pie',
                                            data: <?php echo json_encode($ARRAYSSE16) ?>
                                        },
                                        {
                                            name: 'SES',
                                            type: 'pie',
                                            data: <?php echo json_encode($ARRAYSES16) ?>
                                        },
                                        {
                                            name: 'ADM',
                                            type: 'pie',
                                            data: <?php echo json_encode($ARRAYADM16) ?>
                                        },
                                        {
                                            name: 'CIESE',
                                            type: 'pie',
                                            data: <?php echo json_encode($ARRAYCIESE16) ?>
                                        },
                                        {
                                            name: 'SB',
                                            type: 'pie',
                                            data: <?php echo json_encode($ARRAYSB16) ?>
                                        },
                                      
                                        {
                                            name: 'CAL',
                                            type: 'pie',
                                            data: <?php echo json_encode($ARRAYCAL16) ?>
                                        }

                                    ],
                                    '2017': [
                                        {
                                            name: 'SERC',
                                            type: 'pie',
                                            data: <?php echo json_encode($ARRAYSERC17) ?>
                                        },
                                        {
                                            name: 'SSE',
                                            type: 'pie',
                                            data: <?php echo json_encode($ARRAYSSE17) ?>
                                        },
                                        {
                                            name: 'SES',
                                            type: 'pie',
                                            data: <?php echo json_encode($ARRAYSES17) ?>
                                        },
                                        {
                                            name: 'ADM',
                                            type: 'pie',
                                            data: <?php echo json_encode($ARRAYADM17) ?>
                                        },
                                        {
                                            name: 'CIESE',
                                            type: 'pie',
                                            data: <?php echo json_encode($ARRAYCIESE17) ?>
                                        },
                                        {
                                            name: 'SB',
                                            type: 'pie',
                                            data: <?php echo json_encode($ARRAYSB17) ?>
                                        },
                                        
                                        {
                                            name: 'CAL',
                                            type: 'pie',
                                            data: <?php echo json_encode($ARRAYCAL17) ?>
                                        }

                                    ]
                                };
                            var stateSeries = drilldowns[e.point.name],
                                series;
                            for (var i = 0; i < stateSeries.length; i++) {
                                if (stateSeries[i].name === e.point.series.name) {
                                    series = stateSeries[i];
                                    break;
                                }
                            }

                            // Show the loading label
                            chart.showLoading('Simulating Ajax for ' + e.point.series.name);

                            setTimeout(function () {
                                chart.hideLoading();
                                chart.addSeriesAsDrilldown(e.point, series);
                            }, 1000);
                        }

                    }
                }
            },
            title: {
                text: 'As of October 30, 2016 (Drillable)'
            },

            legend: {
                align: 'center',
                verticalAlign: 'top',

                x: 0,
                y: 20
            },

            xAxis: {
                type: 'category',
            },

            

            plotOptions: {

                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    depth: 35,
                    dataLabels: {
                        enabled: true,
                        format: '{point.name}: {point.y:.1f}',
                        style: {
                            color: 'black'
                        }
                    }
                },


                series: {
                    borderWidth: 0,
                    dataLabels: {

                        format:  '{point.y:,.1f}'

                    },
                    showInLegend: true
                }
            },

            series: [{
                name: 'SES',
                data: [
                    {
                        name: '2014',
                        y: <?php echo $SES14 ?>,

                        drilldown: true
                    }, {
                        name: '2015',
                        y: <?php echo $SES15 ?>,
                        drilldown: true
                    }, {
                        name: '2016',
                        y: <?php echo $SES16 ?>,
                        drilldown: true
                    },
                    {
                        name: '2017',
                        y: <?php echo $SES17 ?>,
                        drilldown: true
                    },
                ]
            },
                {
                    name: 'SSE',
                    data: [
                        {
                            name: '2014',
                            y: <?php echo $SSE14 ?>,

                            drilldown: true
                        }, {
                            name: '2015',
                            y: <?php echo $SSE15 ?>,
                            drilldown: true
                        }, {
                            name: '2016',
                            y: <?php echo $SSE16 ?>,
                            drilldown: true
                        },
                        {
                            name: '2017',
                            y: <?php echo $SSE17 ?>,
                            drilldown: true
                        },

                    ]
                },
                {
                    name: 'SERC',
                    data: [
                        {
                            name: '2014',
                            y: <?php echo $SERC14 ?>,

                            drilldown: true
                        }, {
                            name: '2015',
                            y: <?php echo $SERC15 ?>,
                            drilldown: true
                        }, {
                            name: '2016',
                            y: <?php echo $SERC16 ?>,
                            drilldown: true
                        },
                        {
                            name: '2017',
                            y: <?php echo $SERC17 ?>,
                            drilldown: true
                        },
                    ]
                },
                {
                    name: 'SB',
                    data: [
                        {
                            name: '2014',
                            y: <?php echo $SB14 ?>,

                            drilldown: true
                        }, {
                            name: '2015',
                            y:  <?php echo $SB15 ?>,
                            drilldown: true
                        }, {
                            name: '2016',
                            y:  <?php echo $SB16 ?>,
                            drilldown: true
                        },
                        {
                            name: '2017',
                            y:  <?php echo $SB17 ?>,
                            drilldown: true
                        },
                    ]
                },
                {
                    name: 'CAL',
                    data: [
                        {
                            name: '2014',
                            y: <?php echo $CAL14 ?>,

                            drilldown: true
                        }, {
                            name: '2015',
                            y: <?php echo $CAL15 ?>,
                            drilldown: true
                        }, {
                            name: '2016',
                            y: <?php echo $CAL16 ?>,
                            drilldown: true
                        },
                        {
                            name: '2017',
                            y: <?php echo $CAL17 ?>,
                            drilldown: true
                        },
                    ]
                },
                {
                    name: 'CIESE',
                    data: [
                        {
                            name: '2014',
                            y: <?php echo $CIESE14 ?>,

                            drilldown: true
                        }, {
                            name: '2015',
                            y: <?php echo $CIESE14 ?>,
                            drilldown: true
                        }, {
                            name: '2016',
                            y: <?php echo $CIESE14 ?>,
                            drilldown: true
                        },
                        {
                            name: '2017',
                            y: <?php echo $CIESE14 ?>,
                            drilldown: true
                        },
                    ]
                },
                {
                    name: 'ADM',
                    data: [
                        {
                            name: '2014',
                            y: <?php echo $ADM14 ?>,

                            drilldown: true
                        }, {
                            name: '2015',
                            y: <?php echo $ADM15 ?>,
                            drilldown: true
                        }, {
                            name: '2016',
                            y: <?php echo $ADM16 ?>,
                            drilldown: true
                        },
                        {
                            name: '2017',
                            y: <?php echo $ADM17 ?>,
                            drilldown: true
                        },
                    ]
                }



            ],

            drilldown: {
                series: []
            },

            colors: ["#7a1f0b", "#c13718", "#a98792","#5f4b47","#dec8c4","#f25454","silver"]
        });
    });

</script>

<!-----------------------------------second tab graph--------------------------------------->
<script>
    $(function () {
    Highcharts.chart('container4', {
        chart: {
            type: 'column',
       
        },
        
        title: {
            text: ''
        },
        xAxis: {
            categories: ['SES','SSE','SB','CAL']
        },
        yAxis: {
            min: 0,
        
       
            title: {
                text: '# of Proposals'
            },
            stackLabels: {
                enabled: true,
                style: {
                    fontWeight: 'bold',
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                }
            }
        },
        legend: {
            align: 'right',
            x: -10,
            verticalAlign: 'top',
            y: 5,
            floating: true,
            backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
            borderColor: '#CCC',
            borderWidth: 1,
            shadow: false
        },
        tooltip: {
            headerFormat: '<b>{point.x}</b><br/>',
            pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true,
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                }
            }
        },
        series: [{
            name: 'TENURED',
            color: "#05174E",
            data: <?php echo json_encode($T_PROP); ?>
        }, {
            name: 'TENURE TRACK',
             color: "#7a1f0b",
            data: <?php echo json_encode($TT_PROP); ?>
        }, {
            name: 'NON TENURE',
            color: "#7C97E6",
            data: <?php echo json_encode($NTT_PROP); ?>
        }]
    });
 
});          
  
</script>

<!------------------- second tab graph 2 ------------------------------------------>

<script>
    $(function () {
    Highcharts.chart('container5', {
        chart: {
            type: 'column'
        },
        title: {
            text: ''
        },
        xAxis: {
            categories: ['SES','SSE','SB','CAL']
        },
        yAxis: {
            min: 0,
            max: 50,
            title: {
                text: '# of Awards'
            },
            stackLabels: {
                enabled: true,
                style: {
                    fontWeight: 'bold',
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                }
            }
            
        },
        legend: {
            align: 'right',
            x: -20,
            verticalAlign: 'top',
            y: 5,
            floating: true,
            backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
            borderColor: '#CCC',
            borderWidth: 1,
            shadow: false
        },
        tooltip: {
            headerFormat: '<b>{point.x}</b><br/>',
            pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true,
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                }
            }
        },
      series: [{
            name: 'TENURED',
            color: "#05174E",
            data: <?php echo json_encode($T_AWARD); ?>
        }, {
            name: 'TENURE TRACK',
             color: "#7a1f0b",
            data: <?php echo json_encode($TT_AWARD); ?>
        }, {
            name: 'NON TENURE',
            color: "#7C97E6",
            data: <?php echo json_encode($NTT_AWARD); ?>
        }]
    });
});          
  
</script>

<!-------------------- end of second graph 2 --------------------------->


<div class="container">

        <h2>Office of Sponsored Research- Executive Reports</h2>
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home">Expenditures</a></li>
            <li><a data-toggle="tab" href="#menu1">Faculty Activity</a></li>
            <!--li><a data-toggle="tab" href="#menu2">Menu 2</a></li>
            <li><a data-toggle="tab" href="#menu3">Menu 3</a></li -->
        </ul>

        <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
                <h3>Expenditures</h3>
                <div class="row">
                    <div class="col-md-6">
                         <div class="panel panel-primary">
                            <div class="panel-heading">Comparison of Expenditures by Year from FY14-Current</div>
                        <div class="panel-body"><div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div></div>
                       </div>
                        
                    </div>
                    <div class="col-md-6">
                         <div class="panel panel-primary">
                            <div class="panel-heading">Indirect, SubContracts from FY14- Current</div>
                        <div class="panel-body"><div id="container1" style="min-width: 400px; height: 400px; margin: 0 auto"></div></div>
                       </div>
                    </div>
                     <div class="col-md-12">
                         <div class="panel panel-primary">
                            <div class="panel-heading">Expenditures from FY14- Current (Indirect, Subs, and Stevens DC)</div>
                        <div class="panel-body"><div id="container2" style="min-width: 400px; height: 600px; margin: 0 auto"></div></div>
                       </div>
                    </div>

                </div>
            </div>
            <div id="menu1" class="tab-pane fade">
               <h3>Faculty Activity</h3>
                <div class="row">
                          <div class="col-md-6">
                         <div class="panel panel-primary">
                            <div class="panel-heading">FY2017 Proposal Activity by Faculty</div>
                        <div class="panel-body"><div id="container4" style="min-width: 520px; height: 400px; margin: 0 auto"></div></div>
                       </div>
                        
                    </div>
                    <div class="col-md-6">
                         <div class="panel panel-primary">
                            <div class="panel-heading">FY2017 Award Activity by Faculty</div>
                        <div class="panel-body"><div id="container5" style="min-width: 520px; height: 400px; margin: 0 auto"></div></div>
                       </div>
                    </div>
                    
                    <!-------------------------------------- table for Faculty Activity------------------------->
                    <div class="col-md-12">
                         <div class="panel panel-primary">
                            <div class="panel-heading">Faculty Activity in 2017</div>
                            <div class="panel-body">
                                 <?php
                                      
                                         $db = new Db();

                                        $rows = $db->select("select count(CWID) as Faculty, sum(PROP) as Proposals, sum(AWARDCOUNT) as Awards, sum(AMTPROP) as Prop_Amt, sum(AWARDAMT) as Award_Amt, TENURE_STATUS, SCHOOL from FACULTY_ACTIVITY where SCHOOL not in ('Phys') and TENURE_STATUS not in ('NTT-Visiting') group by SCHOOL,TENURE_STATUS order by FIELD(SCHOOL, 'SES','SSE','SB', 'CAL'), FIELD(TENURE_STATUS, 'T','TT','NTT','NTT-Visiting')");

                                      ?>
                                     
                                      <table class="table table-bordered">
                                          <thead>
                                          <tr class='header'>

                                          <th>School</th>
                                           <th>Tenure Status</th>
                                           <th># Faculty</th>
                                          <th># of Proposals</th>
                                          <th>$ of Proposals</th>
                                          <th># of New Awards</th>
                                          <th>$ of New Awards*</th>



                                          </tr>
                                              </thead>


                                            <tbody>
                                          <tr>


                                          <?php 

                                             $counter = 0; 
                                             $count_proposals = 0;
                                             $count_awards = 0;
                                             $amt_awards = 0;
                                             $amt_proposals = 0;
                                             $count_faculty=0;

                                             $Tcount_proposals = 0;
                                             $Tcount_awards = 0;
                                             $Tamt_awards = 0;
                                             $Tamt_proposals = 0;
                                             $Tcount_faculty=0;


                                              foreach($rows as $row) {

                                                 $counter++;
                                              ?>

                                              <td>
                                                  <?php echo $row['SCHOOL'] ?>
                                              </td>
                                               <td>
                                                    <?php echo $row['TENURE_STATUS'] ?>
                                              </td>
                                               <td>
                                                    <?php echo $row['Faculty']; 
                                                   $count_faculty +=  doubleval($row['Faculty']); 

                                                            ?>
                                              </td>
                                              <td>
                                                    <?php echo $row['Proposals']; 
                                                      $count_proposals +=  doubleval($row['Proposals']);       
                                                    ?>

                                              </td>

                                              <td>
                                                    <?php echo number_format($row['Prop_Amt']); 
                                                     $amt_proposals +=  doubleval($row['Prop_Amt']);

                                                    ?>
                                              </td>

                                              <td>
                                                   <?php echo $row['Awards']; 
                                                    $count_awards +=  doubleval($row['Awards']);
                                                           ?>
                                              </td>
                                              <td>
                                                   <?php echo number_format($row['Award_Amt']);

                                                   $amt_awards +=  doubleval($row['Award_Amt']);
                                                   ?>
                                              </td>


                                          </tr>
                                              <?php
                                              if($counter%3==0  ) {

                                                  echo "<tr class='totals'><td>Totals</td><td></td><td> $count_faculty </td><td>$count_proposals</td><td>". number_format($amt_proposals) .  "</td><td>$count_awards</td><td>". number_format($amt_awards) ."</td></tr>";
                                                 $Tcount_proposals += $count_proposals;
                                                 $Tcount_faculty += $count_faculty;
                                                 $Tcount_awards += $count_awards;
                                                 $Tamt_awards += $amt_awards;
                                                 $Tamt_proposals += $amt_proposals;

                                                 $count_proposals = 0;
                                                 $count_faculty = 0;
                                                 $count_awards = 0;
                                                 $amt_awards = 0;
                                                 $amt_proposals = 0;

                                                   }

                                              } 

                                              echo "<tr class='totals'><td>Grand Total</td><td> </td><td>$Tcount_faculty </td><td>$Tcount_proposals</td><td>". number_format($Tamt_proposals). "</td><td>$Tcount_awards</td><td>" . number_format($Tamt_awards) . "</td></tr>";


                                              ?>
                                                 </tbody>

                                      </table>
                                *Includes only New Awards (excludes new $$ from continuing awards from prior years)
                                
                                
                                
                            </div></div>
                       </div>
                    </div>
                </div>
              
            </div>
           

    </div>




</div>



</body>
</html>

