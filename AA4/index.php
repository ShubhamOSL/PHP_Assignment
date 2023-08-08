<?php
include 'connection.inc.php';

$country = "SELECT * FROM countries";
$county_qry = mysqli_query($conn, $country);



include 'include_common/header.php' ?>

<div class="d-flex justify-content-center align-items-center">
    <div class="container my-5">
        <a href="profile.php">profile</a>
        <a href="logout.php">logout</a>

        <h1 class="text-center my-5">Country City State</h1>
        <div class="card">
            <div class="card-body">

             <form action="final.php" method="post">

                <div class="input-group mb-3">
                    <select class="form-select" id="country" name="country">
                        <option selected disabled>Select Country</option>
                        <?php while ($row = mysqli_fetch_assoc($county_qry)) : ?>
                            <option value="<?php echo $row['id']; ?>"> <?php echo $row['name']; ?> </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="input-group mb-3">
                    <select class="form-select" id="state" name='state'>
                        <option selected disabled>Select State</option>
                    </select>
                </div>
                <div class="input-group mb-3">
                    <select class="form-select" id="city" name="city">
                        <option selected disabled>Select City</option>
                    </select>
                </div>
                <button type="submit">submit</button>
            </form>
            </div>
        </div>
    </div>
</div>

<?php include 'include_common/footer.php' ?>

<script>
    // County State

    $('#country').on('change', function() {
        var country_id = this.value;
        // console.log(country_id);
        $.ajax({
            url: 'ajax/state.php',
            type: "POST",
            data: {
                country_data: country_id
            },
            success: function(result) {
                $('#state').html(result);
                // console.log(result);
            }
        })
    });
    // state city
    $('#state').on('change', function() {
        var state_id = this.value;
        // console.log(country_id);
        $.ajax({
            url: 'ajax/city.php',
            type: "POST",
            data: {
                state_data: state_id
            },
            success: function(data) {
                $('#city').html(data);
                // console.log(data);
            }
        })
    });
</script>