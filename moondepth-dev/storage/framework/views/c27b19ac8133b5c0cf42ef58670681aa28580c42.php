

<?php $__env->startSection('title', config('app.name', 'Laravel') . ' — Space for your message'); ?>

<?php $__env->startSection('meta_tags'); ?>
<meta name="title" content="<?php echo e(config('app.name', 'Laravel') . ' — Space for your message'); ?>">
<meta name="description" content="Moondepth is a new image-based space where anyone can post comments with images. © 2019 Moondepth. All rights reserved. Made by kara_sick">
<meta name="author" content="Kara Sick">
<meta name="keywords" content="moondepth,imageboard,forum,messenger,welcome,space,index,kara_sick,2019">
<meta name="robots" content="index,follow">
<meta property="og:title" content="<?php echo e(config('app.name', 'Laravel') . ' — Space for your message'); ?>" />
<meta property="og:type" content="website" />
<meta property="og:image" content="//moondepth.space/img/png/moondepth.dark.logo.png" />
<meta property="og:image:secure_url" content="<?php echo e(asset('img/png/moondepth.dark.logo.png')); ?>" />
<meta property="og:image:type" content="image/png">
<meta property="og:image:width" content="300" />
<meta property="og:image:height" content="300" />
<meta property="og:url" content="<?php echo e(route('welcome.index')); ?>" />
<meta property="og:description" content="Moondepth is a new image-based space where anyone can post comments with images. © 2019 Moondepth. All rights reserved. Made by kara_sick" />
<meta property="og:site_name" content="Moondepth" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container center">
    <h1><strong>Welcome fellow man</strong></h1>
</div>

<div class="center">
    <div class="row">
        <form action="<?php echo e(route('search.index')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="input-field col s12">
                <input class="white-text" id="search" type="text" name="search" >
                <label for="first_name">Search</label>
                <?php $__errorArgs = ['search'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="invalid-feedback text-left" role="alert">
                            <strong><?php echo e($message); ?></strong>
                        </span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </form>
        <div class="col s12 m6 l4">
            <h2><i>Big Board:</i></h2><br/>
            <a href="<?php echo e(route('board.show', ['board' => $big_board->headline])); ?>" class="text-primary">/<?php echo e($big_board->headline); ?>/ - <?php echo e($big_board->description); ?></a>
        </div>
        <div class="col s12 m6 l4">
            <h2><i>Best board:</i></h2><br/>
            <a href="<?php echo e(route('board.show', ['board' => $best_board->headline])); ?>" class="text-primary">/<?php echo e($best_board->headline); ?>/ - <?php echo e($best_board->description); ?></a>
        </div>
        <div class="col s12 m12 l4">
            <h2><i>Your board:</i></h2><br/>
            <a href="<?php echo e(route('board.show', ['board' => $random_board->headline])); ?>" class="text-primary">/<?php echo e($random_board->headline); ?>/ - <?php echo e($random_board->description); ?></a>
        </div>
    </div>
</div>
<br /><br /><br />
<div class="center hide-on-med-and-up">
    <div class="row">
        <div class="col s12 m6 l4">
            <h5><i><a href="<?php echo e(route('about.index')); ?>" class="text-primary">About</a></i></h5><br/>
        </div>
        <div class="col s12 m6 l4">
            <h5><i><a href="<?php echo e(route('help.index')); ?>" class="text-primary">Help</a></i></h5><br/>
        </div>
        <div class="col s12 m12 l4">
            <h5><i><a href="<?php echo e(route('help.index')); ?>" class="text-primary">Rules</a></i></h5><br/>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\php\GitHub\MoondepthLaravel\moondepth-dev\resources\views/welcome/index.blade.php ENDPATH**/ ?>