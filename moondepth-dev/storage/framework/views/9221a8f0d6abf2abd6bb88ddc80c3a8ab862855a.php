<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" prefix="og: https://moondepth.space/ns#">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <!-- Title -->
    <title><?php echo $__env->yieldContent('title'); ?></title>

    <!-- Metas -->
    <?php echo $__env->yieldContent('meta_tags'); ?>

    <!-- Styles -->
    <link href="<?php echo e(URL::asset('css/materialize.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(URL::asset('css/style.css')); ?>" rel="stylesheet">

    <!-- Scripts -->
    <script src="<?php echo e(URL::asset('js/app.js')); ?>" defer></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>
<body class="bg-dark text-white">
    <div id="app">
        <header>
            <nav id="top-nav" class="grey darken-3">
                <div class="container">
                    <div class="nav-wrapper">
                        <div class="row">
                            <div class="col s12 m8 offset-m1">
                                <a id="nav-mobile-button" href="#" data-target="nav-mobile" class="top-nav sidenav-trigger full hide-on-large-only">
                                    <i class="material-icons">menu</i>
                                </a>
                                <a id="logo-container" href="<?php echo e(route('welcome.index')); ?>" class="brand-logo">
                                    <img class="hide-on-small-only" src="<?php echo e(asset('img/svg/moondepth.white.logo.svg')); ?>" alt="moondepth logo">
                                    <span id="app-name"><?php echo e(config('app.name', 'Laravel')); ?></span>
                                </a>
                            </div>
                            <div id="additional-links" class="links hide-on-small-only hide-on-large-only col m3">
                                <!-- Dropdown Trigger -->
                                <a class="dropdown-trigger" href="#info-dropdown" data-target="info-dropdown">Info<i class="material-icons right">arrow_drop_down</i></a>
                                <!-- Dropdown Structure -->
                                <ul id='info-dropdown' class='dropdown-content'>
                                    <li><a id="about-link" href="<?php echo e(route('about.index')); ?>" class="additional-link text-primary">About</a></li>
                                    <li><a id="help-link" href="<?php echo e(route('help.index')); ?>" class="additional-link text-primary">Help</a></li>
                                    <li><a id="rules-link" href="<?php echo e(route('rules.index')); ?>" class="additional-link text-primary">Rules</a></li>
                                </ul>
                            </div>
                            <div id="additional-links" class="links hide-on-med-and-down col m5 l4 offset-l8">
                                <a id="about-link" href="<?php echo e(route('about.index')); ?>" class="additional-link text-primary">About</a>
                                <a id="help-link" href="<?php echo e(route('help.index')); ?>" class="additional-link text-primary">Help</a>
                                <a id="rules-link" href="<?php echo e(route('rules.index')); ?>" class="additional-link text-primary">Rules</a>
                            </div>

                            
                        </div>
                    </div>
                </div>
            </nav>
            <ul id="nav-mobile" class="sidenav sidenav-fixed">
                <ul class="section table-of-contents">
                    <?php $__currentLoopData = $boards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $board): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <a class = "white-text text-navbar" href="<?php echo e(route('board.show', $board->headline)); ?>" title="<?php echo e($board->description); ?>">
                            <span>/<?php echo e($board->headline); ?>/ - <?php echo e($board->description); ?></span>
                        </a>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </ul>
        </header>

        <!-- Page Content -->
        <main>
            <div class="container white-text">
                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </main>
    </div>

    <footer id="afterword-banner" class="page-footer grey darken-3">
        <div class="container footer-links">
            <div class="row">
                    <div class="col l6 s12">
                    <h5 class="white-text">Creator Bio</h5>
                    <p class="grey-text text-lighten-4">I'm student working on this project like it's my full time job.</p>
                </div>
                <div class="col l3 s12">
                    <h5 class="white-text">Connect</h5>
                    <ul>
                        <li class="hide-on-med-and-down"><a class="white-text" target="_blank" href="https://mail.google.com/mail/?view=cm&fs=1&to=mailbox@moondepth.space&su=Moondepth%20User%20Report&body=<please write down your thoughts>">mailbox@moondepth.space</a></li>
                        <li class="hide-on-large-only"><a class="white-text" launch-external="true" href="mailto:mailbox@moondepth.space?subject=Moondepth User Report&body=<please write down your thoughts>">mailbox@moondepth.space</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container footer-copyright">
            <span>© 2019 Moondepth. All rights reserved.</span>
            <span>Made by <a class="grey-text grey-lighten-3" href="https://t.me/kara_sick">kara_sick</a></span>
        </div>
    </footer>

    <?php echo $__env->yieldPushContent('secondary-scripts'); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\php\GitHub\MoondepthLaravel\moondepth-dev\resources\views/layouts/app.blade.php ENDPATH**/ ?>