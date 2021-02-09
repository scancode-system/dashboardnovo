<div id="dropzone-import" class="dropzone flex-fill">
    <div class="dz-message m-0">
        {{ Form::button('<i class="cil-cloud-upload font-2xl text-white"></i>', ['type' => 'submit', 'class' => 'btn bg-facebook w-100']) }}
    </div>
</div>

<div id="layout" class="d-none">
    <div class="progress-group mb-0">
        <div class="progress-group-header align-items-end">
            <div>Transferindo arquivo (<span data-dz-name></span>)</div>
            <div class="ml-auto font-weight-bold mr-2 progress-text"></div>
        </div>
        <div class="progress-group-bars">
            <div class="progress progress-xs bg-secondary">
                <div class="progress-bar bg-facebook" id="progressbar-file" role="progressbar" aria-valuenow="56" aria-valuemin="0" aria-valuemax="100" data-dz-uploadprogress></div>
            </div>
        </div>
    </div>
</div>





{{ Html::style('modules/dashboard/dropzone/dropzone.css') }}
<style type="text/css">
  .card-footer .dropzone{border: none; background: none; padding: 0px; min-height: 0px;}
  .card-footer .dz-message{margin: 0px;}  
</style>



{{ Html::script('modules/dashboard/dropzone/dropzone.js') }}
<script>
    Dropzone.autoDiscover = false;

    var layout = document.getElementById('layout').innerHTML;

    var dropzone_import = new Dropzone('#dropzone-import', {
        url: '{{ route("imports.widget.upload") }}',
        params: {
            extension: "xlsx",
            import_class: "{{ $import_class }}"
        },
        headers: {'X-CSRF-Token': "{{ csrf_token() }}"},
        previewTemplate: layout,
        uploadprogress: function(file, progress, bytesSent) {
            console.log(file.previewElement);
            if (file.previewElement) {
               var progressElement = file.previewElement.querySelector("[data-dz-uploadprogress]");
               progressElement.style.width = progress + "%";
               file.previewElement.querySelector(".progress-text").textContent = progress + "%";
               if(progress == 100){
                $("#progressbar-file").addClass("progress-bar-striped progress-bar-animated");
            }
        }
    },
    success: function(file, response, xhr){
        var interval = setInterval(function(){
            $("#container_import").load('{{ route('imports.widget.update') }}?import_class='+response.import_class);
        }, 1000);
        //console.log(response);

        $.post('{{ route('imports.widget.start') }}', {path:response.path, import_class:response.import_class, _token:'{{ csrf_token() }}'}).always(function(data) {
            clearInterval(interval);
            $("#container_import").load('{{ route('imports.widget.update') }}?import_class='+response.import_class);
        });
    },
    error: function(file, response, xhr){
        //console.log(response.errors);
        /*$(".errors").load('{{ route('imports.widget.update', "bababa") }}', response.errors, function(){
            dropzone_import.removeAllFiles();
        });*/
    }
});
</script>