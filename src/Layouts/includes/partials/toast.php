<?php
$toast = $app->toast;
if (isset($toast->show)): ?>
    <div id="toast-container<?php echo $toast->position ?: '' ?>"
         class="toast-container toast-<?php echo $toast->position ?: 'bottom-center' ?>">
        <div class="toast mb-3 fade <?php echo $toast->show ?: '' ?>" id="toast" data-delay="5000"
             role="alert"
             aria-live="assertive"
             aria-atomic="true">
            <div id="toast-header" class="toast-header bg-<?php echo $toast->status ?: 'info' ?> text-white">
                <i id="toast-icon" class="czi-<?php echo $toast->icon ?: 'bell' ?> mr-2"></i>
                <h6 id="toast-title"
                    class="font-size-sm text-white mb-0 mr-auto"><?php echo $toast->title ?></h6>
                <button onclick="$().removeToast(<?php echo $toast->params ?: '' ?>)"
                        class="close text-white ml-2 mb-1" type="button"
                        data-dismiss="toast" aria-label="Close Toast">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="toast-body" id="toast-body">
                <?php echo $toast->body ?: 'This item has been added to your cart.' ?>
            </div>
        </div>
    </div>
<?php endif; ?>