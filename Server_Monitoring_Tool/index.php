<html>

<head>
    <link rel="stylesheet" href="CSS/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
</head>

<body>
    <div id="homePage">
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid" id="nav">

                <img src="Images/Monnit_Tool_Logo.png" id="navLogo" width="140px" height="50px">

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarScroll">
                    <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                        <li class="nav-item">
                            <b><a class="nav-link active" aria-current="page" href="#">Home</a></b>
                        </li>
                        <li class="nav-item">
                            <b><a class="nav-link" href="#">Link</a></b>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>

        <div id="systemInfo">
            <div class="accordion" id="accordionPanelsStayOpenExample">

                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <b> View Server Info </b>
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body">

                            <?php

                            $feature1 = shell_exec("systeminfo|findstr \"Host Name\"");
                            print($feature1 . "<br><br>");

                            $feature2 = shell_exec("systeminfo|findstr \"Domain\"");
                            print($feature2 . "<br><br>");

                            $feature3 = shell_exec("systeminfo|findstr \"OS Version\"");
                            print($feature3 . "<br><br>");

                            $feature4 = shell_exec("systeminfo|findstr \"BIOS Version\"");
                            print($feature4 . "<br><br>");

                            $feature5 = shell_exec("systeminfo|findstr \"OS Manufacturer\"");
                            print($feature5 . "<br><br>");

                            $feature6 = shell_exec("systeminfo|findstr \"Product ID\"");
                            print($feature6 . "<br><br>");

                            $feature7 = shell_exec("systeminfo|findstr \"System Model\"");
                            print($feature7 . "<br><br>");

                            $feature8 = shell_exec("systeminfo|findstr \"Processor(s)\"");
                            echo $feature8 . "<br><br>";
                            ?>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div id="operationMenu">
        <div class="inlines"><img src="Images/Monnit_Tool_Logo.png" id="navLogo" width="90px" height="30px">
            <h3>Explore <b>MONNIT</b> Services</h3>
        </div>
        <div class="inlines"> <a href="server_network_metrics.php"><button type="button" class="btn btn-outline-success">Monitor Server Network Metrics</button></a> <img src="Images/server_network_image.jpg" id="navLogo" width="80px" height="40px" style="border-radius:5px"> </div>
        <div class="inlines"> <a href="monitor_server.php"> <button type="button" class="btn btn-outline-success">Monitor Server</button><img src="Images/monitor_server.png" id="navLogo" width="60px" height="40px" style="border-radius:5px"> </a> </div>
    </div>

    <footer>
        <div>
            <ul>
                <li><strong>Monnit</strong></li>
                <li>How it Works?</li>
                <li>Docs</li>
            </ul>
        </div>

        <div>
            <ul>
                <li><strong>Resources</strong></li>
                <li>See all Resources</li>
            </ul>
        </div>

        <div>
            <ul>
                <li><strong>About</strong></li>
                <li>Terms and Conditions</li>
                <li>Policy</li>
            </ul>
        </div>


    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    </div>
</body>

</html>