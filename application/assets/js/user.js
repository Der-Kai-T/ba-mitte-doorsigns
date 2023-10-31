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


let data = [];


function clear_all() {
    $('#json').val("");
}

function clear_inputs() {


    authority.val("");
    room.val("");
    department.val("");
    section_number.val("");
    section_name.val("");
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

    $('#json').val(JSON.stringify(data));
    console.log(data);
    clear_inputs();
}

function safe_browser(){
    localStorage.setItem("json", JSON.stringify(data));
    console.log(localStorage.getItem("json"));
}

function load_browser(){
    data = JSON.parse(localStorage.getItem("json"));
    $('#json').val(JSON.stringify(data));
}

function clear_browser(){
    localStorage.removeItem("json");
}