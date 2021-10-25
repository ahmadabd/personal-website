<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>

        <title><?php echo e($title); ?></title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Layout Page Css -->
        <link rel="stylesheet" href="/css/layout.css">

        <!-- Other Page Css -->
        <link rel="stylesheet" href="/css/<?php echo e($page_css); ?>">

    </head>
    <body>

        <?php if(auth()->guard()->check()): ?>
            <?php if (isset($component)) { $__componentOriginal6ec09c8b1b6c22c6f9100df3f44aac19d018192b = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Dashboardnav::class, []); ?>
<?php $component->withName('Dashboardnav'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginal6ec09c8b1b6c22c6f9100df3f44aac19d018192b)): ?>
<?php $component = $__componentOriginal6ec09c8b1b6c22c6f9100df3f44aac19d018192b; ?>
<?php unset($__componentOriginal6ec09c8b1b6c22c6f9100df3f44aac19d018192b); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
        <?php else: ?>
            <?php if (isset($component)) { $__componentOriginal4ef3f5a8a8724cef81dcbc68e612558cabc1c480 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Nav::class, []); ?>
<?php $component->withName('Nav'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginal4ef3f5a8a8724cef81dcbc68e612558cabc1c480)): ?>
<?php $component = $__componentOriginal4ef3f5a8a8724cef81dcbc68e612558cabc1c480; ?>
<?php unset($__componentOriginal4ef3f5a8a8724cef81dcbc68e612558cabc1c480); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>                
        <?php endif; ?>

        <div class="container-fluid">
            <div class="container">
                <div class="row block">
                    <div class="col"></div>
                    <div class="col-6">
                        <?php echo e($slot); ?>

                    </div>
                    <div class="col"></div>
                </div>
            </div>
        </div>
    </body>
</html>
    <?php /**PATH /var/www/html/resources/views/components/layout.blade.php ENDPATH**/ ?>