
if($("#content1").css("display") == "block") {
    $("#homeIcon").css("fill", "#EC6FE4");
}

$("#homeIcon").on('click', function() {
    $("#content2, #content3, #content4, #content5, #content6, #content7").css("display", "none");
    $("#content1").css("display", "block");
    $("#homeIcon").css("fill", "#EC6FE4");
});

$("#elevIcon").on('click', function() {
    $("#content1, #content3, #content4, #content5, #content6, #content7").css("display", "none");
    $("#content2").css("display", "block");
    $("#homeIcon").css("fill", "white");
});

$("#foretagIcon").on('click', function() {
    $("#content1, #content2, #content4, #content5, #content6, #content7").css("display", "none");
    $("#content3").css("display", "block");
    $("#homeIcon").css("fill", "white");
});

$("#periodIcon").on('click', function() {
    $("#content1, #content2, #content3, #content5, #content6, #content7").css("display", "none");
    $("#content4").css("display", "block");
    $("#homeIcon").css("fill", "white");
});

$("#classIcon").on('click', function() {
    $("#content1, #content2, #content3, #content4, #content6, #content7").css("display", "none");
    $("#content5").css("display", "block");
    $("#homeIcon").css("fill", "white");
});

$("#platsIcon").on('click', function() {
    $("#content1, #content2, #content3, #content4, #content5, #content7").css("display", "none");
    $("#content6").css("display", "block");
    $("#homeIcon").css("fill", "white");
});

$(".registerPage").on('click', function() {
    $("#content1, #content2, #content3, #content4, #content5, #content6").css("display", "none");
    $("#content7").css("display", "block");
    //$("#homeIcon").css("fill", "white");
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
    if (cellValue == 'Oanmäld') {
        thisCell.css("background-color","gainsboro");
    }
 }
)

$(document).on('click','.elevTable tbody tr',function(){
    var row = $(this);
    row.css("color", "#EC6FE4");
    $(".elevTable tbody tr").not(this).css("color", "black")
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
            $(".elevNarvaro td").each( function() {
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
                if (cellValue == 'Oanmäld') {
                    thisCell.css("background-color","gainsboro");
                }
             }
            )
        }
    })
});

$(document).on('click','.foretagTable tbody tr',function(){
    var row = $(this);
    row.css("color", "#EC6FE4");
    $(".foretagTable tbody tr").not(this).css("color", "black")
    var foretag = row.find("td:first-child").text();

    $.ajax({
        url: 'foretagInfo.php',
        type: 'POST',
        data: {
            foretagID: foretag
        },

        success: function(data) {
            //alert(data);
            $('.foretagView').html(data);
            $(".foretagInfo td").each( function() {
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
                if (cellValue == 'Oanmäld') {
                    thisCell.css("background-color","gainsboro");
                }
             }
            )
        }
    })
});

/*$("#subElev").click(function(e){
    e.preventDefault();
    $.ajax({
        url: 'regElev.php',
        type: 'POST',
        data: {
            fornamn: 'fornamn',
            efternamn: 'efternamn',
            elevKlass: 'elevKlass'
        },

        success: function(data) {
            alert(data);
        }
    });
});*/

$(document).ready(function(){
    $("#elevSearch").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".elevTable tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});

$("#regElev").submit(function(e) {

    e.preventDefault(); // avoid to execute the actual submit of the form.s
    var form = $(this);
    var url = form.attr('action');
    var namn = $("#namn").val();
    var efternamn = $("#efternamn").val();
    var elevKlass = $("#elevKlass").val();
    
    $.ajax({
        type: "POST",
        url: url,
        data: {
            fornamn: namn,
            efternamn: efternamn,
            elevKlass: elevKlass
        }, // serializes the form's elements.

        success: function(data)
        {
            alert(data); // show response from the php script.
            $("#regElev")[0].reset();
        }
    });
});

$("#regKlass").submit(function(e) {

    e.preventDefault(); // avoid to execute the actual submit of the form.s
    var form = $(this);
    var url = form.attr('action');

    var klass = $("#klassNamn").val();
    
    $.ajax({
        type: "POST",
        url: url,
        data: {
            klassNamn: klass
        }, // serializes the form's elements.

        success: function(data)
        {
            alert(data); // show response from the php script.
            $("#regKlass")[0].reset();
        }
    });
});

$("#regPlats").submit(function(e) {

    e.preventDefault(); // avoid to execute the actual submit of the form.s
    var form = $(this);
    var url = form.attr('action');
    var elev = $("#platsElev").val();
    var foretag = $("#platsForetag").val();
    var period = $("#platsPeriod").val();
    
    $.ajax({
        type: "POST",
        url: url,
        data: {
            elev: elev,
            foretag: foretag,
            period: period
        }, // serializes the form's elements.

        success: function(data)
        {
            alert(data); // show response from the php script.
            $("#regPlats")[0].reset();
        }
    });
});

$(".button2").on('click', function() {
    $("#regElev").css("display", "none");
    $("#regKlass").css("display", "block");
    $(".button2").css("background-color", "#4C4C4C");
    $(".button").css("background-color", "darkgray");
});

$(".button").on('click', function() {
    $("#regKlass").css("display", "none");
    $("#regElev").css("display", "block");
    $(".button").css("background-color", "#4C4C4C");
    $(".button2").css("background-color", "darkgray");
});

if($("#regElev").css("display") == "block") {
    $(".button").css("background-color", "#4C4C4C");
}

/*$(".button").hover(function() {
    $(this).addClass("hover"); 
}, function() {
    $(this).removeClass("hover");
});*/

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