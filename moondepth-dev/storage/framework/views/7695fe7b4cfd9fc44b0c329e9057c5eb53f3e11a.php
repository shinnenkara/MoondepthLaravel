

<?php $__env->startSection('title', '/' . $board->headline . '/ — ' . config('app.name', 'Laravel') . ' — ' . $board->description); ?>

<?php $__env->startSection('meta_tags'); ?>
<meta name="title" content="<?php echo e('/' . $board->headline . '/ — ' . config('app.name', 'Laravel') . ' — ' . $board->description); ?>">
<meta name="description" content="<?php echo e($board->description); ?>. © 2019 Moondepth. All rights reserved. Made by kara_sick">
<meta name="author" content="Kara Sick">
<meta name="keywords" content="moondepth,imageboard,forum,messenger,board,space,<?php echo e($board->headline); ?>,<?php echo e($board->description); ?>,kara_sick,2019">
<meta name="robots" content="index,follow">
<meta property="og:title" content="<?php echo e('/' . $board->headline . '/ — ' . config('app.name', 'Laravel') . ' — ' . $board->description); ?>" />
<meta property="og:type" content="website" />
<meta property="og:image" content="//moondepth.space/img/png/moondepth.dark.logo.png" />
<meta property="og:image:secure_url" content="<?php echo e(asset('img/png/moondepth.dark.logo.png')); ?>" />
<meta property="og:image:type" content="image/png">
<meta property="og:image:width" content="300" />
<meta property="og:image:height" content="300" />
<meta property="og:url" content="<?php echo e(route('board.show', ['board' => $board->headline])); ?>" />
<meta property="og:description" content="<?php echo e($board->description); ?>. © 2019 Moondepth. All rights reserved. Made by kara_sick" />
<meta property="og:site_name" content="Moondepth" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div id="board-welcome" class="container center">
    <h2>Welcome to /<?php echo e($board->headline); ?>/</h2>
    <h5><?php echo e($board->description); ?></h5>
</div>
<div id="thread-creation" class="container center">
    <create-thread is_error="<?php echo e(session()->get( 'is_error' )); ?>"></create-thread>
    <div id="shadow" class="container white-text center">
        <form id="thread-form"
            class="col s12"
            method="POST"
            action="<?php echo e(route('board.store', ['board' => $board->headline])); ?>"
            enctype="multipart/form-data">
            <?php echo csrf_field(); ?>

            <div class="form-group row">
                <div class="input-field col s12 m6">
                    <input id="username_input"
                        class="white-text form-control <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        type="text"
                        name="username"
                        value="Anonymous"
                        required
                        data-length="20"
                        autocomplete="username"
                        disabled>
                    <label class="active" for="username_input">Your username</label>
                    <span class="helper-text grey-text text-darken-2 left">You can get recognized</span>
                    <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($message); ?></strong>
                        </span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="input-field col s12 m6">
                    <input id="topic_input"
                        class="white-text form-control <?php $__errorArgs = ['topic'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        type="text"
                        name="topic"
                        value="<?php echo e(old('topic')); ?>"
                        required
                        data-length="40"
                        autocomplete="topic"
                        autofocus>
                    <label for="topic_input">Topic</label>
                    <?php $__errorArgs = ['topic'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($message); ?></strong>
                        </span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="input-field col s12">
                    <textarea id="subject_text_input"
                        class="materialize-textarea white-text form-control <?php $__errorArgs = ['subject_text'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        type="textarea"
                        name="subject_text"
                        wrap="soft"
                        required
                        data-length="120"><?php echo e(old('subject_text')); ?></textarea>
                    <label for="subject_text_input">Subject text</label>
                    <?php $__errorArgs = ['subject_text'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($message); ?></strong>
                        </span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="input-field col s12">
                    <div class="file-field input-field">
                        <div class="btn">
                            <span>File</span>
                            <input id="file_input"
                                class="form-control-file"
                                type="file"
                                name="file_input[]"
                                multiple>
                        </div>
                        <div class="file-path-wrapper">
                            <input id="file_path"
                                class="file-path validate white-text"
                                type="text"
                                name="file">
                            <!--placeholder="Upload one or more files" -->
                            <span class="helper-text grey-text text-darken-2 left">Upload up to three files</span>
                        </div>
                        <?php $__errorArgs = ['file_input'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($message); ?></strong>
                            </span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <?php $__errorArgs = ['file_input.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($message); ?></strong>
                            </span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
                <div class="input-field col s12">
                    <div class="center g-recaptcha" data-sitekey="<?php echo e(env('GOOGLE_RECAPTCHA_KEY')); ?>"></div>
                    <?php $__errorArgs = ['g-recaptcha-response'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($message); ?></strong>
                        </span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="input-field col s12">
                    <button id="submit_input" class="white-text waves-effect waves-light grey darken-3 btn-large"
                            type="submit" name="submit" value="send">Send</button>
                </div>
                <div class="submit-check col s12">
                </div>
            </div>
        </form>
    </div>
</div>

<div id="board-threads" class="">
    <div class="row">
        <?php $__currentLoopData = $threads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $thread): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="thread col l12 m12 s12">
            <div class="thread-topic">
                <div class="thread-head">
                    <i class="material-icons hidethread-icons content">arrow_drop_down</i>
                    <a class="white-text" href="<?php echo e(route('thread.show', ['board' => $thread->board->headline, 'thread' => $thread->id])); ?>">
                        <h5 class="content"><strong><?php echo e($thread->topic); ?></strong></h5>
                        <h5 class="content grey-text text-lighten-1"><?php echo e(mb_strtoupper(mb_substr($thread->user->username, 0, 1)).mb_substr($thread->user->username, 1)); ?></h5>
                        <h5 class="content"><?php echo e($thread->created_at); ?></h5>
                        <h5 class="content">No. <?php echo e($thread->id); ?></h5>
                    </a>
                    <h5 class="content">
                        [<a class="white-text" href="<?php echo e(route('thread.show', ['board' => $thread->board->headline, 'thread' => $thread->id])); ?>">
                            <span class="grey-text text-lighten-1">Reply</span>
                        </a>]
                    </h5>
                </div>
                <div class="thread-body">
                    <?php if(!$thread->files->isEmpty()): ?>
                    <div class="thread-files">
                        <div class="row">
                            <?php $__currentLoopData = $thread->files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <thread-image src="<?php echo e(Storage::disk('s3')->url($file->s3_path)); ?>" alt="<?php echo e(urldecode($file->original_name)); ?>" size="<?php echo e($file->size); ?>" width="<?php echo e($file->width); ?>" height="<?php echo e($file->height); ?>"></thread-image>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="container">
                        <div class="message-text">
                            <h5><?php echo nl2br(e($thread->subject_text)); ?></h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="thread-messages">
                <div class="row">
                    <?php $__currentLoopData = $thread->messages()->latest()->limit(3)->get()->reverse(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="message col l11 m11 s12">
                        <div class="message-head">
                            <i class="material-icons hidemessage-icons">arrow_drop_down</i>
                            <h5 class="content grey-text text-lighten-1"><?php echo e(mb_strtoupper(mb_substr($message->user->username, 0, 1)).mb_substr($message->user->username, 1)); ?></h5>
                            <h5 class="content"><?php echo e($message->created_at); ?></h5>
                            <a class="white-text" href="<?php echo e(route('thread.show', ['board' => $thread->board->headline, 'thread' => $thread->id])); ?>">
                                <h5 class="content">No. <?php echo e($message->id); ?></h5></a>
                        </div>
                        <div class="message-body">
                            <?php if(!$message->files->isEmpty()): ?>
                            <div class="message-files">
                                <div class="row">
                                    <?php $__currentLoopData = $message->files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <message-image src="<?php echo e(Storage::disk('s3')->url($file->s3_path)); ?>" alt="<?php echo e(urldecode($file->original_name)); ?>" size="<?php echo e($file->size); ?>" width="<?php echo e($file->width); ?>" height="<?php echo e($file->height); ?>"></message-image>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class="container">
                                <?php if($message->response_to): ?>
                                <h6><?php echo e('>> ' . $message->response_to); ?></h6>
                                <?php endif; ?>
                                <div class="message-text">
                                    <h5><?php echo nl2br(e($message->text)); ?></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div id="pages" class="container center"><?php echo e($threads->links('vendor.pagination.materialize')); ?></div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\php\GitHub\MoondepthLaravel\moondepth-dev\resources\views/board/show.blade.php ENDPATH**/ ?>