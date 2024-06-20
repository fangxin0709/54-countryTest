Vue.createApp({
    data() {
        return {
        }
    },
    methods: {
        btn(table,id){
            switch(table){
                case 'bus':
                $('#editBus_'+id).hide();
                $('#btnBus_'+id).hide();
                $('#delBus_'+id).show();
                $('#backBus_'+id).show();
                break;
                case 'station':
                $('#editSta_'+id).hide();
                $('#btnSta_'+id).hide();
                $('#delSta_'+id).show();
                $('#backSta_'+id).show();
                case 'form':
                $('#editForm_'+id).hide();
                $('#btnForm_'+id).hide();
                $('#delForm_'+id).show();
                $('#backForm_'+id).show();
            }
        },
        back(table,id){
            switch(table){
                case 'bus':
                $('#editBus_'+id).show();
                $('#btnBus_'+id).show();
                $('#delBus_'+id).hide();
                $('#backBus_'+id).hide();
                break;
                case 'station':
                $('#editSta_'+id).show();
                $('#btnSta_'+id).show();
                $('#delSta_'+id).hide();
                $('#backSta_'+id).hide();
                break;
                case 'form':
                $('#editForm_'+id).show();
                $('#btnForm_'+id).show();
                $('#delForm_'+id).hide();
                $('#backForm_'+id).hide();
                break;
            }
        },
        edit(table,id){
            switch(table){
                case 'bus':
                $(".modal.e1").fadeIn();
                $("#Slider").hide();
                $.getJSON('./api/get_bus.php',{table,id},(data)=>{
                    $('#busTittle').text(data.busName);
                    $('#editBus_minute').val(data.minute);
                    $('#editBusID').val(data.id);
                })
                break;
                case 'station':
                $(".modal.e2").fadeIn();
                $("#Slider").hide();
                $.getJSON('./api/get_station.php',{table,id},(data)=>{
                    $('#staTittle').text(data.stationName);
                    $('#editSta_minute').val(data.minute);
                    $('#edit_waiting').val(data.waiting);
                    $('#editStationID').val(data.id);
                })
                break;
            }   
        },
        del(table,id){
            switch(table){
                case 'bus':
                $.post('./api/del_bus.php',{table,id},()=>{
                    location.reload();
                })
                break;
                case 'station':
                $.post('./api/del_station.php',{table,id},()=>{
                    location.reload();
                })
                break;
                case 'form':
                $.post('./api/del_form.php',{table,id},()=>{
                    location.reload();
                })
                break;
            }
        },
    }
}).mount("#app");