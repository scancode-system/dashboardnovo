<div class="card-footer">
@includeWhen(!isset($dropzone), 'dashboard::imports.widget.subviews.footer.progressbar')
@includeWhen(isset($dropzone), 'dashboard::imports.widget.subviews.footer.dropzone')
</div>