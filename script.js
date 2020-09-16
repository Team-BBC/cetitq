$(document).ready(function (){
    $('.editbtn').on('click', function (){
        $('#actualizarModal').modal('show');

        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function(){
            return $(this).text();
        }).get();
        console.log(data);
        $('#sustancia').val(data[1]);
    })
})



$(document).ready(function (){
    $('.deletebtn').on('click', function (){
        $('#deleteModal').modal('show');
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();
        $('#id').val(data[0]);
        $('#txt').text(data[1]);
        
    })
})

