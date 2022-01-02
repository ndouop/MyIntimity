
function getRegion(id_pays){


    if (id_pays=="") {
        alert('selectionnez un pays');
    }else{
        $.get(window.baseUrl+'/get/region/'+id_pays,function(data){
            var options='';
            var block = '<div class="form-group">'
                +'<select class="form-control" name="region_id" id="region_id" onchange="getVille(this.value)">';

            if (data.length==0) {
                alert('ce pays n\'a pas de region');
            }else{

                $.each(data,function(index,value){
                    options +='<option value="'+value.id+'">'+value.nom+'</option>';
                    /* $('#region').append('<option value="'+value.id+'">'+value.nom+'</option>')*/;
                });

                console.log(options);

                block +=options+'</select>'
                    +'</div>';
                $('#block-region').empty().html(block);

                $('#block-ville').empty();
            }
        });
    }
}


function getVille(id_region){


    if (id_region=="") {
        alert(trans.getValue("select_v"));
    }else{

        $.get(window.baseUrl+'/get/ville/'+id_region,function(data){
            var options='';
            var block = '<div class="form-group">'
                +'<select class="form-control" name="ville_id" id="ville_id">';

            if (data.length==0) {
                alert(trans.getValue("reg_not_ville"));
            }else{

                $.each(data,function(index,value){
                    options +='<option value="'+value.id+'">'+value.nom+'</option>';
                    /* $('#region').append('<option value="'+value.id+'">'+value.nom+'</option>')*/;
                });

                console.log(options);

                block +=options+'</select>'
                    +'</div>';
                $('#block-ville').empty().html(block);
            }
        });
    }

}
