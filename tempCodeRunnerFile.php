<!DOCTYPE html>
<html lang="zxx">

<head>
    <?php include_once 'head.php' ?>

<body style="background-color:lightpink">
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin -->

    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <?php include_once 'header.php' ?>
    <!-- Header Section End -->
    <!-- Class Section Begin -->
    <section class="class" style="margin-bottom:100px; ">
        <div class=" container">
            <div class="section-title text-center py-3 p-2 ">

                <h2>SignUp</h2>
            </div>

            <div class="col-lg-12">
                <div class="class__form">
                    <div class="section-title">

                    </div>
                    <form action="check_signup.php" name="Signup" method="post">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label>First Name</label>
                                        <input type="text" name="fname" onblur="namef()" placeholder="Enter first name" required>
                                        <p id="fname"></p>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Last Name</label>
                                        <input type="text" name="lname" onblur="namel()" placeholder="Enter last name" required>
                                        <p id="lname"></p>
                                    </div>
                                </div>
                                <label>Email</label>
                                <input type="email" onblur="checkemail()" name="email" placeholder="Enter user email id" required>
                                <p id="invalidemail"></p>
                                <label>Address</label>
                                <input type="text" name="address" placeholder="Enter Address" required>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <label>Password</label>
                                        <input type="password" id="password" name="password" placeholder="Enter the password" onkeyup='check();' required>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Conform Password</label>
                                        <input type="password" id="confirm_password" name="confirmpassword" minlength="8" maxlendth="8" placeholder="Enter the confirm password" onkeyup='check();' required>
                                        <span id='message'></span>
                                    </div>

                                </div>
                                <label>Gender</label>
                                <select name="gender" required>
                                    <option selected>Select Gender</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>

                            </div>
                            <div class="col-lg-6 mb-4">
                                <label>Phone No</label>
                                <input type="number" name="phone_no" maxlength="10" onblur="checkphone()" minlength="10" placeholder="Enter phone no" required>
                                <p id="ph"></p>
                                <label>Country</label>
                                <input type="text" name="country" onblur="country()" placeholder="Enter country" required>
                                <p id="country"></p>
                                <label>State</label>
                                <input type="text" name="state" onblur="state()" placeholder="Enter state" required>
                                <p id="state"></p>
                                <label>City</label>
                                <input type="text" name="city" onblur="city()" placeholder="Enter city" required>
                                <p id="city"></p>
                                <label>Image</label>
                                <input type="file" name="image">
                            </div>
                        </div>
                        <button type="submit" class="site-btn " style="margin-bottom:5px;" name="submitsignup" id="hover2">SignUp Now</button>

                    </form>
                </div>
            </div>

        </div>


    </section>
    <!-- Class Section End -->
    <!-- Footer Section Begin -->
    <?php include_once 'footer.php' ?>
</body>

</html>
<script>
    var check = function() {
        if (document.getElementById('password').value ==
            document.getElementById('confirm_password').value) {
            document.getElementById('message').style.color = 'green';
            document.getElementById('message').innerHTML = 'matching';
        } else {
            document.getElementById('message').style.color = 'red';
            document.getElementById('message').innerHTML = 'not matching';
            document.getElementById('btn').visible = "true";
        }
    }
</script>
<script>
    function namef() {
        var f = document.Signup.fname.value;

        if (f == "" || f == null) {
            document.getElementById("fname").innerHTML = "please enter the first name";
            // document.getElementById("btnuse").disabled="true";
            // document.getElementById("btnuse").style.background="red";
            return false;
        }
        if (!isNaN(f)) {
            document.getElementById("fname").innerHTML = " Only character are alloweds";
            //  document.getElementById("btnuse").disabled="true";
            // document.getElementById("btnuse").style.background="red";
            return false;
        }

        if ((f.length <= 2) || (f.length > 20)) {
            document.getElementById("fname").innerHTML = "please enter the corect name between 2 and 20";
            //   document.getElementById("btnuse").disabled="true";
            //  document.getElementById("btnuse").style.background="red";
            return false;
        } else {
            document.getElementById("fname").innerHTML = "";
            //  document.getElementById("btnuse").disabled="false";
            // document.getElementById("btnuse").style.background="green";
        }


    }

    function namel() {
        var f = document.Signup.lname.value;

        if (f == "" || f == null) {
            document.getElementById("lname").innerHTML = "please enter the last name";
            // document.getElementById("btnuse").disabled="true";
            // document.getElementById("btnuse").style.background="red";
            return false;
        }
        if (!isNaN(f)) {
            document.getElementById("lname").innerHTML = " Only character are alloweds";
            //  document.getElementById("btnuse").disabled="true";
            // document.getElementById("btnuse").style.background="red";
            return false;
        }

        if ((f.length <= 2) || (f.length > 20)) {
            document.getElementById("lname").innerHTML = "please enter the corect name between 2 and 20";
            //   document.getElementById("btnuse").disabled="true";
            //  document.getElementById("btnuse").style.background="red";
            return false;
        } else {
            document.getElementById("lname").innerHTML = "";
            //  document.getElementById("btnuse").disabled="false";
            // document.getElementById("btnuse").style.background="green";
        }


    }

    function checkemail() {
        var g = document.Signup.email.value;
        if (g == "" || g == null) {
            document.getElementById("invalidemail").innerHTML = "please enter the email id";
            // document.getElementById("btnuse").disabled="true";
            //  document.getElementById("btnuse").style.background="red";
            return false;
        }
        if (g.indexOf('@') <= 0) {
            document.getElementById("invalidemail").innerHTML = "invalid position of '@' ";
            //  document.getElementById("btnuse").disabled="true";
            // document.getElementById("btnuse").style.background="red";
            return false;
        }
        //return index value :charAt then total length hemant@gmail.com length is:16 return charAt is position of cdot(.) lenth-position 16-4 12 identify the position 
        if ((g.charAt(g.length - 4) != '.') && (g.charAt(g.length - 3) != '.')) {
            document.getElementById("invalidemail").innerHTML = "invalid position of 'dot(.)' ";
            // document.getElementById("btnuse").disabled="true";
            // document.getElementById("btnuse").style.background="red";
            return false;

        } else {
            document.getElementById("invalidemail").innerHTML = "";
            //  document.getElementById("btnuse").disabled="false";
            //   document.getElementById("btnuse").style.background="green";
        }
    }

    function checkphone() {
        var f = document.Signup.phone_no.value;
        var r = /^[6-9][0-9]{9}$/;
        if (f == "" || f == null) {
            document.getElementById("ph").innerHTML = "please enter the phone number";
            // document.getElementById("btnuse").disabled="true";
            //  document.getElementById("btnuse").style.background="red";
            return false;
        }
        if (isNaN(f)) {
            document.getElementById("ph").innerHTML = " Only number are alloweds";
            //  document.getElementById("btnuse").disabled="true";
            // document.getElementById("btnuse").style.background="red";
            return false;
        }

        if ((f.length > 10) || (f.length < 10)) {
            document.getElementById("ph").innerHTML = "phone number length must be 10 number";
            //  document.getElementById("btnuse").disabled="true";
            //  document.getElementById("btnuse").style.background="red";
            return false;
        }
        if (!r.test(f)) {
            document.getElementById("ph").innerHTML = "Please enter currect number between 6 to 9";
            //   document.getElementById("btnuse").disabled="true";
            //  document.getElementById("btnuse").style.background="red";
            return false;
        } else {
            document.getElementById("ph").innerHTML = "";
            //  document.getElementById("btnuse").disabled="false";
            // document.getElementById("btnuse").style.background="green";
        }




    }

    function country() {
        var f = document.Signup.country.value;
        alert(f);

        if (f == "" || f == null) {
            document.getElementById("country").innerHTML = "please enter the country name";
            // document.getElementById("btnuse").disabled="true";
            // document.getElementById("btnuse").style.background="red";
            return false;
        }
        if (!isNaN(f)) {
            document.getElementById("country").innerHTML = " Only character are alloweds";
            //  document.getElementById("btnuse").disabled="true";
            // document.getElementById("btnuse").style.background="red";
            return false;
        }

        if ((f.length <= 2) || (f.length > 20)) {
            document.getElementById("country").innerHTML = "please enter the corect country name";
            //   document.getElementById("btnuse").disabled="true";
            //  document.getElementById("btnuse").style.background="red";
            return false;
        } else {
            document.getElementById("country").innerHTML = "";
            //  document.getElementById("btnuse").disabled="false";
            // document.getElementById("btnuse").style.background="green";
        }


    }

    function city() {
        var f = document.Signup.city.value;

        if (f == "" || f == null) {
            document.getElementById("city").innerHTML = "please enter the city name";
            // document.getElementById("btnuse").disabled="true";
            // document.getElementById("btnuse").style.background="red";
            return false;
        }
        if (!isNaN(f)) {
            document.getElementById("city").innerHTML = " Only character are alloweds";
            //  document.getElementById("btnuse").disabled="true";
            // document.getElementById("btnuse").style.background="red";
            return false;
        }

        if ((f.length <= 2) || (f.length > 30)) {
            document.getElementById("city").innerHTML = "please enter the corect city name";
            //   document.getElementById("btnuse").disabled="true";
            //  document.getElementById("btnuse").style.background="red";
            return false;
        } else {
            document.getElementById("city").innerHTML = "";
            //  document.getElementById("btnuse").disabled="false";
            // document.getElementById("btnuse").style.background="green";
        }


    }

    function state() {
        var f = document.Signup.state.value;

        if (f == "" || f == null) {
            document.getElementById("state").innerHTML = "please enter the state name";
            // document.getElementById("btnuse").disabled="true";
            // document.getElementById("btnuse").style.background="red";
            return false;
        }
        if (!isNaN(f)) {
            document.getElementById("state").innerHTML = " Only character are alloweds";
            //  document.getElementById("btnuse").disabled="true";
            // document.getElementById("btnuse").style.background="red";
            return false;
        }

        if ((f.length <= 2) || (f.length > 20)) {
            document.getElementById("state").innerHTML = "please enter the corect state name";
            //   document.getElementById("btnuse").disabled="true";
            //  document.getElementById("btnuse").style.background="red";
            return false;
        } else {
            document.getElementById("state").innerHTML = "";
            //  document.getElementById("btnuse").disabled="false";
            // document.getElementById("btnuse").style.background="green";
        }


    }
</script>