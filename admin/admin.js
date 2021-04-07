
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

function deletBoxE(ID) {
    document.getElementById("delet").style.visibility="visible";
    var nys = document.createElement('div');
    nys.innerHTML ="<input id='del' type='hidden' name='ID' value='"+ID+"'>";
    document.getElementById("delet").appendChild(nys);
}
function deletBoxF(ID) {
    document.getElementById("delet2").style.visibility="visible";
    var nys = document.createElement('div');
    nys.innerHTML ="<input id='del' type='hidden' name='ID' value='"+ID+"'>";
    document.getElementById("delet2").appendChild(nys);
}
function deletBoxP(ID) {
    document.getElementById("delet3").style.visibility="visible";
    var nys = document.createElement('div');
    nys.innerHTML ="<input id='del' type='hidden' name='ID' value='"+ID+"'>";
    document.getElementById("delet3").appendChild(nys);
}
function deletBoxPr(ID) {
    document.getElementById("delet4").style.visibility="visible";
    var nys = document.createElement('div');
    nys.innerHTML ="<input id='del' type='hidden' name='ID' value='"+ID+"'>";
    document.getElementById("delet4").appendChild(nys);
}
function deletBoxK(ID) {
    document.getElementById("delet5").style.visibility="visible";
    var nys = document.createElement('div');
    nys.innerHTML ="<input id='del' type='hidden' name='ID' value='"+ID+"'>";
    document.getElementById("delet5").appendChild(nys);
}

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
    var epost = $("#epost").val();
    var nummer = $("#nummer").val();
    
    $.ajax({
        type: "POST",
        url: url,
        data: {
            fornamn: namn,
            efternamn: efternamn,
            elevKlass: elevKlass,
            epost: epost,
            nummer: nummer
        }, // serializes the form's elements.

        success: function(data)
        {
            alert(data); // show response from the php script.
            $("#regElev")[0].reset();
        }
    });
});

$("#regForetag").submit(function(e) {

    e.preventDefault(); // avoid to execute the actual submit of the form.s
    var form = $(this);
    var url = form.attr('action');

    var fornamn = $("#Hfornamn").val();
    var efternamn = $("#Hefternamn").val();
    var epost = $("#Hepost").val();
    var telefon = $("#Htelefon").val();

    var namn = $("#Fnamn").val();
    var losenord = $("#losenord").val();
    var adress = $("#adress").val();
    
    $.ajax({
        type: "POST",
        url: url,
        data: {
            fornamn: fornamn,
            efternamn: efternamn,
            epost: epost,
            telefon: telefon,
            namn: namn,
            losenord: losenord,
            adress: adress
        }, // serializes the form's elements.

        success: function(data)
        {
            alert(data); // show response from the php script.
            $("#regForetag")[0].reset();
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
$("#regPeriod").submit(function(e) {

    e.preventDefault();
    
   var perio = $('#periodnamn').val();
   var start = $('#startdatum').val();
   var slut = $('#slutdatum').val();
   var subin = $('#submin').val();
   var dag = [];
   $("input[name='periodDag']:checked").each(function(){
    dag.push(this.value);
});
    
         $.ajax({
            url: 'regPeriod.php',
            type: 'POST',
            data: {
            periodnamn: perio,    
            startdatum: start,
            slutdatum: slut,
            submin: subin,
            periodDag: dag
        },
    
      success: function(data) {
      $('#dagList').html(data);
      alert(data);
         }
  });
});
$("#genPeriod").submit(function(e) {

    e.preventDefault();
    
   var perio = $('#periodnamn').val();
   var start = $('#startdatum').val();
   var slut = $('#slutdatum').val();
   var subin = $('#submin').val();
   
    
         $.ajax({
            url: 'regPeriod.php',
            type: 'POST',
            data: {
            periodnamn: perio,    
            startdatum: start,
            slutdatum: slut,
            submin: subin,
            
        },
    
      success: function(data) {
     
      alert(data);
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

$(document).ready(function(){
    var count = 0;
    $('#elevReg').on('click', function() {
        count++;
        if (count >= 1) {
            $('#elevReg').addClass('expand');
            $(".formArea").css("display", "block");
            $('#elevReg').append('<div class="exit"><svg class="exitSvg" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" viewBox="0 0 16 16"><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/></svg></div>');
        }
    });
    $(document).on('click', '.exitSvg', function() {
        $('#elevReg').removeClass('expand');
        $('.exit').children().hide();
        $('#elevReg').children('.formArea').hide();
        $('#elevReg').children('.exit').hide();
    });
});

$(document).ready(function(){
    var count = 0;
    $('#foretagReg').on('click', function() {
        count++;
        if (count == 1) {
            $('#foretagReg').addClass('expand');
            //$('#foretagReg').append($('.formArea2'));
            $(".formArea2").css("display", "block");
            $('#foretagReg').append('<div class="exit"><svg class="exitSvg" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" viewBox="0 0 16 16"><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/></svg></div>');
        } else {
            $('#foretagReg').addClass('expand');
            $('.exit').children().show();
            $('#foretagReg').children('.formArea2').show();
            $('#foretagReg').children('.exit').show();
        }
    });
    $(document).on('click', '.exitSvg', function() {
        $('#foretagReg').removeClass('expand');
        $('.exit').children().hide();
        $('#foretagReg').children('.formArea2').hide();
        $('#foretagReg').children('.exit').hide();
    });
});




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