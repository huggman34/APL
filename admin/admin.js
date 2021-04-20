
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

function toggleMenu(event) {
    var thisCell = event.parentElement;
    var menu = thisCell.lastChild;

    if (window.getComputedStyle(menu).display === "none") {
        menu.style.display = "block";
    } else {
        menu.style.display = "none";
    }
}

function updateElev(elevID, fornamn, efternamn, klass, epost, telefon) {
    var update = document.createElement('div');
    update.className = "updateElev";
    update.id = "updateElev";
    update.innerHTML = "<form action='updateElev.php' method='POST'><input id='elevID' type='hidden' name='elevID' value='"+elevID+"'><input id='' type='text' name='fornamn' value='"+fornamn+"'><input id='' type='text' name='efternamn' value='"+efternamn+"'><input id='' type='text' name='klass' value='"+klass+"'><input id='' type='text' name='epost' value='"+epost+"'><input id='' type='text' name='telefon' value='"+telefon+"'><input type='submit'></form>";

    $(document).ready(function(){
        $('#updateElev form').append('<button type="button" class="cancelButton">Avbryt</button>');

        $(document).on('click', '.cancelButton', function() {
            $('#updateElev').remove();
        });
    });

    if($("#updateElev")[0]) {
        $("#updateElev").remove();
        document.getElementById("content2").appendChild(update);

    } else {
        document.getElementById("content2").appendChild(update);
    }
}

function updateElevNarvaro(narvaroID, narvaro) {
    var update = document.createElement('div');
    update.className = "updateForetag";
    update.id = "updateElevNarvaro";
    update.innerHTML = "<form action='updateElevNarvaro.php' method='POST'>\
    <input id='narvaroID' type='hidden' name='narvaroID' value='"+narvaroID+"'>\
    <select id='elevNarvaro' type='text' name='narvaro'>\
    <option value=''>Oanmäld</option>\
    <option value='1'>Närvarande</option>\
    <option value='2'>Giltig frånvaro</option>\
    <option value='3'>Ogiltig frånvaro</option>\
    </select>\
    <input type='submit' value='Spara'></form>";

    $(document).ready(function(){
        if(narvaro === 'Närvarande') {
            $('#elevNarvaro option[value=1]').attr('selected','selected');
        }
    
        if(narvaro === 'Giltig frånvaro') {
            $('#elevNarvaro option[value=2]').attr('selected','selected');
        }
    
        if(narvaro === 'Ogiltig frånvaro') {
            $('#elevNarvaro option[value=3]').attr('selected','selected');
        }

        $(document).ready(function(){
            $('#updateElevNarvaro form').append('<button type="button" class="cancelButton">Avbryt</button>');
    
            $(document).on('click', '.cancelButton', function() {
                $('#updateElevNarvaro').remove();
            });
        });
    });

    if($("#updateElevNarvaro")[0]) {
        $("#updateElevNarvaro").remove();
        document.getElementById("content2").appendChild(update);

    } else {
        document.getElementById("content2").appendChild(update);
    }
}

function updateElevNarvaroIdag(narvaroID, narvaro) {
    var update = document.createElement('div');
    update.className = "updateForetag";
    update.id = "updateElevNarvaroIdag";
    update.innerHTML = "<form action='updateElevNarvaro.php' method='POST'>\
    <input type='hidden' name='narvaroID' value='"+narvaroID+"'>\
    <select id='elevNarvaroIdag' type='text' name='narvaro'>\
    <option value=''>Oanmäld</option>\
    <option value='1'>Närvarande</option>\
    <option value='2'>Giltig frånvaro</option>\
    <option value='3'>Ogiltig frånvaro</option>\
    </select>\
    <input type='submit' value='Spara'></form>";

    $(document).ready(function(){
        if(narvaro === 'Närvarande') {
            $('#elevNarvaroIdag option[value=1]').attr('selected','selected');
        }
    
        if(narvaro === 'Giltig frånvaro') {
            $('#elevNarvaroIdag option[value=2]').attr('selected','selected');
        }
    
        if(narvaro === 'Ogiltig frånvaro') {
            $('#elevNarvaroIdag option[value=3]').attr('selected','selected');
        }

        $(document).ready(function(){
            $('#updateElevNarvaroIdag form').append('<button type="button" class="cancelButton">Avbryt</button>');
    
            $(document).on('click', '.cancelButton', function() {
                $('#updateElevNarvaroIdag').remove();
            });
        });
    });

    if($("#updateElevNarvaroIdag")[0]) {
        $("#updateElevNarvaroIdag").remove();
        document.getElementById("content1").appendChild(update);

    } else {
        document.getElementById("content1").appendChild(update);
    }
}

function updatePeriod(periodID,slutdatum, startdatum) {
    var update = document.createElement('div');
    update.className = "updateForetag";
    update.id = "updatePeriod";
    update.innerHTML = "<input id='periodID' type='hidden' name='periodID' value='"+periodID+"'><input type='text' id='Uperiodnamn' name='Uperiodnamn' placeholder='namn' value='"+periodID+"' required><input type='date' id='Ustartdatum' name='Ustartdatum' value='"+startdatum+"' required><input onchange='UdagPeriod();' type='date' id='Uslutdatum' name='Uslutdatum' value='"+slutdatum+"' required><div id='UdagList'></div>";

    $(document).ready(function(){
        $('#updatePeriod').append('<div class="exit"><svg class="exitSvg" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" viewBox="0 0 16 16"><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/></svg></div>');

        $(document).on('click', '.exitSvg', function() {
            $('#updatePeriod').remove();
        });
    });

    if($("#updatePeriod")[0]) {
        $("#updatePeriod").remove();
        document.getElementById("content4").appendChild(update);

    } else {
        document.getElementById("content4").appendChild(update);
    }
}

function updateForetag(foretagID, namn, adress) {
    var update = document.createElement('div');
    update.className = "updateForetag";
    update.id = "updateForetag";
    update.innerHTML = "<form action='updateForetag.php' method='POST'><input id='foretagID' type='hidden' name='foretagID' value='"+foretagID+"'><input id='' type='text' name='namn' value='"+namn+"'><input id='' type='text' name='adress' value='"+adress+"'><input type='submit' value='Spara'></form>";

    $(document).ready(function(){
        $('#updateForetag form').append('<button type="button" class="cancelButton">Avbryt</button>');

        $(document).on('click', '.cancelButton', function() {
            $('#updateForetag').remove();
        });
    });

    if($("#updateForetag")[0]) {
        $("#updateForetag").remove();
        document.getElementById("content3").appendChild(update);

    } else {
        document.getElementById("content3").appendChild(update);
    }
}

function updateHandledare(handledarID, fornamn, efternamn, foretag, epost, telefon) {
    var update = document.createElement('div');
    update.className = "updateElev";
    update.id = "updateHandledare";
    update.innerHTML = "<form action='updateHandledare.php' method='POST'><input id='handledarID' type='hidden' name='handledarID' value='"+handledarID+"'><input id='' type='text' name='fornamn' value='"+fornamn+"'><input id='' type='text' name='efternamn' value='"+efternamn+"'><input id='' type='text' name='foretag' value='"+foretag+"'><input id='' type='text' name='epost' value='"+epost+"'><input id='' type='text' name='telefon' value='"+telefon+"'><input type='submit'></form>";

    $(document).ready(function(){
        $('#updateHandledare form').append('<button type="button" class="cancelButton">Avbryt</button>');

        $(document).on('click', '.cancelButton', function() {
            $('#updateHandledare').remove();
        });
    });

    if($("#updateHandledare")[0]) {
        $("#updateHandledare").remove();
        document.getElementById("content3").appendChild(update);

    } else {
        document.getElementById("content3").appendChild(update);
    }
}

function updateKlass(klass) {
    var update = document.createElement('div');
    update.className = "updateForetag";
    update.id = "updateKlass";
    update.innerHTML = "<form action='updateKlass.php' method='POST'><input id='' type='hidden' name='klass' value='"+klass+"'><input id='nyKlass' type='text' name='nyKlass' value='"+klass+"'><input type='submit'></form>";
    
    $(document).ready(function(){
        $('#updateKlass form').append('<button type="button" class="cancelButton">Avbryt</button>');

        $(document).on('click', '.cancelButton', function() {
            $('#updateKlass').remove();
        });
    });

    if($("#updateKlass")[0]) {
        $("#updateKlass").remove();
        document.getElementById("content4").appendChild(update);

    } else {
        document.getElementById("content4").appendChild(update);
    }
}

function updatePlats(platsID, handledarID, periodNamn) {
    var update = document.createElement('div');
    update.className = "updateForetag";
    update.id = "updatePlats";
    update.innerHTML = "<form action='regPlatsHand.php' method='POST'><input id='' type='hidden' name='plats' value='"+platsID+"'><select id='platsHandledare' type='text' name='handledare'></select><select id='platsPeriod' type='text' name='period'></select><input type='submit'></form>";
    
    $(document).ready(function(){
        $('#updatePlats form').append('<button type="button" class="cancelButton">Avbryt</button>');

        $(document).on('click', '.cancelButton', function() {
            $('#updatePlats').remove();
        });

        $.ajax({  
            type: "GET",  
            url: "getForetag.php",  
            data: "{}",  
            success: function (data) {
                var s = '<option disabled value="-1">Välj företag</option>';
    
                var myJson = JSON.parse(data);
    
                for (var i = 0; i < myJson.length; i++) {  
                    s += '<option value="' + myJson[i].handledarID + '">'+ myJson[i].namn+' - '+myJson[i].fornamn+' '+myJson[i].efternamn +'</option>';  
                }

                $("#platsHandledare").html(s);
                $('#platsHandledare option[value='+handledarID+']').attr('selected','selected');
    
                //alert(s);
                //console.log(myJson);
            }  
        });

        $.ajax({  
            type: "GET",  
            url: "getPeriod.php",  
            data: "{}",  
            success: function (data) {
                var s = '<option disabled value="-1">Välj period</option>';
        
                var myJson = JSON.parse(data);
        
                for (var i = 0; i < myJson.length; i++) {  
                    s += '<option value="' + myJson[i].periodNamn + '">'+ myJson[i].periodNamn +'</option>';  
                }

                $("#platsPeriod").html(s);
                $('#platsPeriod option[value='+periodNamn+']').attr('selected','selected');
            }  
        });
    });

    if($("#updatePlats")[0]) {
        $("#updatePlats").remove();
        document.getElementById("content6").appendChild(update);

    } else {
        document.getElementById("content6").appendChild(update);
    }
}

function deleteKlass(klass) {
    var update = document.createElement('div');
    update.className = "deletePopUp";
    update.id = "deleteKlass";
    update.innerHTML = "<form action='deletePosts.php' method='POST'><input id='' type='hidden' name='deleteKlass' value='"+klass+"'><input type='submit' value='Radera'></form>";
    
    $(document).ready(function(){
        $('#deleteKlass form').append('<button type="button" class="cancelButton">Avbryt</button>');
        $('.deletePopUp form').append('<h1>Vill du radera '+klass+'?</h1>');
        $('.deletePopUp form').append('<div>Alla elever som tillhör den klassen kommer att raderas.</div>');
        
        $(document).on('click', '.cancelButton', function() {
            $('#deleteKlass').remove();
        });
    });

    if($("#deleteKlass")[0]) {
        $("#deleteKlass").remove();
        document.getElementById("content4").appendChild(update);

    } else {
        document.getElementById("content4").appendChild(update);
    }
}

function deleteHandledare(handledarID, fornamn, efternamn) {
    var update = document.createElement('div');
    update.className = "deletePopUp";
    update.id = "deleteHandledare";
    update.innerHTML = "<form action='deletePosts.php' method='POST'><input id='' type='hidden' name='deleteHandledare' value='"+handledarID+"'><input type='submit' value='Radera'></form>";
    
    $(document).ready(function(){
        $('#deleteHandledare form').append('<button type="button" class="cancelButton">Avbryt</button>');
        $('.deletePopUp form').append('<h1>Vill du radera '+fornamn+' '+efternamn+'?</h1>');
        $('.deletePopUp form').append('<div>Alla platser som handledaren är kopplad till kommer att raderas.</div>');

        $(document).on('click', '.cancelButton', function() {
            $('#deleteHandledare').remove();
        });
    });

    if($("#deleteHandledare")[0]) {
        $("#deleteHandledare").remove();
        document.getElementById("content3").appendChild(update);

    } else {
        document.getElementById("content3").appendChild(update);
    }
}

function deleteElev(elevID) {
    var update = document.createElement('div');
    update.className = "deletePopUp";
    update.id = "deleteElev";
    update.innerHTML = "<form action='deletePosts.php' method='POST'><input id='' type='hidden' name='deleteElev' value='"+elevID+"'><input type='submit' value='Radera'></form>";
    elev = elevID.split('.').join(' ');
    
    $(document).ready(function(){
        $('#deleteElev form').append('<button type="button" class="cancelButton">Avbryt</button>');
        $('.deletePopUp form').append('<h1>Vill du radera '+elev+'?</h1>');
        $('.deletePopUp form').append('<div>Alla platser som tillhör '+elev+' kommer att raderas.</div>');

        $(document).on('click', '.cancelButton', function() {
            $('#deleteElev').remove();
        });
    });

    if($("#deleteElev")[0]) {
        $("#deleteElev").remove();
        document.getElementById("content2").appendChild(update);

    } else {
        document.getElementById("content2").appendChild(update);
    }
}

$(document).mouseup(function(e){
    var container = $(".updateForetag, .updateElev, .deletePopUp");
 
    // If the target of the click isn't the container
    if(!container.is(e.target) && container.has(e.target).length === 0){
        container.remove();
    }
});

$(document).mouseup(function(e){
    var container = $(".elevMenu, .periodMenu");
 
    // If the target of the click isn't the container
    if(!container.is(e.target) && container.has(e.target).length === 0){
        container.hide();
    }
});

function deleteForetag(foretagID, foretagNamn) {
    var update = document.createElement('div');
    update.className = "deletePopUp";
    update.id = "deleteForetag";
    update.innerHTML = "<form action='deletePosts.php' method='POST'><input id='' type='hidden' name='deleteForetag' value='"+foretagID+"'><input type='submit' value='Radera'></form>";
    
    $(document).ready(function(){
        $('#deleteForetag form').append('<button type="button" class="cancelButton">Avbryt</button>');
        $('.deletePopUp form').append('<h1>Vill du radera '+foretagNamn+'?</h1>');
        $('.deletePopUp form').append('<div>Alla handledare och platser som är kopplade till '+foretagNamn+' kommer att raderas.</div>');

        $(document).on('click', '.cancelButton', function() {
            $('#deleteForetag').remove();
        });
    });

    if($("#deleteForetag")[0]) {
        $("#deleteForetag").remove();
        document.getElementById("content3").appendChild(update);

    } else {
        document.getElementById("content3").appendChild(update);
    }
}

function deletePeriod(periodID) {
    var update = document.createElement('div');
    update.className = "deletePopUp";
    update.id = "deletePeriod";
    update.innerHTML = "<form action='deletePosts.php' method='POST'><input id='' type='hidden' name='deletePeriod' value='"+periodID+"'><input type='submit' value='Radera'></form>";
    
    $(document).ready(function(){
        $('#deletePeriod form').append('<button type="button" class="cancelButton">Avbryt</button>');
        $('.deletePopUp form').append('<h1>Vill du radera '+periodID+'?</h1>');
        $('.deletePopUp form').append('<div>Alla platser som tillhör den perioden kommer att raderas.</div>');

        $(document).on('click', '.cancelButton', function() {
            $('#deletePeriod').remove();
        });
    });

    if($("#deletePeriod")[0]) {
        $("#deletePeriod").remove();
        document.getElementById("content4").appendChild(update);

    } else {
        document.getElementById("content4").appendChild(update);
    }
}

function deletePlats(platsID, elevID) {
    var update = document.createElement('div');
    update.className = "deletePopUp";
    update.id = "deletePlats";
    update.innerHTML = "<form action='deletePosts.php' method='POST'><input id='' type='hidden' name='deletePlats' value='"+platsID+"'><input type='submit' value='Radera'></form>";
    elev = elevID.split('.').join(' ');
    
    $(document).ready(function(){
        $('#deletePlats form').append('<button type="button" class="cancelButton">Avbryt</button>');
        $('.deletePopUp form').append('<h1>Vill du radera '+elev+"s"+' plats?</h1>');
        $('.deletePopUp form').append('<div>All närvaro som är kopplad till platsen kommer att raderas.</div>');

        $(document).on('click', '.cancelButton', function() {
            $('#deletePlats').remove();
        });
    });

    if($("#deletePlats")[0]) {
        $("#deletePlats").remove();
        document.getElementById("content6").appendChild(update);

    } else {
        document.getElementById("content6").appendChild(update);
    }
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
function updateBP(elevID,foretagID,periodNamn,plats) {
    document.getElementById("regPl").style.visibility="visible";
    let pp = document.getElementById("pp");
    pp.value = periodNamn;
    let fp = document.getElementById("fp");
    fp.value = foretagID;
    let ep = document.getElementById("ep");
    ep.value = elevID;
    let pl = document.getElementById("pl");
    pl.value = plats;
}

function klassPlats(klass) {
    let element = document.getElementById("platsKlass");
    element.value = klass;
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
})

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

$(document).on('click','.handledarTable tbody tr',function(){
    var row = $(this);
    row.css("color", "#EC6FE4");
    $(".handledarTable tbody tr").not(this).css("color", "black")
    var handledare = row.find("td:first-child").text();

    $.ajax({
        url: 'handledarInfo.php',
        type: 'POST',
        data: {
            handledarID: handledare
        },

        success: function(data) {
            $('.foretagView').html(data);
            $(".handledarInfo td").each( function() {
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
            $("#snackbar").append(data);
            if(data == "Fyll i alla fält") {
                $("#snackbar").css("background-color", "#FF6961");
            } else {
                $("#snackbar").css("background-color", "#77DD77");
            }
            snackbar();
            $("#regElev")[0].reset();
        }
    });
});

$("#regForetag").submit(function(e) {

    e.preventDefault(); // avoid to execute the actual submit of the form.s
    var form = $(this);
    var url = form.attr('action');

    var namn = $("#Fnamn").val();
    var adress = $("#adress").val();
    
    $.ajax({
        type: "POST",
        url: url,
        data: {
            namn: namn,
            adress: adress
        }, // serializes the form's elements.

        success: function(data)
        {
            $("#snackbar").append(data);
            if(data == "Fyll i alla fält") {
                $("#snackbar").css("background-color", "#FF6961");
            } else if ((~data.indexOf("är redan registrerad"))) {
                $("#snackbar").css("background-color", "#FF6961");
            } else {
                $("#snackbar").css("background-color", "#77DD77");
            }
            snackbar();
            $("#regForetag")[0].reset();
        }
    });
});

$("#regHandledare").submit(function(e) {

    e.preventDefault(); // avoid to execute the actual submit of the form.s
    var form = $(this);
    var url = form.attr('action');

    var fornamn = $("#Hnamn").val();
    var efternamn = $("#Hefternamn").val();
    var epost = $("#Hepost").val();
    var telefon = $("#telefon").val();
    var losenord = $("#losenord").val();
    var foretagID = $("#foretagID").val();
    
    $.ajax({
        type: "POST",
        url: url,
        data: {
            fornamn: fornamn,
            efternamn: efternamn,
            epost: epost,
            telefon: telefon,
            losenord: losenord,
            foretagID: foretagID
        }, // serializes the form's elements.

        success: function(data)
        {
            $("#snackbar").append(data);

            if(data == "Fyll i alla fält") {
                $("#snackbar").css("background-color", "#FF6961");
            } else if ((~data.indexOf("är redan registrerad"))) {
                $("#snackbar").css("background-color", "#FF6961");
            } else {
                $("#snackbar").css("background-color", "#77DD77");
            }

            snackbar();
            $("#regHandledare")[0].reset();
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

            $("#snackbar").append(data);

            if ((~data.indexOf("perioden har skapats"))) {
                $("#snackbar").css("background-color", "#77DD77");
            } else {
                $("#snackbar").css("background-color", "#FF6961");
            }

            snackbar();

            $('#dagList').empty();
            $("#regPeriod")[0].reset();
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

$("#regPlatsHand").submit(function(e) {

    e.preventDefault(); // avoid to execute the actual submit of the form.s
    var form = $(this);
    var url = form.attr('action');
    var hand =$("#platsHandledare").val();
    var elev = [];
    $("input[name='elevPlats']:checked").each(function(){
     elev.push(this.value);
 });
    $.ajax({
        type: "POST",
        url: url,
        data: {
            elev: elev,
            handledare: hand
        }, // serializes the form's elements.

        success: function(data)
        {
            alert(data); // show response from the php script.
            $("#regPlatsHand")[0].reset();
        }
    });
});

$("#regPlats").submit(function(e) {

    e.preventDefault(); // avoid to execute the actual submit of the form.s
    var form = $(this);
    var url = form.attr('action');
    var foretag = $("#platsForetag").val();
    var period = $("#platsPeriod").val();
    var hand =$("#platsHandledare").val();
    var elev = [];
    $("input[name='elevPeriod']:checked").each(function(){
     elev.push(this.value);
 });
    $.ajax({
        type: "POST",
        url: url,
        data: {
            elev: elev,
            foretag: foretag,
            period: period,
            handledare: hand
        }, // serializes the form's elements.

        success: function(data)
        {
            //alert(data); // show response from the php script.
            $("#snackbar").append(data);

            if ((~data.indexOf("har lagts till"))) {
                $("#snackbar").css("background-color", "#77DD77");
            } else {
                $("#snackbar").css("background-color", "#FF6961");
            }

            snackbar();

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
    var plats = $("#pl").val();
    
    $.ajax({
        type: "POST",
        url: url,
        data: {
            elev: elev,
            handledare: foretag,
            period: period,
            plats: plats
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
    $("#elevReg").addClass("active");
    $('.regContent').children().hide();
    $('.regContent').append($('#elevForm'));
    $("#elevForm").css("display", "block");

    $('#elevReg').on('click', function() {
        if($('.regMenu li div').hasClass("active")) {
            $('.regMenu li div').removeClass("active");
            $("#elevReg").addClass("active");
        }

        $('.regContent').children().hide();
        $('.regContent').append($('#elevForm'));
        $("#elevForm").css("display", "block");
    });

    $('#foretagReg').on('click', function() {
        if($('.regMenu li div').hasClass("active")) {
            $('.regMenu li div').removeClass("active");
            $("#foretagReg").addClass("active");
        }

        $('.regContent').children().hide();
        $('.regContent').append($('#foretagForm'));
        $("#foretagForm").css("display", "block");
    });

    $('#handledarReg').on('click', function() {
        if($('.regMenu li div').hasClass("active")) {
            $('.regMenu li div').removeClass("active");
            $("#handledarReg").addClass("active");
        }

        $('.regContent').children().hide();
        $('.regContent').append($('#handledarForm'));
        $("#handledarForm").css("display", "block");
    });

    $('#platsDel1').on('click', function() {
        if($('.regMenu li div').hasClass("active")) {
            $('.regMenu li div').removeClass("active");
            $("#platsDel1").addClass("active");
        }

        $('.regContent').children().hide();
        $('.regContent').append($('#platsDel1Form'));
        $("#platsDel1Form").css("display", "block");
    });

    $('#platsDel2').on('click', function() {
        if($('.regMenu li div').hasClass("active")) {
            $('.regMenu li div').removeClass("active");
            $("#platsDel2").addClass("active");
        }

        $('.regContent').children().hide();
        $('.regContent').append($('#platsDel2Form'));
        $("#platsDel2Form").css("display", "block");
    });
    

    $('#periodReg').on('click', function() {
        if($('.regMenu li div').hasClass("active")) {
            $('.regMenu li div').removeClass("active");
            $("#periodReg").addClass("active");
        }

        $('.regContent').children().hide();
        $('.regContent').append($('#periodForm'));
        $("#periodForm").css("display", "block");
    });
});

function snackbar() {
    var x = document.getElementById("snackbar");
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);

    setTimeout(function() { 
        $("#snackbar").empty();
    }, 3010);
}

$(function(){
    $("#elevKlass").autocomplete({
        source: "autoComplete.php",
        minLength: 1,
        appendTo: "#regElev"
    });
});

/*$(document).ready(function(){
    $(function(){
        var test = localStorage.input === 'true'? true: false;
        $('input').prop('checked', test || false);
    });
    
    $('input').on('change', function() {
        localStorage.input = $(this).is(':checked');
        console.log($(this).is(':checked'));
    });
});*/

/*$(document).ready(function(){
    var count = 0;
    $('#platsReg').on('click', function() {
        count++;
        if (count == 1) {
            $('#platsReg').addClass('expand2');
            //$('#foretagReg').append($('.formArea2'));
            $(".formArea2").css("display", "block");
            $('#platsReg').append('<div class="exit"><svg class="exitSvg" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" viewBox="0 0 16 16"><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/></svg></div>');
        } else {
            $('#platsReg').addClass('expand2');
            $('.exit').children().show();
            $('#platsReg').children('.formArea2').show();
            $('#platsReg').children('.exit').show();
        }
    });
    $(document).on('click', '.exitSvg', function() {
        $('#platsReg').removeClass('expand2');
        $('.exit').children().hide();
        $('#platsReg').children('.formArea2').hide();
        $('#platsReg').children('.exit').hide();
    });
});*/

/*$(document).ready(function () {  
    $.ajax({  
        type: "GET",  
        url: "getForetag.php",  
        data: "{}",  
        success: function (data) {
            var s = '<option value="-1">Please Select a Department</option>';

            var myJson = JSON.parse(data);

            for (var i = 0; i < myJson.length; i++) {  
                s += '<option value="' + myJson[0].handledarID + '">'+ myJson[0].namn+' - '+myJson[0].fornamn+' '+myJson[0].efternamn +'</option>';  
            }
            //$(".content1").html(data);

            //alert(s);

            $("#platsHandledare").html(s);

            //console.log(myJson);
        }  
    });
});*/



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