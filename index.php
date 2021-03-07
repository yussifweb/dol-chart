<?php $title = "Home" ?>
<?php require 'header.php'; ?>

<script>
    $(document).ready(function() {

        setInterval(function() {
            update_table();

        }, 500);

        // SHOW CARS

        function update_table() {

            $.ajax({
                url: 'display_table.php',
                type: 'POST',
                success: function(show_table) {
                    if (!show_table.error) {
                        $("#show-table").html(show_table);
                    }
                }
            });

            $('#search').keyup(function() {

                var search = $('#search').val();

                $.ajax({
                    url: 'search.php',
                    data: {
                        search: search
                    },
                    type: 'POST',
                    success: function(data) {
                        if (!data.error) {
                            $('#result').html(data);
                        }
                    }
                })
            });

        }

        // ADD CARS NAME TO DB

        $("#add-table-form").submit(function(evt) {
            evt.preventDefault();

            var postData = $(this).serialize();
            var url = $(this).attr('action');

            // alert(postData);

            $.post(url, postData, function(php_table_data) {
                $("#table-result").html(php_table_data);
                $("#add-table-form")[0].reset();

            });
        });


    }); //DOCUMENT READY
</script>

<!-- Modal -->
<div class="modal fade" id="addplayerModal" tabindex="-1" aria-labelledby="addplayerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addplayerModalLabel">Add a Player</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" id="add-table-form" action="add_tables.php">
                    <div class="row mb-3">
                        <div class="col-5 mb-3">
                            <label for="player_name">Player Name</label>
                            <input type="text" class="form-control" id="player_name" name="player_name" placeholder="Player Name" required>
                        </div>
                        <div class="col-5 mb-3">
                            <label for="club">Club</label>
                            <input type="text" class="form-control" id="club" name="club" placeholder="Club" required>
                        </div>
                        <div class="col-2 mb-3">
                            <label for="goals">Goals</label>
                            <input type="number" class="form-control" id="goals" name="goals" placeholder="Goals" required>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Submit</button>
                </form>

            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="updateplayerModal" tabindex="-1" aria-labelledby="updateplayerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" id="updateplayer">

    </div>
</div>

<div id="container" class="container">
    <div class="row mt-3">
        <div class="col-sm-6 col-xs-12 offset-sm-3">
            <!-- <h2>Search Database</h2>
            <input class="form-control" type="text" type="text" name="search" id="search" placeholder="Search">
            <br />
            <br /> -->
            <h5 class="bg-success" id="result"></h5>
        </div>
    </div>


    <div class="row">
        <div class="col-sm-6 col-xs-12 offset-sm-3">
            <!-- Button trigger modal -->
<?php
if ((isset($_SESSION["email"]) && $_SESSION["email"] == $email)) {
           echo "<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#addplayerModal'>
                Add Player
            </button>";
}
?>

        </div>
    </div>

    <div class="row mt-5">

        <div class="col-sm-8 col-xs-12 offset-sm-2">
            <div id="action-container" class="mb-3">

            </div>

            <table class=" table table-green table-striped">
                <thead>
                    <tr>
                        <th class="text-center">S/N</th>
                        <th>Name</th>
                        <th>Club</th>
                        <th class="text-center">Goal(s)</th>
<?php
if ((isset($_SESSION["email"]) && $_SESSION["email"] == $email)) {
                        echo "<th class='text-center'>Edit</th>";
                        echo "<th class='text-center'>Delete</th>";
}?>
                    </tr>
                </thead>
                <tbody id="show-table">

                </tbody>

            </table>

        </div>

    </div>

</div>

<?php require 'footer.php'; ?>