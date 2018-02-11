

<?php $__env->startSection('content'); ?>
    <?php echo e(Form::open(array('url' => 'login'))); ?>



    <!-- if there are login errors, show them here -->
    <p>
        <?php echo e($errors->first('email')); ?>

        <?php echo e($errors->first('password')); ?>

    </p>

    <div class="row">
        <div class="col-sm-4 text-right">
            <?php echo e(Form::label('email', 'Email Address')); ?>

        </div>
        <div class="col-sm-8 text-left">
            <?php echo e(Form::email('email')); ?>

        </div>
    </div>
    <div class="row">
        <div class="col-sm-4 text-right">
            <?php echo e(Form::label('password', 'Password')); ?>

        </div>
        <div class="col-sm-8 text-left">
            <?php echo e(Form::password('password')); ?>

        </div>
    </div>
    <div class="row"> </div>
    <?php echo e(Form::submit('Login')); ?>


    <?php echo e(Form::close()); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>