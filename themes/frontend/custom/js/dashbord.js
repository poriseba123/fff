$(document).ready(function () {
    $(".padding-holder").niceScroll({touchbehavior: false, cursorcolor: "#CE0031", cursoropacitymax: 0.7, cursorwidth: 5, background: "#666666", cursorborder: "none", cursorborderradius: "5px", autohidemode: false});
    $(window).scroll(function () {
        $(".padding-holder").getNiceScroll().resize();
    });
    $(window).resize(function () {
        $(".padding-holder").getNiceScroll().resize();
    });
    var nicesx = $(".field-scroll").niceScroll(".field-scroll div", {touchbehavior: true, cursorcolor: "#FF00FF", cursoropacitymax: 0.6, cursorwidth: 24, usetransition: true, hwacceleration: true, autohidemode: "hidden"});
    $(window).scroll(function () {
        $(".field-scroll").getNiceScroll().resize();
    });
    $(window).resize(function () {
        $(".field-scroll").getNiceScroll().resize();
    });
});

openTabView = function (event) {
    var selector = $('#' + event.id);

    var loadMoreSelector = $('#allanalysisLoadMorebtn');

    var dataType = selector.attr("data-tabType");
    loader_start();
    $('.analysisDataLisitingContainer').html('');
    var url = full_path + "dashboard/loadanalysisdata";
    $.post(url,
            {
                dataType: dataType
            },
            function (resp) {
                loader_stop();
                $('#' + dataType + "_listing_container").html(resp.htmlData);

                loadMoreSelector.attr('data-type', dataType);
                loadMoreSelector.attr('data-limit', resp.listingLimit);
                loadMoreSelector.attr('data-nextOffset', resp.listingLimit);
                loadMoreSelector.attr('data-totalrec', resp.totalAnalysisRecord);

                if (resp.totalAnalysisRecord > resp.listingLimit) {
                    loadMoreSelector.removeClass("noDisplay");
                } else {
                    if (!loadMoreSelector.hasClass("noDisplay")) {
                        loadMoreSelector.addClass("noDisplay");
                    }
                }
            }, 'json');
};

analysisLike = function (event) {
    var selector = $("#" + event.id);

    var analysisId = selector.attr("data-id");
    var analysisVsId = selector.attr("data-vsId");

    var url = full_path + "dashboard/analysislike";

    $.post(url,
            {
                analysisId: analysisId,
                analysisVsId: analysisVsId
            },
            function (resp) {

                if (resp.flag == true) {
                    if (!selector.hasClass('user_like')) {
                        selector.addClass('user_like');
                    }
                    if (!$('#analysis_listing_container').find("#analysisVsLike_" + analysisId).hasClass('user_like')) {
                        $('#analysis_listing_container').find("#analysisVsLike_" + analysisId).addClass('user_like');
                    }
                } else {
                    if (selector.hasClass('user_like')) {
                        selector.removeClass('user_like');
                    }
                    if ($('#analysis_listing_container').find("#analysisVsLike_" + analysisId).hasClass('user_like')) {
                        $('#analysis_listing_container').find("#analysisVsLike_" + analysisId).removeClass('user_like');
                    }
                }
                selector.find('#' + event.id + '_count').html(resp.totalLike);
                $('#analysis_listing_container').find("#analysisVsLike_" + analysisId + "_count").html(resp.totalLike);
            }, 'json');
};

commentLike = function (event) {
    var selector = $("#" + event.id);

    var commentId = selector.attr("data-id");

    var url = full_path + "dashboard/analysiscommentlike";

    $.post(url,
            {
                commentId: commentId
            },
            function (resp) {

                if (resp.flag == true) {
                    if (!selector.hasClass('user_like')) {
                        selector.addClass('user_like');
                    }
                } else {
                    if (selector.hasClass('user_like')) {
                        selector.removeClass('user_like');
                    }
                }
                selector.find('#' + event.id + '_count').html(resp.totalLike);
            }, 'json');
};

openCommentModal = function (event) {
    var selector = $('#' + event.id);

    if ($('#commentloader').hasClass("noDisplay")) {
        $('#commentloader').removeClass("noDisplay");
    }
    if (!$('#notFountComment').hasClass("noDisplay")) {
        $('#notFountComment').addClass("noDisplay");
    }
    if (!$('#commentcontentbox').hasClass("noDisplay")) {
        $('#commentcontentbox').addClass("noDisplay");
    }

    $('#useranalysisComment').val('');
    $('#newCommentsContentUl').html("");
    var analysisId = selector.attr("data-id");
    $('#commentAnalysisId').val(analysisId);
    $('#CommentsModal').modal();
    var url = full_path + "dashboard/getallcomments";
    $.post(url,
            {
                analysisId: analysisId
            },
            function (resp) {
                $('#commentloader').addClass("noDisplay");
                if (resp.totalComment == 0) {
                    $('#notFountComment').removeClass('noDisplay');
                } else {
                    $('#commentcontentbox').removeClass("noDisplay");
                    $('#newCommentsContentUl').html(resp.commentHtml);
                }
            }, 'json');

};

$('form#analysisCommentBox').submit(function (e) {
    e.preventDefault();
    var _this = $(this);
    var analysisId = $('#commentAnalysisId').val();
    var data = _this.serialize();
    var url = full_path + "dashboard/analysiscommentsubmit";
    $.post(url, data,
            function (resp) {
                if (resp.flag == true) {
                    if (resp.totalComment == 1) {
                        if ($('#commentcontentbox').hasClass('noDisplay')) {
                            $('#commentcontentbox').removeClass('noDisplay');
                        }
                        if (!$('#notFountComment').hasClass('noDisplay')) {
                            $('#notFountComment').addClass('noDisplay');
                        }
                    }
                    $('#useranalysisComment').val('');
                    $('#newCommentsContentUl').append(resp.comment);
                    $('#analysisCommentedBox_' + analysisId).html(resp.commentedHtml);
                    $('#analysisComment_' + resp.analysisId + '_count').html(resp.totalComment);
                    success_msg(resp.msg);
                } else {
                    error_msg(resp.msg);
                }
            }, 'json');
});

likeAnalysisComment = function (event) {
    var selector = $('#' + event.id);

    var commentId = selector.attr('data-commentId');
    var url = full_path + "dashboard/analysiscommentlike";
    $.post(url,
            {
                commentId: commentId
            },
            function (resp) {
                if (resp.flag == true) {
                    selector.addClass("user_like");
                    if ($('#analysisCommentLike_' + commentId).length) {
                        $('#analysisCommentLike_' + commentId).addClass("user_like");
                    }
                } else {
                    if (selector.hasClass('user_like')) {
                        selector.removeClass('user_like');
                    }
                    if ($('#analysisCommentLike_' + commentId).length > 0 && $('#analysisCommentLike_' + commentId).hasClass("user_like")) {
                        $('#analysisCommentLike_' + commentId).removeClass("user_like");
                    }
                }

                if ($('#analysisCommentLike_' + commentId).length) {
                    $('#analysisCommentLike_' + commentId + '_count').html(resp.totalLike);
                }
                $('#modalAnalysisCommentLike_' + commentId + '_count').html(resp.totalLike);
            }, 'json');
};

openAnalysisReplied = function (event) {
    var commentId = $('#' + event.id).attr('data-commentId');
    var toogled = $('#' + event.id).attr('data-toogled');
    if (toogled == "hide") {
        $('#commentReplyedForm_' + commentId).removeClass('noDisplay');
        $('#replyContainer_' + commentId).removeClass('noDisplay');
        $('#' + event.id).attr('data-toogled', "show");
    } else {
        $('#commentReplyedForm_' + commentId).addClass('noDisplay');
        $('#replyContainer_' + commentId).addClass('noDisplay');
        $('#' + event.id).attr('data-toogled', "hide");
    }
};

submitModalReply = function (event) {
    var selector = $('#' + event.id);
    var commentId = selector.attr('data-commentId');

    var _form = $('#commentReplyedForm_' + commentId);

    var data = _form.serialize();

    var url = full_path + "dashboard/commentreply";
    $.post(url, data,
            function (resp) {
                if (resp.flag == true) {
                    $('#modalAnalysisReyplied_' + commentId).html(resp.replyed);
                    if ($('#analysisReplied_' + commentId).length) {
                        $('#analysisReplied_' + commentId).html(resp.replyed);
                    }
                    _form.find('input[name="replyed_msg"]').val('');
                    $('#replyContainer_' + commentId).append(resp.replyHtml);
                    success_msg(resp.msg);
//                    _form.addClass('noDisplay');
                } else {
                    error_msg(resp.msg);
                }
            }, 'json');
};

loadMoreAllAnalysis = function (event) {
    var selector = $('#' + event.id);
    selector.addClass("noDisplay");
    selector.parent().find('i').removeClass('noDisplay');

    var dataType = selector.attr('data-type');
    var limit = selector.attr('data-limit');
    var offset = selector.attr('data-nextOffset');
    var totalRec = selector.attr('data-totalRec');
    var url = full_path + "dashboard/loadmoreanalysis";
    $.post(url,
            {
                limit: limit,
                dataType: dataType,
                offset: offset
            },
            function (resp) {
                if (totalRec > resp.offset) {
                    selector.removeClass("noDisplay");
                }
                selector.attr("data-nextOffset", resp.offset);
                selector.parent().find('i').addClass('noDisplay');

                $('#' + dataType + "_listing_container").append(resp.html);
            }, 'json');
};

openReplyBox = function (event) {
    var commentId = $('#' + event.id).attr('data-commentId');
    var toogled = $('#' + event.id).attr('data-toogled');

    if (toogled == "hide") {
        $('#CommentReplyDashForm_' + commentId).removeClass('noDisplay');
        $('#' + event.id).attr('data-toogled', "show");
    } else {
        $('#CommentReplyDashForm_' + commentId).addClass('noDisplay');
        $('#' + event.id).attr('data-toogled', "hide");
    }
};

submitReply = function (event) {
    var selector = $('#' + event.id);
    var commentId = selector.attr('data-commentId');

    var _form = $('#CommentReplyDashForm_' + commentId);

    var data = _form.serialize();
    console.log(commentId);
    console.log(data);
    var url = full_path + "dashboard/commentreply";
    $.post(url, data,
            function (resp) {
                if (resp.flag == true) {
                    $('#analysisReplied_' + commentId).html(resp.replyed);
                    if (!_form.hasClass('noDisplay')) {
                        _form.addClass('noDisplay');
                    }
                    success_msg(resp.msg);
                } else {
                    error_msg(resp.msg);
                }
            }, 'json');
};

openShareOptions = function (event) {
    var selector = $('#' + event.id);
    var analysisId = selector.attr("data-analysisiId");
    var analysisTrackId = selector.attr("data-analysisiTrackId");
    var url = full_path + "dashboard/createshareablelink";
    $.post(url,
            {
                analysisId: analysisId,
                analysisTrackId: analysisTrackId
            },
            function (resp) {
                console.log(resp.facebookLink);
                $("#analysisShareFacebook").prop("href",resp.facebookLink);
                $("#analysisShareTwitter").prop("href",resp.twitterLink);
//                selector.find("#analysisShareInstagram").attr("href",resp.instagramLink);
            }, 'json');

    $('#shareoptions').modal();
};