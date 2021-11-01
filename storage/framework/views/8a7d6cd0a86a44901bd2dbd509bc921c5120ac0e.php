<nav class="navbar navbar-expand-lg navbar-light bg-light" style="border-radius: 5px">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Get Picture from Database -->
        <nav class="navbar navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img class="profilePic" src="<?php echo e($profilePicture); ?>" alt="" width="100" height="100">
                </a>
            </div>
        </nav>

        <!-- Get name from Database -->
        <a class="navbar-brand profileName" href="<?php echo e(route('show_biography')); ?>"><?php echo e($profileName); ?></a>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <div class="container">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?php echo e((request()->routeIs('show_biography')) ? 'active' : ''); ?>" aria-current="page" href="<?php echo e(route('show_biography')); ?>">About Me</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e((request()->routeIs('show_contactMe')) ? 'active' : ''); ?>" aria-current="page" href="<?php echo e(route('show_contactMe')); ?>">Contact Me</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" target="_blank" href="<?php echo e(route('show_cv')); ?>">CV</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" target="_blank" href="<?php echo e(route('show_weblog')); ?>">Weblog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e((request()->routeIs('show_books')) ? 'active' : ''); ?>" href="<?php echo e(route('show_books')); ?>">Books</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<?php /**PATH /var/www/html/resources/views/components/nav.blade.php ENDPATH**/ ?>