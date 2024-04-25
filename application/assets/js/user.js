let authority ;
let room ;
let department ;
let section_number ;
let section_name ;
let line_1_1 ;
let line_1_2 ;
let line_1_3 ;
let line_1_4 ;
let line_1_5 ;
let line_2_1 ;
let line_2_2 ;
let line_2_3 ;
let line_2_4 ;
let line_2_5 ;
let table;
let data = [];
$(document).ready(function(){
     authority = $('#authority');
     room = $('#room');
     department = $('#department');
     section_number = $('#section_number');
     section_name = $('#section_name');
     line_1_1 = $('#line_1_1');
     line_1_2 = $('#line_1_2');
     line_1_3 = $('#line_1_3');
     line_1_4 = $('#line_1_4');
     line_1_5 = $('#line_1_5');
     line_2_1 = $('#line_2_1');
     line_2_2 = $('#line_2_2');
     line_2_3 = $('#line_2_3');
     line_2_4 = $('#line_2_4');
     line_2_5 = $('#line_2_5');
     table = $('#datatable');
     load_browser();
});
function toggle_card_body(card_, caret_) {
    let card = $('#' + card_);
    let caret = $('#' + caret_);

    if (caret.hasClass("fa-caret-down")) {
        card.show();
        caret.removeClass("fa-caret-down");
        caret.addClass("fa-caret-left");
    } else {
        card.hide();
        caret.addClass("fa-caret-down");
        caret.removeClass("fa-caret-left");
    }
}





function clear_all() {
    //clear array
    data = [];
    localStorage.removeItem("json");
    update_json();
    generate_table();
}

function clear_inputs() {

    //clear these fields only if checkbox is not set
    console.log("Authority");
    console.log($('#authority_checkbox').is(':checked'));
    if($('#authority_checkbox').is(':checked') === false){
        authority.val("");
    }


    console.log("Departement");
    console.log($('#department_checkbox').is(':checked'));
    if($('#department_checkbox').is(':checked') === false){
        department.val("");
    }

    console.log("Section Number");
    console.log($('#section_number_checkbox').is(':checked'));
    if($('#section_number_checkbox').is(':checked') === false){
        section_number.val("");
    }

    console.log("Room");
    console.log($('#room_checkbox').is(':checked'));
    if($('#room_checkbox').is(':checked') === false){
        room.val("");
    }

    console.log("Section Name");
    console.log($('#section_name_checkbox').is(':checked'));
    if($('#section_name_checkbox').is(':checked') === false){
        section_name.val("");
    }








    line_1_1.val("");
    line_1_2.val("");
    line_1_3.val("");
    line_1_4.val("");
    line_1_5.val("");
    line_2_1.val("");
    line_2_2.val("");
    line_2_3.val("");
    line_2_4.val("");
    line_2_5.val("");


}

function add_data() {
       let entry = {};
    entry.authority = authority.val();
    entry.room = room.val();
    entry.department = department.val();
    entry.section_number = section_number.val();
    entry.section_name = section_name.val();
    entry.line_1_1 = line_1_1.val();
    entry.line_1_2 = line_1_2.val();
    entry.line_1_3 = line_1_3.val();
    entry.line_1_4 = line_1_4.val();
    entry.line_1_5 = line_1_5.val();
    entry.line_2_1 = line_2_1.val();
    entry.line_2_2 = line_2_2.val();
    entry.line_2_3 = line_2_3.val();
    entry.line_2_4 = line_2_4.val();
    entry.line_2_5 = line_2_5.val();

    data.push(entry)

    console.log(data);
    update_json();
    generate_table();
    clear_inputs();
}

function generate_table(){

    $('#datatable tbody').html (" ");
    for(let i = 0; i < data.length; i ++){
        let entry = data[i];
        let names = "";

        if(entry.line_1_1.length > 0){
            names += "1.1: " + entry.line_1_1 + "<br>";
        }
        if(entry.line_1_2.length > 0){
            names += "1.2: " + entry.line_1_2 + "<br>";
        }
        if(entry.line_1_3.length > 0){
            names += "1.3: " + entry.line_1_3 + "<br>";
        }
        if(entry.line_1_4.length > 0){
            names += "1.4: " + entry.line_1_4 + "<br>";
        }
        if(entry.line_1_5.length > 0){
            names += "1.5: " + entry.line_1_5 + "<br>";
        }

        if(entry.line_2_1.length > 0){
            names += "2.1: " + entry.line_2_1 + "<br>";
        }
        if(entry.line_2_2.length > 0){
            names += "2.2: " + entry.line_2_2 + "<br>";
        }
        if(entry.line_2_3.length > 0){
            names += "2.3: " + entry.line_2_3 + "<br>";
        }
        if(entry.line_2_4.length > 0){
            names += "2.4: " + entry.line_2_4 + "<br>";
        }
        if(entry.line_2_5.length > 0){
            names += "2.5: " + entry.line_2_5 + "<br>";
        }

        let department_string = entry.authority + "<br>" +
            entry.department + "<br>" +
            entry.section_number + "<br>" +
            entry.section_name + "<br>"
        ;


        let tr = "<tr id='row_index_"+i+"'>" +
            "<td>" +
            entry.room +
            "</td>" +
            "<td>" +
            department_string +
            "</td>" +
            "<td>" +
            names +
            "</td>" +
            "<td> <span class='btn' onclick='remove_entry(" + i + ")'><span class='fas fa-trash'</span></td>" +
        "</tr>";

    table.append(tr);
    }
}
function update_json(){
    let json_string = JSON.stringify(data);

    //store data in Browserstorage
    localStorage.setItem("json", json_string);

    //update textbox for export
    $('#json').val(json_string);
}
function remove_entry(entry_index){
    //remove item from array
    data.splice(entry_index, 1);

    //regenerate strings
    update_json();

    //regenerate displayed table;
    generate_table();
}



function load_browser(){
    //load json from storage
    data = JSON.parse(localStorage.getItem("json"));

    //if emtpy create empty string
    if(data === null){
        data = [];
    }

    //write string to textbox
    $('#json').val(JSON.stringify(data));

    generate_table();
}

function clear_browser(){

}