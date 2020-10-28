<?php $alert = $app->alert;
if ($alert->show): ?>
    <div id="alert-container" class="container-fluid mt-3" style="z-index: 1000; position: absolute">
        <script>
            setTimeout($().removeAlert(), 3000);
        </script>
        <div class="row mx-2">
            <div class="mx-auto">
                <div class="alert alert-<?php echo $alert->status ?: 'info' ?><?php echo !$alert->icon ? ' ' : ' alert-with-icon ' ?>alert-dismissible fade <?php echo $alert->show ?: '' ?>"
                     role="alert">
                    <?php if ($alert->icon): ?>
                        <div class="alert-icon-box">
                            <i class="alert-icon czi-<?php echo $alert->icon ?: 'bell' ?>"></i>
                        </div>
                    <?php endif; ?>
                    <?php echo "$alert->title: $alert->text" ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"
                            onclick="$().removeAlert()"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>