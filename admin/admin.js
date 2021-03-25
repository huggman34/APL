
if($("#content1").css("display") == "block") {
    $("#homeIcon").css("fill", "#EC6FE4");
}

$("#homeIcon").on('click', function() {
    $("#content2, #content3, #content4, #content5, #content6").css("display", "none");
    $("#content1").css("display", "block");
    $("#homeIcon").css("fill", "#EC6FE4");
});

$("#elevIcon").on('click', function() {
    $("#content1, #content3, #content4, #content5, #content6").css("display", "none");
    $("#content2").css("display", "block");
    $("#homeIcon").css("fill", "white");
});

$("#foretagIcon").on('click', function() {
    $("#content1, #content2, #content4, #content5, #content6").css("display", "none");
    $("#content3").css("display", "block");
    $("#homeIcon").css("fill", "white");
});

$("#periodIcon").on('click', function() {
    $("#content1, #content2, #content3, #content5, #content6").css("display", "none");
    $("#content4").css("display", "block");
    $("#homeIcon").css("fill", "white");
});

$("#classIcon").on('click', function() {
    $("#content1, #content2, #content3, #content4, #content6").css("display", "none");
    $("#content5").css("display", "block");
    $("#homeIcon").css("fill", "white");
});

$("#platsIcon").on('click', function() {
    $("#content1, #content2, #content3, #content4, #content5").css("display", "none");
    $("#content6").css("display", "block");
    $("#homeIcon").css("fill", "white");
});

$('.navbar svg').click(function() {
    $(this).toggleClass('toggle-state');
    $('.navbar svg').not(this).removeClass('toggle-state');
});

$(".narvaroTable td").each( function() {
    var thisCell = $(this);
    var cellValue = thisCell.text();

    if (cellValue == 'Närvarande') {
        thisCell.css("background-color","#77dd77");
    }
    if (cellValue == 'Giltig frånvaro') {
        thisCell.css("background-color","#FEFE95");
    }
    if (cellValue == 'Ogiltig frånvaro') {
        thisCell.css("background-color","#ff6961");
    }
    if (cellValue == '') {
        thisCell.css("background-color","#cfcfc4");
    }
 }
)

$(document).on('click','.elevTable tbody tr',function(){
    var row = $(this);
    row.css("background-color", "#d3d3d3");
    $(".elevTable tbody tr").not(this).css("background-color", "#ffffff")
    var elev = row.find("td:first-child").text();

    $.ajax({
        url: 'elevNarvaro.php',
        type: 'POST',
        data: {
            elevID: elev
        },

        success: function(data) {
            //alert(data);
            $('.narvaroView').html(data);
        }
    })
});

/*$('#sel').on('change', function() {
    var value = $(this).val();
    $.ajax({

        url: 'periodNarvaro.php',
        type: 'POST',
        data: {
            period: value
        },

        success: function(data) {
            alert(data);
            
        }
    });
})*/


/*$(document).ready(function(e) {
    $("[name='period']").on('change', function() {
      var url = "adminMain.php";
      $.ajax({
        type: "POST",
        url: url,
        data: $("#form").serialize(),
        success: function(data) {
          $(".tnxforate").html(data)
        }
      });
    });
});*/
	
/*$("#sel").change(function(){
    var value = $(this).val();

    $.ajax({
        type: 'POST',
        url: 'adminMain.php',
        data: {period: value}
    });
});*/

/*$('#sel').change(function() {
    this.form.submit();
});*/