<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <!-- Add Bootstrap CSS -->
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <section class="vh-100" style="background-color: #FFFFFF;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card shadow-2-strong" style="border-radius: 1rem;background-color: #1E1E1E;"">
            <div class="card-body p-5">

                <h3 class="mb-5 text-center text-light" style="font-family: Montserrat">e-Mading</h3>
                <form method="POST" action="authenticate.php">
                    <div class="form-outline mb-4">
                        <label class="form-label text-light" for="username" style="font-family: Montserrat">Username</label>
                        <input type="text" id="username" name="username" class="form-control form-control-lg" />
                    </div>

                    <div class="form-outline mb-4">
                        <label class="form-label text-light" for="password" style="font-family: Montserrat"style="font-family: Montserrat">Password</label>
                        <input type="password" id="password" name="password" class="form-control form-control-lg" />
                    </div>

                    <div class="text-center">
                        <button class="btn btn-primary btn-lg mt-5 bg-light border border-white font-weight-bold" 
                        type="submit" style="font-family: Montserrat;color:black">Login</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
        </div>
    </div>
    </section>
</body>

</html>