/** Onclick function för home ikon */
$("#homeIcon").on('click', function() {
    $("#content2, #content3, #content4, #content5, #content6, #content7").css("display", "none");
    $("#content1").css("display", "block");

    /** Uppdatera dagens närvaro tabell */
    $("#narvaroIdagVy").load("narvaroIdagTable.php", function() {
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
    }).fadeIn("slow");
});

/** Onclick function för elev ikon */
$("#elevIcon").on('click', function() {
    $("#content1, #content3, #content4, #content5, #content6, #content7").css("display", "none");
    $("#content2").css("display", "block");
});

/** Onclick function för företags ikon */
$("#foretagIcon").on('click', function() {
    $("#content1, #content2, #content4, #content5, #content6, #content7").css("display", "none");
    $("#content3").css("display", "block");

    /** Uppdatera företag och handledar tabell */
    $('#foretagVy').load("foretagTable.php", function() {
        loadColor();
    }).fadeIn("slow");
    $('#handledarVy').load("handledarTable.php", function() {
        loadColor();
    }).fadeIn("slow");
});

/** Funktion för att text i tabellen ska behålla färgen när tabellen uppdateras */
function loadColor() {
    if($("#foretagSaver").html().length) {
        var selectedForetag = $("#foretagSaver").text();

        var tableRow = $(".foretagTable tbody td").filter(function() {
            return $(this).text() == selectedForetag;
        }).closest("tr");

        tableRow.css("color", "#EC6FE4");
    }

    if($("#handledarSaver").html().length) {
        var selectedForetag = $("#handledarSaver").text();

        var tableRow = $(".handledarTable tbody td").filter(function() {
            return $(this).text() == selectedForetag;
        }).closest("tr");

        tableRow.css("color", "#EC6FE4");
    }
}

/** Funktion för att ladda in alla tabeller på hemsidan */
function loadTables() {
    $('#foretagVy').load("foretagTable.php").fadeIn("slow");
    $('#handledarVy').load("handledarTable.php").fadeIn("slow");
    $('#periodVy').load("periodTable.php").fadeIn("slow");
    $('#klassVy').load("klassTable.php").fadeIn("slow");
    $('#platsVy').load("platsTable.php").fadeIn("slow");

    $("#narvaroIdagVy").load("narvaroIdagTable.php", function() {
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
    }).fadeIn("slow");
}

/** Onclick function för period ikon */
$("#periodIcon").on('click', function() {
    $("#content1, #content2, #content3, #content5, #content6, #content7").css("display", "none");
    $("#content4").css("display", "block");

    /** Uppdatera period och klass tabell */
    $('#periodVy').load("periodTable.php").fadeIn("slow");
    $('#klassVy').load("klassTable.php").fadeIn("slow");
});

/** Onclick function för plats ikon */
$("#platsIcon").on('click', function() {
    $("#content1, #content2, #content3, #content4, #content5, #content7").css("display", "none");
    $("#content6").css("display", "block");

    /** Uppdatera plats tabellen */
    $('#platsVy').load("platsTable.php").fadeIn("slow");
});

/** Onclick function för register ikon */
$("#regIcon").on('click', function() {
    $("#content1, #content2, #content3, #content4, #content5, #content6").css("display", "none");
    $("#content7").css("display", "block");
});

/** Funktion för att visa dropdown meny när man klickar en meny knapp */
function toggleMenu(event) {
    var thisCell = event.parentElement;
    var menu = thisCell.lastChild;

    if (window.getComputedStyle(menu).display === "none") {
        menu.style.display = "block";
    } else {
        menu.style.display = "none";
    }
}

/** Funktion för att skapa pop up med ett formulär för att uppdatera elev data */
function updateElev(elevID, fornamn, efternamn, klass, epost, telefon) {
    var update = document.createElement('div');
    update.className = "updateElev";
    update.id = "updateElev";
    update.innerHTML = "<form action='updateElev.php' method='POST'>\
    <input id='elevID' type='hidden' name='elevID' value='"+elevID+"'>\
    <label for='fornamn'>Förnamn</label>\
    <input id='fornamn' type='text' name='fornamn' value='"+fornamn+"' required>\
    <label for='efternamn'>Efternamn</label>\
    <input id='efternamn' type='text' name='efternamn' value='"+efternamn+"' required>\
    <label for='eKlass'>Klass</label>\
    <select id='eKlass' type='text' name='klass' required></select>\
    <label for='epost'>E-post</label>\
    <input id='epost' type='email' name='epost' value='"+epost+"' required>\
    <label for='telefon'>Telefonnummer</label>\
    <input id='telefon' type='tel' name='telefon' minlength='10' maxlength='10' value='"+telefon+"' required>\
    <button class='raderaBtn' type='submit'>Spara</button></form>";

    $(document).ready(function() {
        $('#updateElev form').append('<button type="button" class="cancelButton">Avbryt</button>');

        $(document).on('click', '.cancelButton', function() {
            $('#updateElev').remove();
        });

        $.ajax({  
            type: "GET",  
            url: "getKlass.php",  
            data: "{}",  
            success: function (data) {
                var s = '';

                var myJson = JSON.parse(data);
    
                for (var i = 0; i < myJson.length; i++) {  
                    s += '<option value="' + myJson[i].klass + '">'+ myJson[i].klass+'</option>';
                }

                $("#eKlass").html(s);
                $('#eKlass option').filter(function () { return $(this).html() == klass; }).attr('selected','selected');
            }  
        });
    });

    if($("#updateElev")[0]) {
        $("#updateElev").remove();
        document.getElementById("content2").appendChild(update);

    } else {
        document.getElementById("content2").appendChild(update);
    }
}

/** Funktion för att skapa pop up med ett formulär för att uppdatera en elev närvaro */
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
    <button class='raderaBtn' type='submit'>Spara</button></form>";

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

        $(document).ready(function() {
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

/** Funktion för att skapa pop up med ett formulär för att uppdatera elev närvaro under dagen */
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

    $(document).ready(function() {
        if(narvaro === 'Närvarande') {
            $('#elevNarvaroIdag option[value=1]').attr('selected','selected');
        }
    
        if(narvaro === 'Giltig frånvaro') {
            $('#elevNarvaroIdag option[value=2]').attr('selected','selected');
        }
    
        if(narvaro === 'Ogiltig frånvaro') {
            $('#elevNarvaroIdag option[value=3]').attr('selected','selected');
        }

        $('#updateElevNarvaroIdag form').append('<button type="button" class="cancelButton">Avbryt</button>');
    
        $(document).on('click', '.cancelButton', function() {
            $('#updateElevNarvaroIdag').remove();
        });
    });

    if($("#updateElevNarvaroIdag")[0]) {
        $("#updateElevNarvaroIdag").remove();
        document.getElementById("content1").appendChild(update);

    } else {
        document.getElementById("content1").appendChild(update);
    }
}

/** Funktion för att skapa pop up med ett formulär för att uppdatera en period */
function updatePeriod(periodID,slutdatum, startdatum) {
    var update = document.createElement('div');
    update.className = "updateElev";
    update.id = "updatePeriod";
    update.innerHTML = "<form action='updatePeriod.php' method='POST'>\
    <input id='periodID' type='hidden' name='periodID' value='"+periodID+"'>\
    <label for='Uperiodnamn'>Period namn</label>\
    <input type='text' id='Uperiodnamn' name='Uperiodnamn' placeholder='namn' value='"+periodID+"' required>\
    <label for='Ustartdatum'>Start datum</label>\
    <input type='date' id='Ustartdatum' name='Ustartdatum' value='"+startdatum+"' required>\
    <label for='Uslutdatum'>Slut datum</label>\
    <input onchange='UdagPeriod();' type='date' id='Uslutdatum' name='Uslutdatum' value='"+slutdatum+"' required>\
    <div id='UdagList'></div>\
    <button type='submit' id='Usubmin'>Spara</button></form>";

    $(document).ready(function() {
        $('#updatePeriod form').append('<button type="button" class="cancelButton">Avbryt</button>');

        $(document).on('click', '.cancelButton', function() {
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

/** Funktion för att skapa pop up med ett formulär för att uppdatera ett företag */
function updateForetag(foretagID, namn, adress) {
    var update = document.createElement('div');
    update.className = "updateForetag";
    update.id = "updateForetag";
    update.innerHTML = "<form action='updateForetag.php' method='POST'>\
    <input id='foretagID' type='hidden' name='foretagID' value='"+foretagID+"'>\
    <label for='foretagsNamn'>Företagsnamn</label>\
    <input id='foretagsNamn' type='text' name='namn' value='"+namn+"' required>\
    <label for='foretagsAdress'>Företagsadress</label>\
    <input id='foretagsAdress' type='text' name='adress' value='"+adress+"' required>\
    <button class='raderaBtn' type='submit'>Spara</button></form>";

    $(document).ready(function() {
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

/** Funktion för att skapa pop up med ett formulär för att uppdatera en handledare */
function updateHandledare(handledarID, fornamn, efternamn, foretag, epost, telefon) {
    var update = document.createElement('div');
    update.className = "updateElev";
    update.id = "updateHandledare";
    update.innerHTML = "<form action='updateHandledare.php' method='POST'>\
    <input id='handledarID' type='hidden' name='handledarID' value='"+handledarID+"'>\
    <label for='Hfornamn'>Förnamn</label>\
    <input id='Hfornamn' type='text' name='fornamn' value='"+fornamn+"' required>\
    <label for='Hefternamn'>Efternamn</label>\
    <input id='Hefternamn' type='text' name='efternamn' value='"+efternamn+"' required>\
    <label for='Hforetag'>Företag</label>\
    <select id='Hforetag' type='text' name='foretag' required></select>\
    <label for='Hepost'>E-post</label>\
    <input id='Hepost' type='email' name='epost' value='"+epost+"' required>\
    <label for='Htelefon'>Telefonnummer</label>\
    <input id='Htelefon' type='tel' name='telefon' minlength='10' maxlength='10' value='"+telefon+"' required>\
    <button class='raderaBtn' type='submit'>Spara</button></form>";

    $(document).ready(function() {
        $('#updateHandledare form').append('<button type="button" class="cancelButton">Avbryt</button>');

        $(document).on('click', '.cancelButton', function() {
            $('#updateHandledare').remove();
        });

        $.ajax({  
            type: "GET",  
            url: "getAllForetag.php",  
            data: "{}",  
            success: function (data) {
                var s = '';
    
                var myJson = JSON.parse(data);
    
                for (var i = 0; i < myJson.length; i++) {  
                    s += '<option value="' + myJson[i].foretagID + '">'+ myJson[i].namn+'</option>';
                }

                $("#Hforetag").html(s);
                $('#Hforetag option').filter(function () { return $(this).html() == foretag; }).attr('selected','selected');
            }  
        });
    });

    if($("#updateHandledare")[0]) {
        $("#updateHandledare").remove();
        document.getElementById("content3").appendChild(update);

    } else {
        document.getElementById("content3").appendChild(update);
    }
}

/** Funktion för att skapa pop up med ett formulär för att uppdatera en klass */
function updateKlass(klass) {
    var update = document.createElement('div');
    update.className = "updateForetag";
    update.id = "updateKlass";
    update.innerHTML = "<form onsubmit='return false' action='updateKlass.php' method='POST'>\
    <input id='' type='hidden' name='klass' value='"+klass+"'>\
    <label for='nyKlass'>Klass namn</label>\
    <input id='nyKlass' type='text' name='nyKlass' value='"+klass+"' required>\
    <button class='raderaBtn' type='submit'>Spara</button></form>";
    
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

/** Funktion för att skapa pop up med ett formulär för att uppdatera en plats */
function updatePlats(platsID, handledarID, periodNamn) {
    var update = document.createElement('div');
    update.className = "updateForetag";
    update.id = "updatePlats";
    update.innerHTML = "<form action='updatePlats.php' method='POST'><input id='' type='hidden' name='plats' value='"+platsID+"'>\
    <label for='platsHandledare'>Företag</label>\
    <select id='platsHandledare' type='text' name='handledare'></select>\
    <label for='platsPeriod'>Period</label>\
    <select id='platsPeriod' type='text' name='period'></select>\
    <button class='raderaBtn' type='submit'>Spara</button></form>";
    
    $(document).ready(function() {
        $('#updatePlats form').append('<button type="button" class="cancelButton">Avbryt</button>');

        $(document).on('click', '.cancelButton', function() {
            $('#updatePlats').remove();
        });

        $.ajax({  
            type: "GET",  
            url: "getForetag.php",  
            data: "{}",  
            success: function (data) {
                var s = '';
    
                var myJson = JSON.parse(data);
    
                for (var i = 0; i < myJson.length; i++) {  
                    s += '<option value="' + myJson[i].handledarID + '">'+ myJson[i].namn+' - '+myJson[i].fornamn+' '+myJson[i].efternamn +'</option>';  
                }

                $("#platsHandledare").html(s);
                $('#platsHandledare option[value='+handledarID+']').attr('selected','selected');
    
            }  
        });

        $.ajax({  
            type: "GET",  
            url: "getPeriod.php",  
            data: "{}",  
            success: function (data) {
                var s = '';
        
                var myJson = JSON.parse(data);

        
                for (var i = 0; i < myJson.length; i++) {  
                    s += '<option value="' + myJson[i].periodNamn + '">'+ myJson[i].periodNamn +'</option>';  
                }

                $("#platsPeriod").html(s);
                $('#platsPeriod option').filter(function () { return $(this).html() == periodNamn; }).prop("selected", true);
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

/** Funktion för att skapa pop up med ett formulär för att radera en klass */
function deleteKlass(klass) {
    var update = document.createElement('div');
    update.className = "deletePopUp";
    update.id = "deleteKlass";
    update.innerHTML = "<form action='deletePosts.php' method='POST'><input id='' type='hidden' name='deleteKlass' value='"+klass+"'><button class='raderaBtn' type='button' onclick='deleteKlassAjax();'>Radera</button></form>";
    
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

/** Funktion för att skapa pop up med ett formulär för att radera en handledare */
function deleteHandledare(handledarID, fornamn, efternamn) {
    var update = document.createElement('div');
    update.className = "deletePopUp";
    update.id = "deleteHandledare";
    update.innerHTML = "<form action='deletePosts.php' method='POST'><input id='' type='hidden' name='deleteHandledare' value='"+handledarID+"'><button class='raderaBtn' onclick='deleteHandledareAjax();' type='button'>Radera</button></form>";
    
    $(document).ready(function() {
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

/** Funktion för att skapa pop up med ett formulär för att radera en elev */
function deleteElev(elevID) {
    var update = document.createElement('div');
    update.className = "deletePopUp";
    update.id = "deleteElev";
    update.innerHTML = "<form action='deletePosts.php' method='POST'><input id='' type='hidden' name='deleteElev' value='"+elevID+"'><button class='raderaBtn' type='button' onclick='deleteElevAjax();'>Radera</button></form>";
    elev = elevID.split('.').join(' ');
    
    $(document).ready(function() {
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

/** Funktion för att ta bort pop ups när man klickar utan för pop up rutan */
$(document).mouseup(function(e){
    var container = $(".updateForetag, .updateElev, .deletePopUp");
 
    if(!container.is(e.target) && container.has(e.target).length === 0){
        container.remove();
    }
});

/** Funktion för att gömma dropdown meny när man klickar utan för dropdown menyn */
$(document).mouseup(function(e){
    var container = $(".elevMenu, .periodMenu, .handledarMenu, .klassMenu, .platsMenu, .foretagMenu");

    if(!container.is(e.target) && container.has(e.target).length === 0){
        container.hide();
    }
});

/** Funktion för att skapa pop up med ett formulär för att radera ett företag */
function deleteForetag(foretagID, foretagNamn) {
    var update = document.createElement('div');
    update.className = "deletePopUp";
    update.id = "deleteForetag";
    update.innerHTML = "<form id='raderaForetag' action='deletePosts.php' method='POST'><input id='' type='hidden' name='deleteForetag' value='"+foretagID+"'><button class='raderaBtn' type='button' onclick='deleteForetagAjax();'>Radera</button></form>";
    
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

/** Funktion för att skapa pop up med ett formulär för att radera en period */
function deletePeriod(periodID) {
    var update = document.createElement('div');
    update.className = "deletePopUp";
    update.id = "deletePeriod";
    update.innerHTML = "<form action='deletePosts.php' method='POST'><input id='' type='hidden' name='deletePeriod' value='"+periodID+"'><button class='raderaBtn' type='button' onclick='deletePeriodAjax();'>Radera</button></form>";
    
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

/** Funktion för att skapa pop up med ett formulär för att radera en plats */
function deletePlats(platsID, elevID) {
    var update = document.createElement('div');
    update.className = "deletePopUp";
    update.id = "deletePlats";
    update.innerHTML = "<form action='deletePosts.php' method='POST'><input id='' type='hidden' name='deletePlats' value='"+platsID+"'><button class='raderaBtn' type='button' onclick='deletePlatsAjax();'>Radera</button></form>";
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

/** Onclick funktion för alla ikoner i navigation bar, där ikonen som klickas ändrar färg */
$('.navbar svg').click(function() {
    $(this).addClass('toggle-state');
    $('.navbar svg').not(this).removeClass('toggle-state');
});

/** Onclick funktion för alla rader i elev tabellen */
$(document).on('click','.elevTable tbody tr', function() {
    var row = $(this);

    if(row.hasClass('secondRow')) {
        var prevRow = row.prev();
        console.log(prevRow);

        $(".elevTable tbody tr").not(this, prevRow).css("color", "black");
        row.css("color", "#EC6FE4");
        prevRow.css("color", "#EC6FE4");

        var fornamn = prevRow.find("td:first-child").text();
        var efternamn = prevRow.find("td:eq(1)").text();
        var elev = fornamn+'.'+efternamn

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
                })
            }
        })
    } else {
        var nextRow = row.next();
        
        $(".elevTable tbody tr").not(this, nextRow).css("color", "black");

        row.css("color", "#EC6FE4");
        nextRow.css("color", "#EC6FE4");

        var fornamn = row.find("td:first-child").text();
        var efternamn = row.find("td:eq(1)").text();
        var elev = fornamn+'.'+efternamn

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
                })
            }
        })
    }
});

/** Onclick funktion för alla rader i företags tabellen */
$(document).on('click','.foretagTable tbody tr', function() {
    var row = $(this);

    /** Ändra bara färg på texten i raden som klickades */
    row.css("color", "#EC6FE4");
    $(".foretagTable tbody tr").not(this).css("color", "black");

    /** Hämta värdet i första rutan från raden som klickades */
    var foretag = row.find("td:first-child").text();

    $("#foretagSaver").html(foretag);

    /** AJAX POST request med datan som hämtas */
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

/** Onclick funktion för alla rader i handledar tabellen */
$(document).on('click','.handledarTable tbody tr', function(){
    var row = $(this);
    row.css("color", "#EC6FE4");
    $(".handledarTable tbody tr").not(this).css("color", "black")

    var handledare = row.find("td:first-child").text();

    $("#handledarSaver").html(handledare);

    $.ajax({
        url: 'handledarInfo.php',
        type: 'POST',
        data: {
            handledarID: handledare
        },

        success: function(data) {
            $('.handledarView').html(data);
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
            })
        }
    })
});

/** Onclick funktion för viewForetag knappen, för att visa företag vy */
$("#viewForetag").on('click', function(){
    $("#handledarVy").css("visibility", "hidden");
    $("#foretagVy").css("visibility", "visible");

    $("#hText").css("display", "none");
    $("#fText").css("display", "block");

    $(".handledarView").hide();
    $(".foretagView").show();
});

/** Onclick funktion för viewHandledare knappen, för att visa handledar vy */
$("#viewHandledare").on('click', function() {
    $("#foretagVy").css("visibility", "hidden");
    $("#handledarVy").css("visibility", "visible");

    $("#fText").css("display", "none");
    $("#hText").css("display", "block");

    $(".foretagView").hide();
    $(".handledarView").show();
});

/** Sök funktion för att filtrera rader i elev tabellen */
$(document).ready(function(){
    $("#elevSearch").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".elevTable tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});

/** Submit funktion för regElev formuläret */
$("#regElev").submit(function(e) {

    /** Undvik att skicka formuläret genom själv formuläret */
    e.preventDefault();

    $('#elevKlass').blur();
    $("#klassDropdown").hide();
    $("#elevKlass").css("border-radius", "4px")
    $("#klassDropdown option").hide();

    var form = $(this);
    var url = form.attr('action');

    /** Hämtar input data från formuläret */
    var namn = $("#namn").val();
    var efternamn = $("#efternamn").val();
    var elevKlass = $("#elevKlass").val();
    var epost = $("#epost").val();
    var nummer = $("#nummer").val();
    var periodn = $("#periodN").val();
    
    /** AJAX POST request med datan som hämtas */
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
        },

        success: function(data) {
            $("#snackbar").html(data);
            if(data == "Fyll i alla fält") {
                $("#snackbar").css("background-color", "#FF6961");
            } else {
                $("#snackbar").css("background-color", "#77DD77");
            }
            snackbar();
            $("#regElev")[0].reset();

            $(function(){
                var exists = 0;
                $("#klass option").each(function() {
                    var values = $(this).val().toLowerCase();
                    var input = elevKlass.toLowerCase();
                    if(values === input) {
                        exists++;
                        console.log(exists);
                    }
                });
                if(exists == 0) {
                    var newOption = '<option value="' + elevKlass + '">'+ elevKlass +'</option>'; 
                    $("#klass").append(newOption);
                }
            });

            $(function(){
                var exists = 0;
                $("#platsKlass option").each(function() {
                    var values = $(this).val().toLowerCase();
                    var input = elevKlass.toLowerCase();
                    if(values === input) {
                        exists++;
                        console.log(exists);
                    }
                });
                if(exists == 0) {
                    var newOption = '<option value="' + elevKlass + '">'+ elevKlass +'</option>'; 
                    $("#platsKlass").append(newOption); 
                }
            });

            $(function(){
                var exists = 0;
                $("#klassDropdown option").each(function() {
                    var values = $(this).val().toLowerCase();
                    var input = elevKlass.toLowerCase();
                    if(values === input) {
                        exists++;
                        console.log(exists);
                    }
                });
                if(exists == 0) {
                    var newOption = '<option value="' + elevKlass + '">'+ elevKlass +'</option>';
                    $("#klassDropdown").append(newOption);  
                }
            });
        }
    });
});

/** Submit funktion för regForetag formuläret */
$("#regForetag").submit(function(e) {

    /** Undvik att skicka formuläret genom själv formuläret */
    e.preventDefault();

    var form = $(this);
    var url = form.attr('action');

    /** Hämtar input data från formuläret */
    var namn = $("#Fnamn").val();
    var adress = $("#adress").val();
    
    /** AJAX POST request med datan som hämtas */
    $.ajax({
        type: "POST",
        url: url,
        data: {
            namn: namn,
            adress: adress
        },

        success: function(data)
        {
            $("#snackbar").html(data);
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

/** Submit funktion för regHandledare formuläret */
$("#regHandledare").submit(function(e) {

    /** Undvik att skicka formuläret genom själv formuläret */
    e.preventDefault();

    var form = $(this);
    var url = form.attr('action');

    /** Hämtar input data från formuläret */
    var fornamn = $("#Hnamn").val();
    var efternamn = $("#Hefternamn").val();
    var epost = $("#Hepost").val();
    var telefon = $("#telefon").val();
    var losenord = $("#losenord").val();
    var foretagID = $("#foretagID").val();
    var foretagNamn = $( "#foretagID option:selected" ).text();
    
    /** AJAX POST request med datan som hämtas */
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
        },

        success: function(data) {
            msg = data.split(".")[0];
            handledarID = data.split(".")[1];

            $("#snackbar").html(msg);

            if(data == "Fyll i alla fält") {
                $("#snackbar").css("background-color", "#FF6961");
            } else if ((~data.indexOf("är redan registrerad"))) {
                $("#snackbar").css("background-color", "#FF6961");
            } else {
                $("#snackbar").css("background-color", "#77DD77");
            }

            snackbar();
            $("#regHandledare")[0].reset();

            if(handledarID !== undefined) {
                var newOption = '<option value="' + handledarID + '">'+foretagNamn+' - '+fornamn+' '+efternamn+'</option>'; 
                $("#platsHandledare").append(newOption);
            }
        }
    });
});

/** Submit funktion för regPeriod formuläret */
$("#regPeriod").submit(function(e) {

    /** Undvik att skicka formuläret genom själv formuläret */
    e.preventDefault();
    
    /** Hämtar input datan från formuläret */
    var perio = $('#periodnamn').val();
    var start = $('#startdatum').val();
    var slut = $('#slutdatum').val();
    var subin = $('#submin').val();
    var dag = [];
    
    $("input[name='periodDag']:checked").each(function(){
        dag.push(this.value);
    });
    
    /** AJAX POST request med datan som hämtas */
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

            $("#snackbar").html(data);

            if ((~data.indexOf("perioden har skapats"))) {
                $("#snackbar").css("background-color", "#77DD77");
            } else {
                $("#snackbar").css("background-color", "#FF6961");
            }

            snackbar();

            $('#dagList').empty();
            $("#regPeriod")[0].reset();

            $(function(){
                var exists = 0;
                $("#foretagPeriod option").each(function() {
                    var values = $(this).val().toLowerCase();
                    var input = perio.toLowerCase();
                    if(values === input) {
                        exists++;
                        console.log(exists);
                    }
                });
                if(exists == 0) {
                    var newOption = '<option value="' + perio + '">'+ perio +'</option>'; 
                    $("#foretagPeriod").append(newOption); 
                }
            });

            $(function(){
                var exists = 0;
                $("#platsPeriod option").each(function() {
                    var values = $(this).val().toLowerCase();
                    var input = perio.toLowerCase();
                    if(values === input) {
                        exists++;
                        console.log(exists);
                    }
                });
                if(exists == 0) {
                    var newOption = '<option value="' + perio + '">'+ perio +'</option>'; 
                    $("#platsPeriod").append(newOption); 
                }
            });
        }
    });
});

/** Submit funktion för uppdatera period formuläret */
$(document).on('submit', '#updatePeriod form', function(e) {

    /** Undvik att skicka formuläret genom själv formuläret */
    e.preventDefault();
    
    /** Hämtar input datan från formuläret */
    var perio = $('#Uperiodnamn').val();
    var start = $('#Ustartdatum').val();
    var slut = $('#Uslutdatum').val();
    var subin = $('#Usubmin').val();
    var perioID = $('#periodID').val();
    var dag = [];

    $("input[name='UperiodDag']:checked").each(function(){
        dag.push(this.value);
    });
    
    /** AJAX POST request med datan som hämtas */
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
            $("#updatePeriod").remove();
            $('#periodVy').load("periodTable.php").fadeIn("slow");
        }
    });
});

/** Submit funktion för regPlatsHand formuläret */
$("#regPlatsHand").submit(function(e) {

    /** Undvik att skicka formuläret genom själv formuläret */
    e.preventDefault();

    /** Hämtar URL från action attribute i form taggen */
    var form = $(this);
    var url = form.attr('action');

    /** Hämtar input datan från formuläret */
    var hand =$("#platsHandledare").val();
    var elev = [];

    $("input[name='elevPlats']:checked").each(function() {
        elev.push(this.value);
    });

    /** AJAX POST request med datan som hämtas */
    $.ajax({
        type: "POST",
        url: url,
        data: {
            elev: elev,
            handledare: hand
        },

        success: function(data) {
            alert(data);
            $("#regPlatsHand")[0].reset();
            $("#platsElever").empty();
        }
    });
});

/** Submit funktion för regPlats formuläret */
$("#regPlats").submit(function(e) {

    /** Undvik att skicka formuläret genom själv formuläret */
    e.preventDefault();

    /** Hämtar URL från action attribute i form taggen */
    var form = $(this);
    var url = form.attr('action');

    /** Hämtar input datan från formuläret */
    var foretag = $("#platsForetag").val();
    var period = $("#platsPeriod").val();
    var hand = $("#platsHandledare").val();
    var elev = [];

    $("input[name='elevPeriod']:checked").each(function(){
        elev.push(this.value);
    });

    /** AJAX POST request med datan som hämtas */
    $.ajax({
        type: "POST",
        url: url,
        data: {
            elev: elev,
            foretag: foretag,
            period: period,
            handledare: hand
        },

        success: function(data) {
            $("#snackbar").html(data);

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

$(document).ready(function(){
    $("#elevReg").addClass("active");
    $('.regContent').children().hide();
    $('.regContent').append($('#elevForm'));
    $("#elevForm").css("display", "block");

    /** Onclick funktion för att visa elev reg formuläret när man klickar på det alternativet i listan */
    $('#elevReg').on('click', function() {
        if($('.regMenu li div').hasClass("active")) {
            $('.regMenu li div').removeClass("active");
            $("#elevReg").addClass("active");
        }

        $('.regContent').children().hide();
        $('.regContent').append($('#elevForm'));
        $("#elevForm").css("display", "block");
    });

    /** Onclick funktion för att visa företag reg formuläret när man klickar på det alternativet i listan */
    $('#foretagReg').on('click', function() {
        if($('.regMenu li div').hasClass("active")) {
            $('.regMenu li div').removeClass("active");
            $("#foretagReg").addClass("active");
        }

        $('.regContent').children().hide();
        $('.regContent').append($('#foretagForm'));
        $("#foretagForm").css("display", "block");
    });

    /** Funktion för att uppdatera företag select options när man ska registrera handledare */
    function updateForetagSelect() {
        $.ajax({  
            type: "GET",  
            url: "getAllForetag.php",  
            data: "{}",  
            success: function (data) {
                var s = '<option disabled selected>Välj företag</option>';
    
                var myJson = JSON.parse(data);
    
                for (var i = 0; i < myJson.length; i++) {  
                    s += '<option value="' + myJson[i].foretagID + '">'+ myJson[i].namn +'</option>';  
                }

                $("#foretagID").html(s);
            }  
        });
    }

    /** Onclick funktion för att visa handledar reg formuläret när man klickar på det alternativet i listan */
    $('#handledarReg').on('click', function() {
        updateForetagSelect();

        if($('.regMenu li div').hasClass("active")) {
            $('.regMenu li div').removeClass("active");
            $("#handledarReg").addClass("active");
        }

        $('.regContent').children().hide();
        $('.regContent').append($('#handledarForm'));
        $("#handledarForm").css("display", "block");
    });

    /**
     * Onclick funktion för att visa formuläret där man kopplar elever till en period
     * när man klickar på det alternativet i listan
     */
    $('#platsDel1').on('click', function() {
        if($('.regMenu li div').hasClass("active")) {
            $('.regMenu li div').removeClass("active");
            $("#platsDel1").addClass("active");
        }

        $('.regContent').children().hide();
        $('.regContent').append($('#platsDel1Form'));
        $("#platsDel1Form").css("display", "block");
    });

    /**
     * Onclick funktion för att visa formuläret där man kopplar handledare och företag till en elev
     * när man klickar på det alternativet i listan
     */
    $('#platsDel2').on('click', function() {
        if($('.regMenu li div').hasClass("active")) {
            $('.regMenu li div').removeClass("active");
            $("#platsDel2").addClass("active");
        }

        $('.regContent').children().hide();
        $('.regContent').append($('#platsDel2Form'));
        $("#platsDel2Form").css("display", "block");
    });
    
    
    /**
     * Onclick funktion för att visa formuläret där man registrerar en period
     * Om man klickar på det alternativet i listan.
     */
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

/** Snackbar funktion som används när något registreras */
function snackbar() {
    var x = document.getElementById("snackbar");
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}

/** Visa klass dropdown när input field är fokuserad */
$(document).on('focus', '#elevKlass', function(e) {
    $("#klassDropdown").show();
    $("#klassDropdown option").show();
    $("#elevKlass").css("border-radius", "4px 4px 0px 0px");
    $("#klassDropdown").css({"padding": "0.5% 0.5%", "border": "1px solid #ccc"});
});

/**
 * Onclick funktion för klass dropdown options.
 * När man klickar på ett alternativ så sätts värdet i input fielden
 */
$(document).on('click', '#klassDropdown option', function(e) {
    var text = $(e.target).text()
    var val = $.trim(text)
    $("#elevKlass").val(val);
});

/** Funktion för att filtrera klasser i klass dropdown meny */
$(document).ready(function(){
    $("#elevKlass").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#klassDropdown option").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
        if (!$("#klassDropdown option:visible").length) {
            $("#klassDropdown").css({"padding": "0", "border": "0"});
            $("#elevKlass").css("border-radius", "4px")
        } else {
            $("#klassDropdown").css({"padding": "0.5% 0.5%", "border": "1px solid #ccc"});
            $("#elevKlass").css("border-radius", "4px 4px 0px 0px")
        }
    });
});

/** Funktion för att gömma select klass dropdown när man klickar utanför dropdown menyn */
$(document).mouseup(function(e) {
    var container = $("#elevKlass");
    var dropdown = $("#klassDropdown");

    if (!container.is(e.target) && container.has(e.target).length === 0) {
        dropdown.hide();
        container.css("border-radius", "4px")
    }
});

/** Funktion för att radera företag via AJAX request */
function deleteForetagAjax() {

    /** Filen där AJAX request skickas */
    var url = "deletePosts.php";
    /** Hämtar företagID från formuläret */
    var foretagID = $("#deleteForetag form input[type=hidden]").val();

    /** AJAX POST request med datan som hämtas */
    $.ajax({
        type: "POST",
        url: url,
        data: {
            deleteForetag: foretagID
        },
    
        success: function(data) {
            $("#deleteForetag").remove();
            $('#foretagVy').load("foretagTable.php").fadeIn("slow");

            $("#foretagID option").each(function() {
                if($(this).val() == foretagID) {
                    $(this).remove(); 
                }
            });
        }
    });
}

/** Funktion för att radera handledare via AJAX request */
function deleteHandledareAjax() {

    /** Filen där AJAX request skickas */
    var url = "deletePosts.php";
    /** Hämtar handledarID från formuläret */
    var handledarID = $("#deleteHandledare form input[type=hidden]").val();

    /** AJAX POST request med datan som hämtas */
    $.ajax({
        type: "POST",
        url: url,
        data: {
            deleteHandledare: handledarID
        }, // serializes the form's elements.
    
        success: function(data) {
            $("#deleteHandledare").remove();
            $('#handledarVy').load("handledarTable.php").fadeIn("slow");

            $("#platsHandledare option").each(function() {
                if($(this).val() == handledarID) {
                    $(this).remove(); 
                }
            });
        }
    });
}

/** Funktion för att radera klass via AJAX request */
function deleteKlassAjax() {

    /** Filen där AJAX request skickas */
    var url = "deletePosts.php";
    /** Hämtar klassID från formuläret */
    var klass = $("#deleteKlass form input[type=hidden]").val();

    /** AJAX POST request med datan som hämtas */
    $.ajax({
        type: "POST",
        url: url,
        data: {
            deleteKlass: klass
        },
    
        success: function(data) {
            $("#deleteKlass").remove();
            $('#klassVy').load("klassTable.php").fadeIn("slow");

            if($('#klass').find("option:contains('"+klass+"')").length) {
                $('#klass').find("option:contains('"+klass+"')").remove(); 
            }

            if($('#klassDropdown').find("option:contains('"+klass+"')").length) {
                $('#klassDropdown').find("option:contains('"+klass+"')").remove(); 
            }

            if($('#platsKlass').find("option:contains('"+klass+"')").length) {
                $('#platsKlass').find("option:contains('"+klass+"')").remove(); 
            }
        }
    })
}

/** Funktion för att radera period via AJAX request */
function deletePeriodAjax() {

    /** Filen där AJAX request skickas */
    var url = "deletePosts.php";
    /** Hämtar periodID från formuläret */
    var period = $("#deletePeriod form input[type=hidden]").val();

    /** AJAX POST request med datan som hämtas */
    $.ajax({
        type: "POST",
        url: url,
        data: {
            deletePeriod: period
        },
    
        success: function(data) {
            $("#deletePeriod").remove();
            $('#periodVy').load("periodTable.php").fadeIn("slow");

            if($('#platsPeriod').find("option:contains('"+period+"')").length){
                $('#platsPeriod').find("option:contains('"+period+"')").remove();
            }

            if($('#foretagPeriod').find("option:contains('"+period+"')").length){
                $('#foretagPeriod').find("option:contains('"+period+"')").remove();
            }
        }
    })
}

/** Funktion för att radera plats via AJAX request */
function deletePlatsAjax() {

    /** Filen där AJAX request skickas */
    var url = "deletePosts.php";
    /** Hämtar platsID från formuläret */
    var plats = $("#deletePlats form input[type=hidden]").val();

    /** AJAX POST request med datan som hämtas */
    $.ajax({
        type: "POST",
        url: url,
        data: {
            deletePlats: plats
        },
    
        success: function(data) {
            $("#deletePlats").remove();
            $('#platsVy').load("platsTable.php").fadeIn("slow");
        }
    })
}

/** Funktion för att radera elev via AJAX request */
function deleteElevAjax() {

    /** Filen där AJAX request skickas */
    var url = "deletePosts.php";
    /** Hämtar elevID från formuläret */
    var elevID = $("#deleteElev form input[type=hidden]").val();

    /** AJAX POST request med datan som hämtas */
    $.ajax({
        type: "POST",
        url: url,
        data: {
            deleteElev: elevID
        }, // serializes the form's elements.
    
        success: function(data) {
            $("#deleteElev").remove();
            elever();
        }
    })
}

/** Submit funktion för uppdatera plats formuläret */
$(document).on('submit', '#updatePlats form', function(e) {

    /** Undvik att skicka formuläret genom själv formuläret */
    e.preventDefault();

    /** Hämtar input datan från formuläret */
    var url = "updatePlats.php";
    var platsID = $("#updatePlats form input[type=hidden]").val();
    var handledarID = $("#platsHandledare").val();
    var periodNamn = $("#platsPeriod").val();

    /** AJAX POST request med datan som hämtas */
    $.ajax({
        type: "POST",
        url: url,
        data: {
            platsID: platsID,
            handledarID: handledarID,
            periodNamn: periodNamn
        },
    
        success: function(data) {
            $("#updatePlats").remove();
            $('#platsVy').load("platsTable.php").fadeIn("slow");
        }
    })
});

/** Submit funktion för uppdatera företag formuläret */
$(document).on('submit', '#updateForetag form', function(e) {

    /** Undvik att skicka formuläret genom själv formuläret */
    e.preventDefault();

    /** Hämtar input datan från formuläret */
    var url = "updateForetag.php";
    var foretagID = $("#updateForetag form input[type=hidden]").val();
    var foretagsNamn = $("#foretagsNamn").val();
    var foretagsAdress = $("#foretagsAdress").val();

    /** AJAX POST request med datan som hämtas */
    $.ajax({
        type: "POST",
        url: url,
        data: {
            foretagID: foretagID,
            namn: foretagsNamn,
            adress: foretagsAdress
        },
    
        success: function(data) {
            $("#updateForetag").remove();
            $('#foretagVy').load("foretagTable.php").fadeIn("slow");
        }
    })
});

/** Submit funktion för uppdatera klass formuläret */
$(document).on('submit', '#updateKlass form', function(e) {

    /** Undvik att skicka formuläret genom själv formuläret */
    e.preventDefault();

    /** Hämtar input datan från formuläret */
    var url = "updateKlass.php";
    var klass = $("#updateKlass form input[type=hidden]").val();
    var nyKlass = $("#nyKlass").val();

    /** AJAX POST request med datan som hämtas */
    $.ajax({
        type: "POST",
        url: url,
        data: {
            klass: klass,
            nyKlass: nyKlass
        },
    
        success: function(data) {
            $("#updateKlass").remove();
            $('#klassVy').load("klassTable.php").fadeIn("slow");
        }
    })
});

/** Submit funktion för uppdatera elev närvaro formuläret */
$(document).on('submit', '#updateElevNarvaro form', function(e) {

    /** Undvik att skicka formuläret genom själv formuläret */
    e.preventDefault();

    /** Hämtar input datan från formuläret */
    var url = "updateElevNarvaro.php";
    var narvaroID = $("#updateElevNarvaro form input[type=hidden]").val();
    var narvaro = $("#elevNarvaro").val();

    /** AJAX POST request med datan som hämtas */
    $.ajax({
        type: "POST",
        url: url,
        data: {
            narvaroID: narvaroID,
            narvaro: narvaro
        },
    
        success: function(data) {
            $("#updateElevNarvaro").remove();
            updateElevNarvaroView(data);
        }
    })
});

/** Submit funktion för uppdatera elev närvaron idag */
$(document).on('submit', '#updateElevNarvaroIdag form', function(e) {

    /** Undvik att skicka formuläret genom själv formuläret */
    e.preventDefault();

    /** Hämtar input datan från formuläret */
    var url = "updateElevNarvaro.php";
    var narvaroID = $("#updateElevNarvaroIdag form input[type=hidden]").val();
    var narvaro = $("#elevNarvaroIdag").val();

    /** AJAX POST request med datan som hämtas */
    $.ajax({
        type: "POST",
        url: url,
        data: {
            narvaroID: narvaroID,
            narvaro: narvaro
        },
    
        success: function(data) {
            $("#updateElevNarvaroIdag").remove();

            $("#narvaroIdagVy").load("narvaroIdagTable.php", function() {
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
            }).fadeIn("slow");

            donutChart();
        }
    })
});

/** Uppdatera elev narvaro view */
function updateElevNarvaroView(elevID) {
    $(".narvaroView").load("elevNarvaro.php", {
        elevID: elevID
    }, function() {
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
        })
    }).fadeIn("slow");
}

/** Submit funktion för att uppdatera handledare genom updateHandledare formuläret */
$(document).on('submit', '#updateHandledare form', function(e) {

    /** Undvik att skicka formuläret genom själv formuläret */
    e.preventDefault();

    /** Hämtar input datan från formuläret */
    var url = "updateHandledare.php";
    var handledarID = $("#updateHandledare form input[type=hidden]").val();
    var fornamn = $("#Hfornamn").val();
    var efternamn = $("#Hefternamn").val();
    var foretagID = $("#Hforetag").val();
    var epost = $("#Hepost").val();
    var tel = $("#Htelefon").val();

    /** AJAX POST request med datan som hämtas */
    $.ajax({
        type: "POST",
        url: url,
        data: {
            handledarID: handledarID,
            fornamn: fornamn,
            efternamn: efternamn,
            foretagID: foretagID,
            epost: epost,
            telefon: tel
        },
    
        success: function(data) {
            $("#updateHandledare").remove();
            $('#handledarVy').load("handledarTable.php").fadeIn("slow");
        }
    })
});

/** Submit funktion för att uppdatera elev data genom updateElev formuläret */
$(document).on('submit', '#updateElev form', function(e) {

    /** Undvik att skicka formuläret genom själv formuläret */
    e.preventDefault();

    /** Hämtar input datan från formuläret */
    var url = "updateElev.php";
    var elevID = $("#updateElev form input[type=hidden]").val();
    var fornamn = $("#fornamn").val();
    var efternamn = $("#efternamn").val();
    var klass = $("#eKlass").val();
    var epost = $("#epost").val();
    var tel = $("#telefon").val();
    
    /** AJAX POST request med datan som hämtas */
    $.ajax({
        type: "POST",
        url: url,
        data: {
            elevID: elevID,
            fornamn: fornamn,
            efternamn: efternamn,
            klass: klass,
            epost: epost,
            telefon: tel
        },

        success: function(data) {
            $("#updateElev").remove();
            elever();
        }
    });
});