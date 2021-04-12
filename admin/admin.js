
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

function updateElev(elevID, fornamn, efternamn, klass, epost, telefon) {
    var update = document.createElement('div');
    update.className = "updateElev";
    update.innerHTML = "<form action='updateElev.php' method='POST'><input id='elevID' type='hidden' name='elevID' value='"+elevID+"'><input id='' type='text' name='fornamn' value='"+fornamn+"'><input id='' type='text' name='efternamn' value='"+efternamn+"'><input id='' type='text' name='klass' value='"+klass+"'><input id='' type='text' name='epost' value='"+epost+"'><input id='' type='text' name='telefon' value='"+telefon+"'><input type='submit'></form>";
    document.getElementById("content2").appendChild(update);
}

function updatePeriod(periodID,slutdatum, startdatum) {
    var update = document.createElement('div');
    update.innerHTML = "<input id='periodID' type='hidden' name='periodID' value='"+periodID+"'><input type='text' id='Uperiodnamn' name='Uperiodnamn' placeholder='namn' value='"+periodID+"' required><input type='date' id='Ustartdatum' name='Ustartdatum' value='"+startdatum+"' required><input onchange='UdagPeriod();' type='date' id='Uslutdatum' name='Uslutdatum' value='"+slutdatum+"' required><div id='UdagList'></div>";
    document.getElementById("uppDiv").appendChild(update);
}

function updateForetag(foretagID, namn, adress) {
    var update = document.createElement('div');
    update.className = "updateForetag";
    update.innerHTML = "<form action='updateForetag.php' method='POST'><input id='foretagID' type='hidden' name='foretagID' value='"+foretagID+"'><input id='' type='text' name='namn' value='"+namn+"'><input id='' type='text' name='adress' value='"+adress+"'><input type='submit'></form>";
    document.getElementById("content3").appendChild(update);
}

function updateKlass(klass) {
    var update = document.createElement('div');
    update.className = "updateForetag";
    update.innerHTML = "<form action='updateKlass.php' method='POST'><input id='foretagID' type='hidden' name='klass' value='"+klass+"'><input id='' type='text' name='nyKlass'><input type='submit'></form>";
    document.getElementById("content5").appendChild(update);
}

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
function deletBoxH(ID) {
    document.getElementById("delet6").style.visibility="visible";
    var nys = document.createElement('div');
    nys.innerHTML ="<input id='del' type='hidden' name='ID' value='"+ID+"'>";
    document.getElementById("delet6").appendChild(nys);
}
function updateBP(elevID,foretagID,periodNamn) {
    document.getElementById("regPl").style.visibility="visible";
    let pp = document.getElementById("pp");
    pp.value = periodNamn;
    let fp = document.getElementById("fp");
    fp.value = foretagID;
    let ep = document.getElementById("ep");
    ep.value = elevID;
}

function klassPlats() {
    let element = document.getElementById("platsKlass");
    element.value = document.getElementById("platsKlass").value;
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
    /*$("#update").append('<button id="updateElev" value="'+elev+'">Update</button>');

        var updateView = document.createElement('div');
        updateView.className = "updateview";

        updateView.innerhtml = "<form><input id='elevID' type='hidden' name='elevID' value='"+elev+"'><input id='' type='text' name='fornamn'><input id='' type='text' name='efternamn'></form>";
        document.getElementById("content2").appendChild(updateView);
        */
    

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
            //$('.foretagView').html(data);
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

$("#viewForetag").on('click', function(){
    $("#handledarVy").css("display", "none");
    $("#foretagVy").css("display", "block");
});

$("#viewHandledare").on('click', function(){
    $("#foretagVy").css("display", "none");
    $("#handledarVy").css("display", "block");
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
    var periodn = $("#periodN").val();
    
    $.ajax({
        type: "POST",
        url: url,
        data: {
            fornamn: namn,
            efternamn: efternamn,
            elevKlass: elevKlass,
            epost: epost,
            nummer: nummer,
            periodN: periodn
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

$("#updatePeriod").submit(function(e) {

    e.preventDefault();
    
   var perio = $('#Uperiodnamn').val();
   var start = $('#Ustartdatum').val();
   var slut = $('#Uslutdatum').val();
   var subin = $('#Usubmin').val();
   var perioID = $('#periodID').val();
   var dag = [];
   $("input[name='UperiodDag']:checked").each(function(){
    dag.push(this.value);
});
    
         $.ajax({
            url: 'updatePeriod.php',
            type: 'POST',
            data: {
            periodnamn: perio,    
            startdatum: start,
            slutdatum: slut,
            submin: subin,
            periodDag: dag,
            periodID: perioID
        },
    
      success: function(data) {
      $('#UdagList').html(data);
      alert(data);
         }
  });
});

$("#regPlats").submit(function(e) {

    e.preventDefault(); // avoid to execute the actual submit of the form.s
    var form = $(this);
    var url = form.attr('action');
    var foretag = $("#platsForetag").val();
    var period = $("#platsPeriod").val();
    var elev = [];
    $("input[name='elevPlats']:checked").each(function(){
     elev.push(this.value);
 });
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

$("#regPl").submit(function(e) {

    e.preventDefault(); // avoid to execute the actual submit of the form.s
    var form = $(this);
    var url = form.attr('action');
    var elev = $("#ep").val();
    var foretag = $("#fp").val();
    var period = $("#pp").val();
    
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
            $("#regPl")[0].reset();
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