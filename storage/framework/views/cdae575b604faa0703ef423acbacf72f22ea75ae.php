<?php if (isset($component)) { $__componentOriginalba35371caef1eeddf45260937599d5fd5fb5dd30 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Layout::class, []); ?>
<?php $component->withName('Layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
    
     <?php $__env->slot('title', null, []); ?> About Me <?php $__env->endSlot(); ?>
     <?php $__env->slot('page_css', null, []); ?>  <?php $__env->endSlot(); ?>

    <h1 class="title">Biography</h1>
    <hr>
    <p class="content">
        <?php if(isset($bio)): ?>
            <?php echo str_replace("\\","<br>",$bio); ?>

        <?php endif; ?>

        <?php if(empty($bio)): ?>
            <p class="alert alert-danger"><?php echo e(Session::get("failed")); ?></p>
        <?php endif; ?>
    </p>

 <?php if (isset($__componentOriginalba35371caef1eeddf45260937599d5fd5fb5dd30)): ?>
<?php $component = $__componentOriginalba35371caef1eeddf45260937599d5fd5fb5dd30; ?>
<?php unset($__componentOriginalba35371caef1eeddf45260937599d5fd5fb5dd30); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>    <?php /**PATH /var/www/html/resources/views/aboutMe.blade.php ENDPATH**/ ?>