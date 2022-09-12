/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 * 
 */

"use strict";
$(document).ready(function () {
    $(document).on('click', '.readmore', function (e) {
        e.preventDefault();
        var target = $(this).data('target');
        var read_more = $(this).data('next');
        var show = $(this).data('show');
        if (show) {
            $(this).data('show', 0);
            $(this).html('read more');
            $(target).html('...');
        } else {
            $(this).data('show', 1);
            $(this).html(' read less');
            $(target).html(read_more);
        }
    })
    $(document).on('change', '#f_subkategori', function (e) {
        var subkategori = $(this).val()
        if (subkategori == 'all') {
            $('.pag-data').show();
            paginat()
        } else {
            $('.pag-data[data-subkategori!="' + subkategori + '"]').hide();
            $('.pag-data[data-subkategori="' + subkategori + '"]').show();
            paginat(subkategori)
        }

    })
    $(document).on('submit', '#find-directory-form', function (e) {
        e.preventDefault();
        var f_judul = $('#f_judul').val();
        var f_type = $('#f_type').val();
        var f_event = $('#f_event').val();
        var f_kategori = $('#f_kategori:checked').val();
        var token = $('#csrf_token').val();
        var act = $(this).attr('action');
        var text_submit = $('#submit_directory').html();
        $('#submit_directory').attr('disabled', true)
        $('#submit_directory').html(text_submit + `...`);
        $('#directory-result').html("");
        $.ajax({
            type: "POST",
            url: act,
            data: {
                "p_judul": f_judul,
                "p_type": f_type,
                "p_kategori": f_kategori,
                "p_event": f_event,
                "csrf_directory": token,
            },
            dataType: "html",
            success: function (data) {
                $('#submit_directory').attr('disabled', false)
                $('#submit_directory').html(text_submit);
                $('#directory-result').html(data);
                $('html, body').animate({
                    scrollTop: $("#directory-result").offset().top
                }, 1500);
                paginat()
                // alert(data); //as a debugging message.
            },
            error: function (err) {
                console.log(err)
            }
        }); // you have missed this bracket
        return false;
    })
    $(document).on('click', '.find-event', function (e) {
        e.preventDefault();
        var id_event = $(this).data("id");
        var text_find = $(this).html();
        var token = $('#csrf_token').val();
        $('#directory-result').html("");

        $.ajax({
            type: "POST",
            url: base_url + "find_event/",
            data: {
                "id_event": id_event,
                "csrf_directory": token,
            },
            dataType: "html",
            success: function (data) {
                $('#directory-result').html(data);
                $('html, body').animate({
                    scrollTop: $("#directory-result").offset().top
                }, 1500);
                // alert(data); //as a debugging message.
            },
            error: function (err) {
                console.log(err)
            }
        }); // you have missed this bracket
        return false;
    })

    function paginat(paramsx = null) {
        if (paramsx != null) {
            var pagination_data = $('.pag-data[data-subkategori="' + paramsx + '"]')
        } else {
            var pagination_data = $(".pag-data")
        }
        // Number of items and limits the number of items per page
        var numberOfItems = pagination_data.length;
        var limitPerPage = 8;
        // Total pages rounded upwards
        var totalPages = Math.ceil(numberOfItems / limitPerPage);
        // Number of buttons at the top, not counting prev/next,
        // but including the dotted buttons.
        // Must be at least 5:
        var paginationSize = 7;
        var currentPage;

        function showPage(whichPage) {
            if (whichPage < 1 || whichPage > totalPages) return false;
            currentPage = whichPage;
            pagination_data
                .hide()
                .slice((currentPage - 1) * limitPerPage, currentPage * limitPerPage)
                .show();
            // Replace the navigation items (not prev/next):
            $(".pagination li").slice(1, -1).remove();
            getPageList(totalPages, currentPage, paginationSize).forEach(item => {
                $("<li>")
                    .addClass(
                        "page-item " +
                        (item ? "current-page " : "") +
                        (item === currentPage ? "active " : "")
                    )
                    .append(
                        $("<a>")
                        .addClass("page-link")
                        .attr({
                            href: "javascript:void(0)"
                        })
                        .text(item || "...")
                    )
                    .insertBefore("#next-page");
            });
            return true;
        }

        // Include the prev/next buttons:
        $(".pagination").html("")
        $(".pagination").append(
            $("<li>").addClass("page-item").attr({
                id: "previous-page"
            }).append(
                $("<a>")
                .addClass("page-link")
                .attr({
                    href: "javascript:void(0)"
                })
                .text("Prev")
            ),
            $("<li>").addClass("page-item").attr({
                id: "next-page"
            }).append(
                $("<a>")
                .addClass("page-link")
                .attr({
                    href: "javascript:void(0)"
                })
                .text("Next")
            )
        );
        // Show the page links
        $("#jar").show();
        showPage(1);

        // Use event delegation, as these items are recreated later
        $(
            document
        ).on("click", ".pagination li.current-page:not(.active)", function () {
            return showPage(+$(this).text());
        });
        $("#next-page").on("click", function () {
            return showPage(currentPage + 1);
        });

        $("#previous-page").on("click", function () {
            return showPage(currentPage - 1);
        });
        // $(".pagination").on("click", function () {
        //     $("html,body").animate({
        //         scrollTop: 0
        //     }, 0);
        // });
    }


    function getPageList(totalPages, page, maxLength) {
        if (maxLength < 5) throw "maxLength must be at least 5";

        function range(start, end) {
            return Array.from(Array(end - start + 1), (_, i) => i + start);
        }

        var sideWidth = maxLength < 9 ? 1 : 2;
        var leftWidth = (maxLength - sideWidth * 2 - 3) >> 1;
        var rightWidth = (maxLength - sideWidth * 2 - 2) >> 1;
        if (totalPages <= maxLength) {
            // no breaks in list
            return range(1, totalPages);
        }
        if (page <= maxLength - sideWidth - 1 - rightWidth) {
            // no break on left of page
            return range(1, maxLength - sideWidth - 1)
                .concat([0])
                .concat(range(totalPages - sideWidth + 1, totalPages));
        }
        if (page >= totalPages - sideWidth - 1 - rightWidth) {
            // no break on right of page
            return range(1, sideWidth)
                .concat([0])
                .concat(
                    range(totalPages - sideWidth - 1 - rightWidth - leftWidth, totalPages)
                );
        }
        // Breaks on both sides
        return range(1, sideWidth)
            .concat([0])
            .concat(range(page - leftWidth, page + rightWidth))
            .concat([0])
            .concat(range(totalPages - sideWidth + 1, totalPages));
    }

    $(function () {

    });

})