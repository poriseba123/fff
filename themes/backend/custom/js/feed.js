function update_tournament_modal() {
    $("#session_error").closest('.form-group').removeClass('has-error');
    $("#session_error").html('');
    $("#contest_list_modal").modal('show');

}


function update_tournament_list_btn() {
    $("#session_error").closest('.form-group').removeClass('has-error');
    $("#session_error").html('');
    if ($.type($('[name=type]:checked').val()) == "undefined") {
        $("#session_error").html('Please select a Type');
        $("#session_error").closest('.form-group').addClass('has-error');
        return false;
    }

    update_tournament_list();

}


function update_tournament_list() {
    ajaxindicatorstart();
    $.post(full_path + 'soccer/soccertournamentlist',
            {
                type: $('[name=type]:checked').val(),
            },
            function (resp) {

                ajaxindicatorstop();
                window.location.reload(true);

            }, 'json');
}
function view_matchlist(tid) {
    ajaxindicatorstart();
    $.post(full_path + 'soccer/tournamentmatchlist',
            {
                tid: tid,
            },
            function (resp) {

                ajaxindicatorstop();
                window.location = resp.url;

            }, 'json');
}
function view_Team_details(mid) {
    ajaxindicatorstart();
    $.post(full_path + 'soccer/matchteamdetail',
            {
                mid: mid,
            },
            function (resp) {

                ajaxindicatorstop();
                window.location = resp.url;

            }, 'json');
}
function view_playerstat(pid, type) {
    ajaxindicatorstart();
    $.post(full_path + 'soccer/soccerplayerdetail',
            {
                pid: pid,
                type: type,
            },
            function (resp) {

                ajaxindicatorstop();
                console.log(resp.stat);
                if (resp.res == 1)
                {
                    $.each(resp.stat, function (i, val) {
                        $("#val_" + i).html(val);
                    });

                    $("#player_Stat").modal('show');
                } else {

                    notifyWarning(true, true, "No Feed Update For this player", 'bottom center', 3000);

                }

            }, 'json');
}

//-----------------------END OF SOCCER---------------------------------------//


//-----------------------START OF NBA---------------------------------------//

function update_nbagame_list_btn() {
    $("#session_error").closest('.form-group').removeClass('has-error');
    $("#session_error").html('');
    if ($.type($('[name=type]:checked').val()) == "undefined") {
        $("#session_error").html('Please select a Type');
        $("#session_error").closest('.form-group').addClass('has-error');
        return false;
    }
    if ($.type($('[name=year]:checked').val()) == "undefined") {
        $("#session_error1").html('Please select a Year');
        $("#session_error1").closest('.form-group').addClass('has-error');
        return false;
    }

    update_nbagame_list();

}


function update_nbagame_list() {
    ajaxindicatorstart();
    $.post(full_path + 'nba/nbagamelist',
            {
                type: $('[name=type]:checked').val(),
                year: $('[name=year]:checked').val(),
            },
            function (resp) {

                ajaxindicatorstop();
                window.location.reload(true);

            }, 'json');
}


function view_nbateam(mid)
{
    ajaxindicatorstart();
    $.post(full_path + 'nba/matchteamdetail',
            {
                mid: mid,
            },
            function (resp) {

                ajaxindicatorstop();
                window.location = resp.url;

            }, 'json');


}


function update_nbaplayerstat(pid) {
    ajaxindicatorstart();
    $.post(full_path + 'nba/nbaplayertotalstat',
            {
                pid: pid,
            },
            function (resp) {

                ajaxindicatorstop();
                notifySuccess(true, true, "Feed Updated For this player", 'bottom center', 3000);
                console.log(resp.stat);
                //window.location.reload(true);
//                if(resp.res == 1)
//                {
//                $.each(resp.stat, function (i, val) {
//                        $("#val_" + i).html(val);
//                    });
//                    
//                    $("#player_Stat").modal('show');
//                }else{
//                    
//                    notifyWarning(true, true, "No Feed Update For this player", 'bottom center', 3000);
//                    
//                }

            }, 'json');
}

function view_nbaplayerstat(pid)
{
    ajaxindicatorstart();
    $.post(full_path + 'nba/nbaplayertotalstatview',
            {
                pid: pid,
            },
            function (resp) {

                ajaxindicatorstop();
                if (resp.tot == 0 && resp.avg == 0)
                {

                    notifyWarning(true, true, "No Data Found For this Player. You can Click on the update and check again.", 'bottom center', 3000);

                } else {

                    $("#totalstat").html('');
                    $("#totalstat").html(resp.html1);
                    $("#avgstat").html();
                    $("#avgstat").html(resp.html2);

                    $("#player_Stat").modal('show');

                }

            }, 'json');

}





//-----------------------END OF NBA---------------------------------------//



//-----------------------START FOR NCCMB---------------------------------------//

function update_ncabbtour_list_btn() {
    $("#session_error").closest('.form-group').removeClass('has-error');
    $("#session_error").html('');
    if ($.type($('[name=type]:checked').val()) == "undefined") {
        $("#session_error").html('Please select a Type');
        $("#session_error").closest('.form-group').addClass('has-error');
        return false;
    }
    if ($.type($('[name=year]:checked').val()) == "undefined") {
        $("#session_error1").html('Please select a Year');
        $("#session_error1").closest('.form-group').addClass('has-error');
        return false;
    }

    update_ncabbgame_list();

}


function update_ncabbgame_list() {
    ajaxindicatorstart();
    $.post(full_path + 'ncaamb/ncaambtournamentlist',
            {
                type: $('[name=type]:checked').val(),
                year: $('[name=year]:checked').val(),
            },
            function (resp) {

                ajaxindicatorstop();
                window.location.reload(true);

            }, 'json');
}


function view_naccmbmatches(tid) {
    ajaxindicatorstart();
    $.post(full_path + 'ncaamb/ncaambgamelist',
            {
                tid: tid,
            },
            function (resp) {

                ajaxindicatorstop();
                window.location = resp.url;

            }, 'json');
}



function view_NcaambTeam_details(mid)
{
    ajaxindicatorstart();
    $.post(full_path + 'ncaamb/matchteamdetail',
            {
                mid: mid,
            },
            function (resp) {

                ajaxindicatorstop();
                window.location = resp.url;

            }, 'json');


}


function view_ncaambplayerstat(pid)
{
    ajaxindicatorstart();
    $.post(full_path + 'ncaamb/nbaplayertotalstatview',
            {
                pid: pid,
            },
            function (resp) {

                ajaxindicatorstop();
                if (resp.tot == 0 && resp.avg == 0)
                {

                   // notifyWarning(true, true, "Feed not Updated For this player", 'bottom center', 3000);
                     notifyWarning(true, true, "No Data Found For this Player. You can Click on the update and check again.", 'bottom center', 3000);

                } else {

                    $("#totalstat").html('');
                    $("#totalstat").html(resp.html1);
                    $("#avgstat").html();
                    $("#avgstat").html(resp.html2);

                    $("#player_Stat").modal('show');

                }

            }, 'json');


}



function update_ncaambplayerstat(pid) {
    ajaxindicatorstart();
    $.post(full_path + 'ncaamb/ncaambplayertotalstat',
            {
                pid: pid,
            },
            function (resp) {

                ajaxindicatorstop();
                notifySuccess(true, true, "Feed Updated For this player", 'bottom center', 3000);
                //console.log(resp.stat);
                //window.location.reload(true);

            }, 'json');
}


//--------------------------Start For NFL------------------------//

function update_nflgame_list_btn() {
    $("#session_error").closest('.form-group').removeClass('has-error');
    $("#session_error").html('');
    if ($.type($('[name=type]:checked').val()) == "undefined") {
        $("#session_error").html('Please select a Type');
        $("#session_error").closest('.form-group').addClass('has-error');
        return false;
    }
    if ($.type($('[name=year]:checked').val()) == "undefined") {
        $("#session_error1").html('Please select a Year');
        $("#session_error1").closest('.form-group').addClass('has-error');
        return false;
    }

    update_nflgame_list();

}


function update_nflgame_list() {
    ajaxindicatorstart();
    $.post(full_path + 'nfl/nflgamelist',
            {
                type: $('[name=type]:checked').val(),
                year: $('[name=year]:checked').val(),
            },
            function (resp) {

                ajaxindicatorstop();
                window.location.reload(true);

            }, 'json');
}



function view_nflteam(mid)
{
    ajaxindicatorstart();
    $.post(full_path + 'nfl/matchteamdetail',
            {
                mid: mid,
            },
            function (resp) {

                ajaxindicatorstop();
                window.location = resp.url;

            }, 'json');


}


function update_nflplayerstat(pid) {
    ajaxindicatorstart();
    $.post(full_path + 'nfl/nflplayerstat',
            {
                pid: pid,
            },
            function (resp) {

                ajaxindicatorstop();
               notifySuccess(true, true, "Feed Updated For this player", 'bottom center', 3000);

            }, 'json');
}
function view_nflplayerstat(pid) {
    ajaxindicatorstart();
    $.post(full_path + 'nfl/nflplayertotalstatview',
            {
                pid: pid,
            },
            function (resp) {

                ajaxindicatorstop();
                if (resp.season == 0 && resp.fumble == 0 && resp.defence == 0 && resp.rushing == 0 && resp.kick == 0 && resp.receiving == 0 && resp.penalties == 0)
                {

                     notifyWarning(true, true, "No Data Found For this Player. You can Click on update and check again.", 'bottom center', 3000);

                } else {

                    $("#teamseason").html('');
                    $("#teamseason").html(resp.season_html);
                    $("#defense").html();
                    $("#defense").html(resp.defence_html);
                    $("#fumble").html();
                    $("#fumble").html(resp.fumble_html);
                    $("#rushing").html();
                    $("#rushing").html(resp.rushing_html);
                    $("#kickrturn").html();
                    $("#kickrturn").html(resp.kick_html);
                    $("#receiving").html();
                    $("#receiving").html(resp.receiving_html);
                    $("#penalties").html();
                    $("#penalties").html(resp.penalties_html);

                    $("#player_Stat").modal('show');

                }

            }, 'json');
}



//--------------------------Start For NCAAFB------------------------//

function update_ncaafbgame_list_btn() {
    $("#session_error").closest('.form-group').removeClass('has-error');
    $("#session_error").html('');
    if ($.type($('[name=type]:checked').val()) == "undefined") {
        $("#session_error").html('Please select a Type');
        $("#session_error").closest('.form-group').addClass('has-error');
        return false;
    }
    if ($.type($('[name=year]:checked').val()) == "undefined") {
        $("#session_error1").html('Please select a Year');
        $("#session_error1").closest('.form-group').addClass('has-error');
        return false;
    }

    update_ncaafbgame_list();

}



function update_ncaafbgame_list() {
    ajaxindicatorstart();
    $.post(full_path + 'ncaafb/ncaafbgamelist',
            {
                type: $('[name=type]:checked').val(),
                year: $('[name=year]:checked').val(),
            },
            function (resp) {

                ajaxindicatorstop();
                window.location.reload(true);

            }, 'json');
}


function view_ncaafbteam(mid)
{
    ajaxindicatorstart();
    $.post(full_path + 'ncaafb/matchteamdetail',
            {
                mid: mid,
            },
            function (resp) {

                ajaxindicatorstop();
                window.location = resp.url;

            }, 'json');

}



function update_stat_modal(tid)
{
    $("#session_error").closest('.form-group').removeClass('has-error');
    $("#team_id").val("");
    $("#team_id").val(tid);

    $("#session_error").html('');
    $("#contest_list_modal").modal('show');


}



function update_ncaafbpayerstat()
{
    
    $("#session_error").closest('.form-group').removeClass('has-error');
    $("#session_error").html('');
    if ($.type($('[name=type]:checked').val()) == "undefined") {
        $("#session_error").html('Please select a Type');
        $("#session_error").closest('.form-group').addClass('has-error');
        return false;
    }
    if ($.type($('[name=year]:checked').val()) == "undefined") {
        $("#session_error1").html('Please select a Year');
        $("#session_error1").closest('.form-group').addClass('has-error');
        return false;
    }

    update_ncaafbstat();
    
}


function update_ncaafbstat() {
    ajaxindicatorstart();
    $.post(full_path + 'ncaafb/ncaafbplayerstat',
            {
                type: $('[name=type]:checked').val(),
                year: $('[name=year]:checked').val(),
                tid: $('#team_id').val(),
            },
            function (resp) {

                ajaxindicatorstop();
                window.location.reload(true);

            }, 'json');
}