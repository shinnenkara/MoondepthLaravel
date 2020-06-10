<?php if($paginator->hasPages()): ?>
    <ul class="pagination" role="navigation">
        
        <?php if($paginator->onFirstPage()): ?>
            <li class="disabled" aria-disabled="true" aria-label="<?php echo app('translator')->get('pagination.previous'); ?>">
                <a href="#"><span aria-hidden="true"><i class="material-icons">chevron_left</i></span></a>
            </li>
        <?php else: ?>
            <li class="waves-effect">
                <a href="<?php echo e($paginator->previousPageUrl()); ?>" rel="prev" aria-label="<?php echo app('translator')->get('pagination.previous'); ?>"><i class="material-icons">chevron_left</i></a>
            </li>
        <?php endif; ?>

        
        <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            
            <?php if(is_string($element)): ?>
                <li class="disabled" aria-disabled="true"><span><?php echo e($element); ?></span></li>
            <?php endif; ?>

            
            <?php if(is_array($element)): ?>
                <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($page == $paginator->currentPage()): ?>
                        <li class="active"><a href="#"><?php echo e($page); ?></a></li>
                    <?php else: ?>
                        <li class="waves-effect"><a href="<?php echo e($url); ?>"><?php echo e($page); ?></a></li>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        
        <?php if($paginator->hasMorePages()): ?>
            <li class="waves-effect">
                <a href="<?php echo e($paginator->nextPageUrl()); ?>" rel="next" aria-label="<?php echo app('translator')->get('pagination.next'); ?>"><i class="material-icons">chevron_right</i></a>
            </li>
        <?php else: ?>
            <li class="disabled" aria-disabled="true" aria-label="<?php echo app('translator')->get('pagination.next'); ?>">
                <a href="#"><span aria-hidden="true"><i class="material-icons">chevron_right</i></span></a>
            </li>
        <?php endif; ?>
    </ul>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\php\GitHub\MoondepthLaravel\moondepth-dev\resources\views/vendor/pagination/materialize.blade.php ENDPATH**/ ?>