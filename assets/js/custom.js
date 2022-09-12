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
    $(document).on('click', '#data_form input[data-access="all"] ', function () {
        var access = $(this).val()
        var type = $(this).data("type")
        var vals = $(this).prop("checked")
        $('#data_form input[data-access="' + type + '"][value="' + access + '"]').prop('checked', vals)
    })
    $(document).on('click', '#data_form input[data-access="all_row"] ', function () {
        var menu = $(this).data("menu")
        var vals = $(this).prop("checked")

        $('#data_form input[data-menu="' + menu + '"]').prop('checked', vals)
    })
    $(document).on('click', '#data_form input[data-access="create"] ', function () {
        var access = $(this).val()
        var access_menu = $(this).data("menu")
        var create = $('#data_form input[data-access="all"][data-type="create"]')
        var create_val = create.val();
        var all_row = $('#data_form input[data-access="all_row"][data-menu="' + access_menu + '"]')
        var all_row_val = create.val();


        if (access != create_val)
            create.prop('checked', false)
        if (access != all_row_val)
            all_row.prop('checked', false)
    })

    $(document).on('click', '.btn-tambah-access', function () {
        var title = $(this).data('title'),
            actions = $(this).data('action')
        $('#form-modal-title').html(title)
        $('#data_form').attr('action', actions)
        $('#level_id_hide').show();

        $('#data_form input[type=checkbox]').prop('checked', false)
        $('#data_form input[type=radio]').prop('checked', false)
        $('#data_form select').val('')


    })

    $(document).on('click', '.btn-tambah', function () {
        var title = $(this).data('title'),
            actions = $(this).data('action')
        $('#form-modal-title').html(title)
        $('#data_form').attr('action', actions)

        $('#data_form input[type=text]').val('')
        $('#data_form input[type=checkbox]').prop('checked', false)
        $('#data_form input[type=radio]').prop('checked', false)
        $('#data_form select').val('')

        $('#level_id_hide').show();
    })

    $(document).on('click', '.btn-edit-access', function () {
        var title = $(this).data('title'),
            actions = $(this).data('action'),
            fields = $(this).data('field'),
            btn_action = ['read', 'create', 'update', 'delete', 'export', 'other']
        $('#form-modal-title').html(title)
        $('#data_form').attr('action', actions)

        $('#data_form input[type=checkbox]').prop('checked', false)
        $('#level_id_hide').hide();
        var count_alls = {
            'read': 0,
            'create': 0,
            'update': 0,
            'delete': 0,
            'export': 0,
            'other': 0
        }

        $.each(fields, function (key, val) {
            var all_row = 0;
            $.each(btn_action, function (i, $vals) {
                $('#data_form input[name="' + $vals + '[' + val.id_menu + ']"][value="' + val[$vals] + '"]').prop('checked', true)
                if (val[$vals] == 1) {
                    count_alls[$vals] += 1
                    all_row += 1
                }
            })
            if (all_row == 6) $('#data_form input[data-access="all_row"][data-menu="' + val.id_menu + '"]').prop('checked', true);
            else $('#data_form input[data-access="all_row"][data-menu="' + val.id_menu + '"]').prop('checked', false);

        })

        $.each(btn_action, function (i, $vals) {
            if (count_alls[$vals] == fields.length) $('#data_form input[data-access="all"][data-type="' + $vals + '"]').prop('checked', true)
            else $('#data_form input[data-access="all"][data-type="' + $vals + '"]').prop('checked', false)
        })
    })

    $(document).on('click', '.btn-detail-access', function () {
        var title = $(this).data('title'),
            fields = $(this).data('field'),
            badge_aktif = '<span class="badge badge-pill  badge-success">Aktif</span>',
            badge_nonaktif = '<span class="badge badge-pill  badge-danger">Nonaktif</span>';
        $('#detail-modal-title').html(title)
        $('.detail_access').html('')
        $.each(fields, function (key, val) {
            $('#detail_read_' + val.id_menu).html(val.read == 1 ? badge_aktif : badge_nonaktif);
            $('#detail_create_' + val.id_menu).html(val.create == 1 ? badge_aktif : badge_nonaktif);
            $('#detail_update_' + val.id_menu).html(val.update == 1 ? badge_aktif : badge_nonaktif);
            $('#detail_delete_' + val.id_menu).html(val.delete == 1 ? badge_aktif : badge_nonaktif);
            $('#detail_export_' + val.id_menu).html(val.export == 1 ? badge_aktif : badge_nonaktif);
            $('#detail_other_' + val.id_menu).html(val.other == 1 ? badge_aktif : badge_nonaktif);

        })
    })

    $(document).on('click', '.btn-edit', function () {
        var title = $(this).data('title'),
            actions = $(this).data('action'),
            fields = $(this).data('field')
        $('#form-modal-title').html(title)
        $('#data_form').attr('action', actions)

        $('#data_form input[type=text]').val('')
        $('#data_form input[type=checkbox]').prop('checked', false)
        $('#data_form input[type=radio]').prop('checked', false)
        $('#data_form select').val('')


        $.each(fields, function (key, val) {
            if (val !== null) {
                var getName = $('#data_form input[name="' + key + '"]')
                var attr_type = getName.attr('type')

                if (attr_type == 'radio') {
                    $('#data_form input[name="' + key + '"][value="' + val + '"]').prop('checked', true)
                } else if (attr_type == 'checkbox') {
                    $.each(val, function (i, vals) {
                        $('#data_form input[name="' + key + '"][value="' + vals + '"]').prop('checked', true)
                    })
                } else {
                    var vals = val.replace("&#39;", "'")
                    if ($('#' + key).prop("type") != "file") {
                        $('#' + key).val(vals)
                    }
                }
                if (key == 'group_menu') {
                    disableGroupMenu(val);
                }
                if (key == 'user_username') {
                    $('#idx_user').hide();
                }
            }
        })
    })

    $(document).on('change', '#data_form input[name="group_menu"]', function () {
        var vals = $(this).val();
        disableGroupMenu(vals, 'not null');
    })

    function disableGroupMenu(vals, val_null = null) {
        if (vals == 1) {
            $('#link_nama_menu').val('');
            $('#link_nama_menu').attr('readonly', true);

            $('#link_menu').val('');
            $('#link_menu').attr('readonly', true);

            $('#parent_menu').val('');
            $('#parent_menu').attr('readonly', true);
        } else {
            $('#link_nama_menu').attr('readonly', false);
            $('#link_menu').attr('readonly', false);
            $('#parent_menu').attr('readonly', false);

            if (val_null) {
                $('#link_nama_menu').val('');
                $('#link_menu').val('');
                $('#parent_menu').val('');
            }
        }
    }
    $(document).on('click', '.btn-delete', function () {
        var title = $(this).data('title'),
            actions = $(this).data('action')
        $('#delete-modal-title').html(title)
        $('#delete_form').attr('action', actions)

    })
    $(document).on('click', '.btn-reset', function () {
        var title = $(this).data('title'),
            actions = $(this).data('action'),
            type = $(this).data('type')
        $('#reset-modal-title').html(title)
        $('#reset_form').attr('action', actions)
        if (type == 'multiple') {
            $('#reset-message').text('Apakah anda yakin ingin reset semua data?')
        } else {
            $('#reset-message').text('Apakah anda yakin ingin reset data ini?')
        }
    })

    $(document).on('click', '.btn-import', function () {
        var title = $(this).data('title'),
            actions = $(this).data('action')

        $('#import-modal-title').html(title)
        $('#import_form').attr('action', actions)
    })

    $(document).on('click', '.btn-image', function () {
        var title = $(this).data('title'),
            image = $(this).data('image')

        $('#show_image').attr('src', image)
    })
    $(document).on('change', '#upload_mushaf', function () {
        var $fileUpload = $(this);
        if (parseInt($fileUpload.get(0).files.length) > 10) {
            $(this).val("");
            $(".text-alerts").text("maximal 10 gambar!");
        } else {
            $(".text-alerts").text("");
        }
    })
    $(document).on('click', '.full-screen', function (e) {
        e.preventDefault();
        toggleFullScreen();
    })
    $(document).on('click', '.zoom-out', function (e) {
        e.preventDefault();
        $('.mushaf-page').removeClass("w-50").addClass("w-100");
    })
    $(document).on('click', '.zoom-in', function (e) {
        e.preventDefault();
        $('.mushaf-page').removeClass("w-100").addClass("w-50");
    })
    $(document).on('click', '.liat-soal', function (e) {
        $('.paket-default').hide();
        $('.paket-soal').removeClass("d-none");
    })

    $(".hide-taskbar").click(function () {
        $("#taskbar").slideUp();
        $(".show-button").removeClass("d-none");
    });
    $(".show-taskbar").click(function () {
        $("#taskbar").slideDown();
        $(".show-button").addClass("d-none");
    });

    var allKotaOptions = $('#event_kota option')
    $('#event_provinsi').change(function () {
        $('#event_kota option').remove(); //remove all options
        var classN = $('#event_provinsi option:selected').data('id'); //get the 
        var opts = allKotaOptions.filter('[data-provinsi="' + classN + '"]'); //selected option's classname
        $.each(opts, function (i, j) {
            $(j).appendTo('#event_kota'); //append those options back
        });
    });

    var allOptions = $('#id_golongan option')
    $('#id_cabang').change(function () {
        $('#id_golongan option').remove(); //remove all options
        var classN = $('#id_cabang option:selected').val(); //get the 
        var opts = allOptions.filter('[data-cabang="' + classN + '"]'); //selected option's classname
        allOptions.attr('selected', true).filter('[value=""]').appendTo('#id_golongan')
        $('#id_subkategori').val('')
        $.each(opts, function (i, j) {
            $(j).appendTo('#id_golongan'); //append those options back
        });
        $("#id_golongan").prop("selectedIndex", 0);
    });

    var allKatOptions = $('#id_kategori option')
    $('#id_golongan').change(function () {
        $('#id_kategori option').remove(); //remove all options
        var classN = $('#id_golongan option:selected').data('subkategori'); //get the 
        var opts = allKatOptions.filter('[data-subkategori="' + classN + '"]'); //selected option's classname
        allKatOptions.attr('selected', true).filter('[value=""]').appendTo('#id_kategori')
        $('#id_subkategori').val('')

        $.each(opts, function (i, j) {
            $(j).attr('selected', false).appendTo('#id_kategori'); //append those options back
        });
        console.log('asd')

        $("#id_kategori").prop("selectedIndex", 0);
    });

    var allSubOptions = $('#id_subkategori option')

    $('#id_kategori').change(function () {
        $('#id_subkategori option').remove(); //remove all options

        var checkClass = $("#id_kategori").hasClass("juara-kategori");
        var classN = $('#id_kategori option:selected').val(); //get the 

        if (checkClass) {
            var classGol = $('#id_golongan option:selected').data('subkategori');

            var opts = allSubOptions.filter('[data-kategori="' + classN + '"][data-subkategori="' + classGol + '"]'); //selected option's classname
        } else {
            var opts = allSubOptions.filter('[data-kategori="' + classN + '"]'); //selected option's classname
        }


        $.each(opts, function (i, j) {
            $(j).appendTo('#id_subkategori'); //append those options back
        });
    });



    $(document).on('click', '.btn-detail', function () {
        var title = $(this).data('title'),
            fields = $(this).data('field')
        $('#detail-modal-title').html(title)

        console.log('asdasd')
        $.each(fields, function (key, val) {
            var vals = val;
            if (vals === null || vals === '') {
                vals = "-"
            }

            if (key === 'link') {
                $('#detail_' + key).prop('href', vals)
                $('#detail_' + key).text(vals)
            } else if (key === 'thumbnail') {
                $('#detail_' + key).prop('src', base_url + '/assets/' +
                    vals)
                // $('#detail_' + key).text()
            } else if (key === 'link') {
                $('#detail_' + key).prop('href', vals)
                $('#detail_' + key).text(vals)
            } else {
                vals = vals.replace("&#39;", "'")
                $('#detail_' + key).html(vals)
            }

        })
    })



    function toggleFullScreen() {
        if (!document.fullscreenElement) {
            document.documentElement.requestFullscreen();
        } else {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            }
        }
    }
})