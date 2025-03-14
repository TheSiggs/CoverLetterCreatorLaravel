@if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/js/copytoclipboard.js'])
@endif
<div class="container">
    <div class="row">
        <h2 class='text-center col-11 h2'>Cover Letter</h2>
        <div class="col-1">
            <span id="copyButton" class="btn btn-primary">Copy</span>
        </div>
    </div>
</div>
<pre id="coverlettercontent" style='white-space: pre-wrap; word-break: break-word; overflow-x: hidden;'>
{{ $coverletter }}
</pre>
