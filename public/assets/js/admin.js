error = true;
if (typeof ($batchId) === 'undefined') {
    $batchId = '';
}
$(document).ready(function () {
    $(document).on("click", '.paq-pager ul.pagination a', function (e) {
        e.preventDefault();
        $page = $(this).attr('href').split('page=')[1];
        $type = $defaultType;
        updateFormData();
        renderAdmin();
    });

    $('body').on('click', '.delete_content', function (e) {
        e.preventDefault();
        if (typeof ($viewOnly) === 'undefined' || $viewOnly == false) {
            $deleteId = this.id;
            var result = confirm('Are you sure to delete');
            if (result) {
                $type = 'delete';
                $formData = {
                    '_token': $token,
                    'id': $deleteId
                };
                renderAdmin();
            }
        }
    });

    $('body').on('click', '.sorting', function (e) {
        e.preventDefault();
        $('.sorting').not(this).removeClass('fa-sort-asc fa-sort-desc').addClass('fa-sort');
        $sortColumn = $(this).parent().attr("id");
        if ($(this).hasClass('fa-sort-' + $asc)) {
            $(this).removeClass('fa-sort-' + $asc).addClass('fa-sort-' + $desc);
            $sortType = 'desc';
        } else if ($(this).hasClass('fa-sort-' + $desc)) {
            $(this).removeClass('fa-sort-' + $desc).addClass('fa-sort-' + $asc);
            $sortType = 'asc';
        } else {
            $(this).addClass('fa-sort-' + $asc);
            $sortType = 'asc';
        }
        $type = $defaultType;
        updateFormData();
        renderAdmin();
    });

});

/**
 * This is used to control admin all functions
 */
function renderAdmin() {
    /**
     * This is user to render grid data on base of grid fields
     */
    var renderGrid = function () {
        $html = '';
        $result = $data.result;
        $gridFields = $data.gridFields;
        $('#total-record').html('[' + $data.total + ']');
        $(".paq-pager").html($data.pager);
        if ($result != '') {
            $.each($result, function (i, v) {
                $keyValue = v;
                $blockedDisplay = '';
                $html += '<tr id="row_' + $keyValue.id + '" class="' + $blockedDisplay + '">';
                $.each($gridFields, function (index, value) {
                    $columValue = v[value.name];
                    console.log(value);
                    if (typeof (value.custom) !== 'undefined' && typeof (value.custom.isDownloadLink) !== 'undefined') {
                        if (typeof($keyValue.qr_code) !== 'undefined' && $keyValue.qr_code)
                            $html += '<td id="column_' + value.name + '_' + $keyValue.id + '"><a href="'+$qrcodeDownloadRoute+'/'+$keyValue.id+'" id="'+$keyValue.id+'" class="download_qr">Download</a></td>';
                        else
                            $html += '<td id="column_' + value.name + '_' + $keyValue.id +'"></td>';
                    } else if (typeof (value.custom) !== 'undefined' && typeof (value.custom.status) !== 'undefined') {
                        $titleValue = value.custom.emptyTitle;
                        if ($columValue !='' && $columValue != 0) {
                            $titleValue = value.custom.value;
                        }
                        $html += '<td id="column_' + value.name + '_' + $keyValue.id + '">' + $titleValue + '</td>';
                    } else if(typeof (value.custom) !== 'undefined' && typeof (value.custom.isAnchor) !== 'undefined') {
                        $html += '<td id="column_' + value.name + '_' + $keyValue.id + '"><a href="'+value.custom.url+'/'+$keyValue.id+'?viewOnly=true">' + $columValue + '</a></td>';
                    } else if (typeof (value.custom) !== 'undefined' && typeof (value.custom.image) !== 'undefined') {
                        $imageURL = value.custom.imageURL;
                        if($columValue != '' && $columValue != null)
                            $html += '<td id="column_' + value.name + '_' + $keyValue.id + '" width="'+value.custom.width+'"><a href="javascript: void(0)"><img src="'+$imageURL+'/'+$columValue+'"></a></td>';
                        else
                            $html += '<td></td>';
                    } else {
                        $html += '<td id="column_' + value.name + '_' + $keyValue.id + '">' + $columValue + '</td>';
                    }
                });
                var fn = window[$defaultType+'Action'];

                if (typeof fn === 'function') { // used to trigger relative action
                    fn();
                }
                $html += '</tr>';
            });
        }

        $('#page-data').html($html);
    };

    /**
     * This is used to upload image
     */
    var uploadImage = function () {
        $('.uploader').dmUploader({
            url: $uploadImageRoute,
            allowedTypes: 'image/*',
            dataType: 'json',
            onBeforeUpload: function (id) {
                $('.uploader').data('dmUploader').settings.extraData = {
                    "_token": $token,
                    tempImageId: $tempImageId,
                    batchId: $batchId
                };
            },
            onNewFile: function (id, file) {
                $.danidemo.addFile('#demo-files', id, file);

                /*** Begins Image preview loader ***/
                if (typeof FileReader !== "undefined") {

                    var reader = new FileReader();

                    // Last image added
                    var img = $('#demo-files').find('.demo-image-preview').eq(0);

                    reader.onload = function (e) {
                        img.attr('src', e.target.result);
                    }

                    reader.readAsDataURL(file);

                } else {
                    // Hide/Remove all Images if FileReader isn't supported
                    $('#demo-files').find('.demo-image-preview').remove();
                }
                /*** Ends Image preview loader ***/

            },
            onUploadProgress: function (id, percent) {
                var percentStr = percent + '%';
                $.danidemo.updateFileProgress(id, percentStr);
            },
            onUploadSuccess: function (id, data) {
                notificationMsg(data.message, data.success);
                uploadMessages(id);
                if (typeof ($isUploadImage) !== 'undefined') {
                    $isUploadImage = true;
                }
                if (data.success == true) {
                    if (typeof ($appendImage) !== 'undefined' && $appendImage == true) {
                        $appendHtml = '<tr id="row_'+data.id+'">\n' +
                                            '<td width="17%"><a href="javascript: void(0)"><img src="'+data.filePath+'" alt="image"></a></td>\n' +
                                            '<td width="70%">'+data.fileName+'</td>\n' +
                                            '<td width="13%"><a href="javascript: void(0)" id="delete_'+data.id+'" class="delete_content">DELETE</a></td>\n' +
                                        '</tr>';
                        $('#post_images').append($appendHtml);
                    } else {
                        $tempImageId = data.tempImageId;
                        $('#company-image').html('<img src="'+data.fileName+'" />');
                    }
                    $.danidemo.updateFileStatus(id, 'success', 'Upload Complete');
                    $.danidemo.updateFileProgress(id, '100%');
                }
            },
            onUploadError: function (id, message) {
                //notificationMsg(message, error);
            },
            onFileTypeError: function (file) {
                notificationMsg('File \'' + file.name + '\' cannot be added: must be an Image', error);
            },
            onFileSizeError: function (file) {
                //notificationMsg('File \'' + file.name + '\' cannot be added: size excess limit', error);
            },
            onFallbackMode: function (message) {
                //notificationMsg('Browser not supported(do something else here!): ' + message, error);
            }
        });
    }

    var uploadMessages = function (id) {
        $('#demo-file' + id).slideToggle(500);
        setTimeout(function () {
            $('#demo-file' + id).remove();
        }, 600);
    }

    /**
     * This is used to render communites actions
     */
    renderUsersAction = function () {
        $id = $keyValue.id;
        if ($isAdminUser) {
            $html += '<td>\n' +
                '<ul>\n' +
                    '<li><a href="' + $editRoute + '/' + $id + '"><i class="fa fa-pencil-square-o"></i></a></li>' + '\n' +
                    '<li><a href="javascript: void(0)" id="delete_' + $id + '" class="delete_content"><i class="fa fa-trash-o"></i></a></li>\n' +
                '</ul>\n' +
                '</td>';
        } else {
            $html += '<td></td>';
        }
    }

    /**
     * This is used to render files
     */
    renderFilesAction = function () {
        $id = $keyValue.id;
        $html += '<td>\n' +
            '<ul>\n' +
            '<li><a href="' + $downloadFileRoute + '/' + $id + '"><i class="fa fa-download"></i></a></li>\n' +
            '<li><a href="javascript: void(0)" id="delete_'+$id+'" class="delete_content"><i class="fa fa-trash-o"></i></a></li>\n' +
            '</ul>\n' +
            '</td>';
    }

    /**
     * This is used to render grid routes
     */
    var callGridRender = function () {
        ajaxStartStop();
        $.ajax({
            url: $renderRoute,
            type: 'POST',
            data: $formData,
            success: function (data) {
                $data = data;
                renderGrid();
            },
            error: function ($error) {
                notificationMsg($error, error);
            }
        });
    };

    /**
     * This is common function used to add record
     */
    var addRecord = function () {
        ajaxStartStop();
        $.ajax({
            url: $addRecordRoute,
            type: 'POST',
            data: $formData,
            success: function (data) {
                $message = data.message;
                if (data.success == true) {
                    notificationMsg(data.message, data.success);
                    if (typeof ($redirectRoute) !== 'undefined') {
                        window.location = $redirectRoute;
                    }
                } else {
                    if ($.isArray(data.message)) {
                        $message = '';
                        $.each(data.message, function (i, v) {
                            $message += v + "\n";
                        })
                    }
                }
                notificationMsg($message, data.success);
            },
            error: function ($error) {
                notificationMsg($error, 'error');
            }
        });
    }

    /**
     * This is general function used to delete content
     */
    var destroy = function () {
        ajaxStartStop();
        $.ajax({
            url: $deleteRoute,
            type: 'POST',
            data: $formData,
            success: function (data) {
                if (data.success == true) {
                    $('#row_' + data.id).remove();
                    if (typeof ($reloadAfterDelete) == 'undefined') {
                        $page = 1;
                        updateFormData();
                        $type = $defaultType;
                        renderAdmin();
                    }
                }
                notificationMsg(data.message, data.success);
            },
            error: function ($error) {
                notificationMsg($error, error);
            }
        });
    }

    // rendering grid
    if ($type.indexOf('render') !== -1) {
        callGridRender();
    } else if ($type.indexOf('delete') !== -1) {
        destroy();
    } else if($type.indexOf('addRecord') !== -1) {
        addRecord();
    }

    var functionList = {};
    functionList['uploadImage'] = uploadImage;
    if ($type in functionList) {
        functionList[$type]();
    }

}