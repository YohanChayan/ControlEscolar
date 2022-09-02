// const arrayMonthsLabel = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
//
// // Single line
// var ctx3 = $("#line-chart").get(0).getContext("2d");
// var myChart3 = new Chart(ctx3, {
//     type: "line",
//     data: {
//         labels: arrayMonthsLabel,
//         datasets: [{
//             label: "Tramites",
//             fill: false,
//             backgroundColor: "rgba(0, 156, 255, .3)",
//             data: [11, 8, 8, 9, 9, 9, 10, 11, 14, 14, 15, 11]
//         }]
//     },
//     options: {
//         responsive: true
//         // plugins:{
//         //     tooltip:{
//         //         callbacks:{
//         //             title: function(context){
//         //                 return ` ${arrayLabel_SingleBar[context[0].dataIndex]} `;
//         //             }
//         //         }
//         //     }
//         // }
//     },
//     scales: {
//         y:{
//             beginAtZero: true
//         }
//     }
// });
//
// // Single Bar Chart
// var ctx4 = $("#bar-chart").get(0).getContext("2d");
// var myChart4 = new Chart(ctx4, {
//     type: "bar",
//     data: {
//         labels: ["#1", "#2", "#3", "#4"],
//         datasets: [{
//             label: "Tramites",
//             backgroundColor: [
//                 "rgba(0, 156, 255, .7)",
//                 "rgba(0, 156, 255, .6)",
//                 "rgba(0, 156, 255, .5)",
//                 "rgba(0, 156, 255, .4)",
//                 "rgba(0, 156, 255, .3)"
//             ],
//             data: [55, 49, 44, 24]
//         }]
//     },
//     options: {
//         responsive: true
//         // plugins:{
//         //     tooltip:{
//         //         callbacks:{
//         //             title: function(context){
//         //                 return ` ${arrayLabel_SingleBar[context[0].dataIndex]} `;
//         //             }
//         //         }
//         //     }
//         // }
//     }
// });


            // ejemplo
            // var ctx4 = $("#bar-chart").get(0).getContext("2d");
            // var myChart4 = new Chart(ctx4, {
            //     type: "bar",
            //     data: {
            //         labels: ["#1", "#2", "#3", "#4", "#5"],
            //         // labels: arrayLabel_SingleBar,
            //         datasets: [{
            //             label: "Facturas",
            //             backgroundColor: [
            //                 "rgba(0, 156, 255, .7)",
            //                 "rgba(0, 156, 255, .6)",
            //                 "rgba(0, 156, 255, .5)",
            //                 "rgba(0, 156, 255, .4)",
            //                 "rgba(0, 156, 255, .3)"
            //             ],
            //             data: arrayData_SingleBar
            //         }]
            //     },
            //     options: {
            //         responsive: true,
            //         plugins:{
            //             tooltip:{
            //                 callbacks:{
            //                     title: function(context){
            //                         return ` ${arrayLabel_SingleBar[context[0].dataIndex]} `;
            //                     }
            //                 }
            //             }
            //         }
            //     }
            //
            // });




// Not yet
var ctx2 = $("#salse-revenue").get(0).getContext("2d");
var myChart2 = new Chart(ctx2, {
    type: "line",
    data: {
        labels: ["2010", "2017", "2018", "2019", "2020", "2021", "2022"],
        datasets: [{
                label: "Salse",
                data: [15, 30, 55, 45, 70, 65, 85],
                backgroundColor: "rgba(0, 156, 255, .5)",
                fill: true
            },
            {
                label: "Revenue",
                data: [99, 135, 170, 130, 190, 180, 270],
                backgroundColor: "rgba(0, 156, 255, .3)",
                fill: true
            }
        ]
        },
    options: {
        responsive: true
    }
});


// single line chart
