<!-- PDF Modal -->
<style type="text/css">
    .modal-lg {
        max-width: 90%;
        margin: auto;
    }

    .modal-body {
       max-height: calc(100vh - 210px);
    overflow-y: auto;
    }

    #pdfViewer {
        width: 100%; 
        height: 100%; 
    }
</style>
<div class="modal" id="pdfModal" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pdfModalLabel">PDF Viewer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="pdfViewer" style="width: 100%; height: 800px;">
                    <iframe id="pdfViewer" src="uploadedfiles/atomichabit.pdf" style="width: 100%; height: 800px; border: none;"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
