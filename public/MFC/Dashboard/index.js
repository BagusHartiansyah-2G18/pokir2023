function  _onload(){
    console.log(_); 
    chart();
}

function chart(){
    var chart = new CanvasJS.Chart("chartContainer1", {
        animationEnabled: true,
        theme: "light2",
        // title:{
        //     text: "Simple Line Chart"
        // },
        axisY:{
            includeZero: false
        },
        data: [{        
            type: "line",       
            dataPoints: [
                { y: _.uangM, indexLabel: "Total Keuangan",markerColor: "blue", markerType: "triangle" },
                { y: _.uangK, indexLabel: "Pengeluaran",markerColor: "red", markerType: "triangle" },
                { y: _.uangS, indexLabel: "Keuangan",markerColor: "yellow", markerType: "triangle" },
                // , indexLabel: "highest",markerColor: "red", markerType: "triangle" 
                // { y: 410 , indexLabel: "lowest",markerColor: "DarkSlateGrey", markerType: "cross" },
                // { y: 500 },
                // { y: 480 },
                // { y: 510 }
            ]
        }]
    });
    chart.render();


    var chart = new CanvasJS.Chart("chartContainer2", {
        animationEnabled: true,
        theme: "light2",
        // title:{
        //     text: "Simple Line Chart"
        // },
        axisY:{
            includeZero: false
        },
        data: [{        
            type: "line",       
            dataPoints: _.listBelanja
        }]
    });
    chart.render();
}