// initialize API URLs
/* data */
ajax_path = site_path+"/includes/ajax/";
api['data/upload'] = ajax_path + "data/upload.php";


$(document).ready(function(){
    let uploaders = document.querySelectorAll('.x-uploader');

    uploaders.forEach(function(e){
        let container = $(e).parents('.container-uploader');
        $(container).find(".label-file").attr('for', $(container).data('id'));
        $(container).find("input[type='file']").attr('id', $(container).data('id'));

    })
})

$(function (){

    // Retornar tiempo de la canción 
    function secondsToString(seconds) {
        var hour = Math.floor(seconds / 3600);
        hour = (hour < 10)? '0' + hour : hour;
        var minute = Math.floor((seconds / 60) % 60);
        minute = (minute < 10)? '0' + minute : minute;
        var second = seconds % 60;
        second = (second < 10)? '0' + second : second;
        return hour + ':' + minute + ':' + second;
    }

    // Obtener duracion de la cancion
    window.URL = window.URL || window.webkitURL;

        // Obtener duración de la canción
        function getDurationFile(inputfile) {
            var audio = Array();
            // var files = this.files;
            // audio.push(inputfile);
            var audio_node = document.createElement('audio');
            audio_node.preload = 'metadata';

            audio_node.onloadedmetadata = function() {
                window.URL.revokeObjectURL(audio_node.src);
                let duration = audio_node.duration;
                document.getElementById("seconds").value = duration;
                let timeDuration = secondsToString(duration);
                document.getElementById("duration").value = timeDuration;
            }
            audio_node.src = URL.createObjectURL(inputfile);
        }




    /* initialize uploading */
    $('body').on('change', '.x-uploader input[type="file"]', function () {
        uploadingFunction($(this).closest('.x-uploader'))
    });
    /* uploading */
    function uploadingFunction(element){
        // get type
        var type = $(element).find('.js_x-uploader').data('type') || "photos";
        /* get handle */
        var handle = $(element).find('.js_x-uploader').data('handle');
        // get file
        let inputfile = $(element).find('input[type="file"]');
        inputfile = inputfile[0].files[0];

        if(type=='audio')
            getDurationFile(inputfile);

        // FormData
        var formData = new FormData();
        formData.append('file', inputfile);
        formData.append('type', type);
        formData.append('handle', handle);
        var songData = $(element).parents('.js_form');

        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = (evt.loaded / evt.total) * 100;
                        songData.find(".progress_"+type).val(percentComplete);
                        // document.getElementById("loading_"+type).value = percentComplete;
                    }
                }, false);
                return xhr;
            },
            url: api['data/upload'],
            data: formData,
            type: 'POST',
            enctype:'multipart/form-data',
            processData: false, // tell jQuery not to process the data
            contentType: false,
            success: function(response){
                console.log(response)
                if(response.error){
                    songData.find(".progress_"+type).val(0);
                    M.toast({html: "Error: "+response.message, classes: 'rounded red'});
                } else
                    songData.data(type, response.file)

            },
            error: function(error){
                console.log(error)
            }
        });
    }
})