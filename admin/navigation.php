

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php">Sip caller admin</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="target.php">Target</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="user_register.php">Register Counselor</a>
            </li>


        </ul>
        <ul class="navbar-nav ml-auto">

            <li class="nav-item dropdown ">

                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php

                        if (isset($_SESSION['admin_name'])){
                            echo $_SESSION['admin_name'];
                        }

                    ?>
                </a>

                <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                    <a class="dropdown-item" href="logout.php">Logout</a>
                </div>

            </li>
        </ul>

    </div>
</nav>