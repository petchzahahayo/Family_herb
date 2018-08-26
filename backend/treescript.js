$(function () {
    //alert($("#type").val());
    $("#treealphabet") . change(function () {
        $("#treename_th").remove();
        if($("#treealphabet").val() !== '--เลือกตัวอักษร--') {
            $.get("get_treename.php", {treealphabet_id: $("#treealphabet").val()} )
                .done(function (data) {
                    //alert(data);
                    $("#treealphabet").after(data);
            });
        }
    });
    
});


