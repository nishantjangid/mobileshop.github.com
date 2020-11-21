<div class="admin-container">
    <div class="productBox boxShadow">   
        <div id="chart-container1"></div>
        <div id="chart-container2"></div>

    </div>

</div>

<script src="https://code.highcharts.com/highcharts.js"></script>

<script>
var datas = <?php echo json_encode($datas) ?>;    

Highcharts.chart('chart-container1',{
    title:{
        text : 'New Product Growth, 2020',
    },
    subtitle:{
        text:'Source: Mobee Shop',
    },
    xAxis : {
        categories : ['jan','Feb','Mar','Apr','May','june','july','Aug','Oct','Sep','Nov','Dec']
    },
    yAxis:{
        title:{
            text:'Number of new Products'
        }
    },
    legend:{
        layout:'vertical',
        align:'right',
        verticalAlign:'middle'
    },
    ploatOptions:{
        series:{
            allowPointSelect:true
        }
    },
    series:[{
        name:'New Product',
        data : datas
    }],
    responsive:{
        rules:[
            {
                condition:{
                    
                },
                charOptions:{
                    legend:{
                        layout:'horizontal',
                        align:'center',
                        verticalAlign:'bottom'
                    }
                }
            }
        ]
    }
});

</script>
