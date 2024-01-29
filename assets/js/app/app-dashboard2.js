define([
    "jQuery",
	"bootstrap", 
    "highcharts3d",
    "datatables",
    "datatablesBootstrap",
    "bootstrapDatepicker",
    "select2",
    "toastr",
	], function (
    $,
	bootstrap, 
    highcharts3d,
    datatables,
    datatablesBootstrap,
    bootstrapDatepicker,
    select2,
    toastr,
	) {
    return {  
        table:null,
        init: function () { 
        	App.initFunc(); 
            App.initEvent(); 
            App.initData();
            App.initTable();
            console.log("LOADED");
            $(".loadingpage").hide();
         
            
		}, 
        initEvent : function(){   
            

        },
        initData : function(){

            //grafik pendapatan
            $.ajax({
                url : App.baseUrl+"dashboard/grafikPendapatan",
                type : "GET",
                success : function(data) {
                    var data = JSON.parse(data);
                    App.grafikPendapatan(data.grafik, data.tahun);
                },
                error : function(data) {
                    // do something
                }
            });

            $.ajax({
                url : App.baseUrl+"dashboard/grafikPendapatanPerTahun",
                type : "GET",
                success : function(data) {
                    var data = JSON.parse(data);
                    App.grafikPendapatanPerTahun(data.grafik);
                },
                error : function(data) {
                    // do something
                }
            });

            $.ajax({
                url : App.baseUrl+"dashboard/grafikTravel",
                type : "GET",
                success : function(data) {
                    var data = JSON.parse(data);
                    App.grafikTravel(data.grafik);
                    console.log('data', data)
                },
                error : function(data) {
                    // do something
                }
            });

        },
        initTable : function(){   
            App.table = $('#table').DataTable({
                "language": {
                    "search": "Cari",
                    "lengthMenu": "Lihat _MENU_ data",
                    "zeroRecords": "Tidak ada data yang cocok ditemukan",
                    "info": "Menampilkan _START_ hingga _END_ dari _TOTAL_ data",
                    "infoEmpty": "Tidak ada data di dalam tabel",
                    "infoFiltered": "(cari dari _MAX_ total catatan)",
                    "loadingRecords": "Loading...",
                    "processing": "Processing...",
                    "paginate": {
                        "first":      "Pertama",
                        "last":       "Terakhir",
                        "next":       "Selanjutnya",
                        "previous":   "Sebelumnya"
                    },
                },
                "order": [[ 0, "asc" ]], //agar kolom id default di order secara desc
                "processing": true,
                "serverSide": true,
                "ajax":{
                    "url": App.baseUrl+"dashboard/dataList",
                    "dataType": "json",
                    "type": "POST",
                },
                "columns": [
                    { "data": "nomor" },
                    { "data": "barang_name" },
                    { "data": "total" },
                ]
            });

        },
        
        grafikPendapatan : function(data, tahun) {
            var grafikArray = Object.values(data);


            // Accessing total_pendapatan array for each month
            var totalPendapatanArray = grafikArray.map(function (item) {
                return parseInt(item.total_pendapatan);
            });
            var totalPengeluaranArray = grafikArray.map(function (item) {
                return parseInt(item.total_pengeluaran);
            });

            Highcharts.chart('container-grafik-pendapatan', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Pendapatan Kotor Perbulan'
                },
                subtitle: {
                    text: 'SKIA'
                },

                xAxis: {
                    categories: [
                        'Januari',
                        'Februari',
                        'Maret',
                        'April',
                        'Mei',
                        'Juni',
                        'Juli',
                        'Agustus',
                        'September',
                        'Oktober',
                        'November',
                        'Desember'
                    ],
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Jumlah Pendapatan Kotor'
                    }
                },
                plotOptions: {
                    series: {
                        allowPointSelect: true
                    }
                },
            
                tooltip: {
                    headerFormat: '<b>{series.name}</b><br />',
                    pointFormat: 'Pendapatan = {point.y}'
                },
            
                series: [{
                    name: tahun,
                    data: totalPendapatanArray,
                    pointStart: 0,
                }]
            });

            Highcharts.chart('container-grafik-pengeluaran', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Pendapatan Kotor Perbulan'
                },
                subtitle: {
                    text: 'SKIA'
                },

                xAxis: {
                    categories: [
                        'Januari',
                        'Februari',
                        'Maret',
                        'April',
                        'Mei',
                        'Juni',
                        'Juli',
                        'Agustus',
                        'September',
                        'Oktober',
                        'November',
                        'Desember'
                    ],
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Jumlah Pendapatan Kotor'
                    }
                },
                plotOptions: {
                    series: {
                        allowPointSelect: true
                    }
                },
            
                tooltip: {
                    headerFormat: '<b>{series.name}</b><br />',
                    pointFormat: 'Pendapatan = {point.y}'
                },
            
                series: [{
                    name: new Date().getFullYear(),
                    data: totalPengeluaranArray,
                    pointStart: 0,
                }]
            });
        },

        grafikPendapatanPerTahun: function(data) {
            // Assuming data.grafik is an object with years as keys
            var years = Object.keys(data);
        
            // Convert data into an array
            var grafikArray = Object.values(data);
        
            // Accessing total_pendapatan array for each year
            var totalPendapatanArray = grafikArray.map(function(item) {
                return parseInt(item.total_pendapatan);
            });
        
            Highcharts.chart('container-grafik-pendapatan-pertahun', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Pendapatan Kotor Pertahun'
                },
                subtitle: {
                    text: 'SKIA'
                },
        
                xAxis: {
                    categories: years, // Use years as categories
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Jumlah Pendapatan Kotor'
                    }
                },
                plotOptions: {
                    series: {
                        allowPointSelect: true
                    }
                },
        
                tooltip: {
                    headerFormat: '<b>{series.name}</b><br />',
                    pointFormat: 'Pendapatan = {point.y}'
                },
        
                series: [{
                    name: 'Pendapatan', // You can customize the series name
                    data: totalPendapatanArray,
                    pointStart: 0
                }]
            });
        },

        grafikTravel: function(data) {
            // Assuming data.grafik is an object with travel_id as keys
            var travelData = data;
        
            // Get unique travel_id values from the data
            var travelIds = Object.keys(travelData);
        
            // Create an array to store series data
            var seriesData = [];
        
            // Loop through each travel_id
            travelIds.forEach(function (travelId) {
                var travelInfo = travelData[travelId];
                travelInfo = Object.values(travelInfo);

                console.log(travelInfo);
        
                // Accessing total_pendapatan array for each travel_id
                var totalPendapatanArray = travelInfo.map(function (item) {
                    return parseInt(item.transaction_count);
                });
        
                // Create a series object for each travel_id
                var seriesObject = {
                    name: travelId,
                    data: totalPendapatanArray,
                    pointStart: 0,
                };
        
                // Push the series object to the array
                seriesData.push(seriesObject);
            });
        
            Highcharts.chart('container-grafik-travel', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Pendapatan Travel Perbulan'
                },
                subtitle: {
                    text: 'SKIA'
                },
        
                xAxis: {
                    categories: [
                        'Januari',
                        'Februari',
                        'Maret',
                        'April',
                        'Mei',
                        'Juni',
                        'Juli',
                        'Agustus',
                        'September',
                        'Oktober',
                        'November',
                        'Desember'
                    ],
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Jumlah Pendapatan Kotor'
                    }
                },
                plotOptions: {
                    series: {
                        allowPointSelect: true
                    }
                },
        
                tooltip: {
                    headerFormat: '<b>{series.name}</b><br />',
                    pointFormat: 'Pendapatan = {point.y}'
                },
        
                // Use the seriesData array to populate the series
                series: seriesData
            });
        },
        
        
	}
});